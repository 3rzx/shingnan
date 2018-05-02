<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 趨勢類別
 */
class News
{
    // database object
    public $db = null;
    // smarty template object
    public $smarty = null;
    // success messages
    public $msg = '';
    // error messages
    public $error = '';

    /**
     * User constructor
     * @DateTime 2016-09-03
     */
    public function __construct()
    {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();
        // php version is less than 5.4.0
        if (PHP_VERSION_ID < 50400) {
            // 登記 Session 變數名稱
            session_register('isLogin');
            session_register('user');
            session_register('error');
            session_register('msg');
        }
    }

    /**
     * 新增趨勢格式
     */
    public function newsAddPrepare()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('news/newsAdd.html');
        }

    }

    /**
     * 新增趨勢
     */
    public function newsAdd($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $newsId = $idGen->GetID('news');
            $sql = "INSERT INTO `shingnan`.`article` (`articleId`, `title`,`preview`, `content`, `type`, `ctr`, `isDelete`, `lastUpdateTime`, `createTime`) VALUES (:articleId, :title, :preview, :content, '2', '0', '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':articleId', $newsId, PDO::PARAM_STR);
            $res->bindParam(':title', $input['newsTitle'], PDO::PARAM_STR);
            $res->bindParam(':preview', $input['previewEditor'], PDO::PARAM_STR);
            $res->bindParam(':content', $input['newsEditor'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);

            if ($res->execute()) {
                //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['newsImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = 'news_' . $input['newsTitle'];
                    $fileInfo = $_FILES['newsImage'];
                    $newsImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`)
                            VALUES (:imgId, :imgName, 6,
                                    :newsId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':newsId', $newsId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $newsImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) {
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->newsList();
                    }
                }
            }

            $this->newsList();
        }
    }

    /**
     * 編輯趨勢前置
     */
    public function newsEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $sql = "SELECT `article`.`articleId`, `article`.`title` , `article`.`preview` , `article`.`content`, `image`.`imageId` ,`image`.`path`
                FROM  `article`
                LEFT JOIN  `image` ON article.`articleId` = image.`itemId`
                WHERE  `article`.`isDelete` = 0 and `article`.`articleId` = :newsId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':newsId', $input['newsId'], PDO::PARAM_STR);
            $res->execute();
            $newsData = $res->fetch();

            $this->smarty->assign('newsData', $newsData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('news/newsEdit.html');
        }
    }

    /**
     * 編輯趨勢
     */
    public function newsEdit($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE `shingnan`.`article` SET `title` = :title ,`preview`= :preview ,`content` = :content , `lastUpdateTime` =  :lastUpdateTime
                WHERE  `article`.`articleId` = :articleId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':articleId', $input['newsId'], PDO::PARAM_STR);
            $res->bindParam(':title', $input['newsTitle'], PDO::PARAM_STR);
            $res->bindParam(':preview', $input['previewEditor'], PDO::PARAM_STR);
            $res->bindParam(':content', $input['newsEditor'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
                $this->msg = '更新成功';
                if ($_FILES['newsImage']['error'] == 0) {
                    if (isset($input['imageId'])) {
                        $fileInfo = $_FILES['newsImage'];
                        $newsImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                        $res->bindParam(':pathinfo', $newsImage, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) {
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->newsList();
                        }
                    } else {
                        $idGen = new IdGenerator();
                        $imgId = $idGen->GetID('image');
                        $imgName = 'news_' . $input['newsTitle'];
                        $fileInfo = $_FILES['newsImage'];
                        $newsImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,
                                                                `itemId`, `ctr`, `path`, `link`, `createTime`)
                                VALUES (:imgId, :imgName, 6,
                                        :newsId, 0, :filePath, '', :createTime);";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                        $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                        $res->bindParam(':newsId', $input['newsId'], PDO::PARAM_STR);
                        $res->bindParam(':filePath', $newsImage, PDO::PARAM_STR);
                        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) {
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->newsList();
                        }
                    }
                }
            }

            $this->newsList();
        }
    }

    /**
     * 顯示所有趨勢列表
     */
    public function newsList()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            // get all data from news
            $sql = 'SELECT `article`.`title`, `article`.`articleId` , `article`.`type`,`article`.`ctr` , `article`.`lastUpdateTime`
                , `article`.`createTime`
                FROM  `article`
                WHERE type = 2
                ORDER BY `article`.`articleId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allnewsData = $res->fetchAll();

            $this->smarty->assign('allnewsData', $allnewsData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('news/newsList.html');
        }
    }

    /**
     * 刪除趨勢
     */
    public function newsDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            //
            $this->db->beginTransaction();
            $sql = "DELETE FROM `article` WHERE `articleId` = :newsId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':newsId', $input['newsId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->error = '';
            $this->msg = '刪除成功';
            $this->newsList();
        }
    }

    public function newsImageDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            //取得file path
            $sql = "SELECT `path` FROM `image` WHERE `image`.`imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $path = $res->fetch();

            //delete data from db
            $this->db->beginTransaction();
            $sql = "DELETE FROM `image` WHERE `image`.`imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            //delete data file
            $deleter = new deleteImgFile();
            $deleter->deleteFile($path['path']);

            $this->newsList();
        }
    }

    /**
     * 顯示登入畫面
     * @DateTime 2016-09-03
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

}
