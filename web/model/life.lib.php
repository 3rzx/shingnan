<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 生活類別
 */
class Life
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
     * 新增生活格式
     */
    public function lifeAddPrepare()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('life/lifeAdd.html');
        }
    }

    /**
     * 新增生活
     */
    public function lifeAdd($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $lifeId = $idGen->GetID('life');
            $sql = "INSERT INTO `shingnan`.`article` (`articleId`, `title`,`preview`, `content`, `type`, `ctr`, `isDelete`, `lastUpdateTime`, `createTime`) VALUES (:articleId, :title, :preview, :content, '3', '0', '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':articleId', $lifeId, PDO::PARAM_STR);
            $res->bindParam(':title', $input['lifeTitle'], PDO::PARAM_STR);
            $res->bindParam(':preview', $input['previewEditor'], PDO::PARAM_STR);
            $res->bindParam(':content', $input['lifeEditor'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
                //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['lifeImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = 'life_' . $input['lifeTitle'];
                    $fileInfo = $_FILES['lifeImage'];
                    $lifeImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`)
                            VALUES (:imgId, :imgName, 7,
                                    :lifeId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':lifeId', $lifeId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $lifeImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) {
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->lifeList();
                    }
                }
            }

            $this->lifeList();
        }
    }

    /**
     * 編輯生活前置
     */
    public function lifeEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $sql = "SELECT `article`.`articleId`, `article`.`title` , `article`.`content`
                        FROM  `article`
                        WHERE  `article`.`isDelete` = 0 and `article`.`articleId` = :lifeId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':lifeId', $input['lifeId'], PDO::PARAM_STR);
            $res->execute();
            $lifeData = $res->fetch();

            $this->smarty->assign('lifeData', $lifeData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('life/lifeEdit.html');
        }
    }

    /**
     * 編輯生活
     */
    public function lifeEdit($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE `shingnan`.`article` SET `title` = :title ,`content` = :content , `lastUpdateTime` =  :lastUpdateTime
                WHERE  `article`.`articleId` = :articleId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':articleId', $input['lifeId'], PDO::PARAM_STR);
            $res->bindParam(':title', $input['lifeTitle'], PDO::PARAM_STR);
            $res->bindParam(':content', $input['lifeEditor'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
                $this->msg = '更新成功';
            } else {
                $error = $res->errorInfo();
                $this->error = $error[0];
                $this->lifeList();
            }

            $this->lifeList();
        }
    }

    /**
     * 顯示所有生活列表
     */
    public function lifeList()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            // get all data from life
            $sql = 'SELECT `article`.`title`, `article`.`articleId` , `article`.`type`,`article`.`ctr` , `article`.`lastUpdateTime`
                , `article`.`createTime`
                FROM  `article`
                WHERE type = 3
                ORDER BY `article`.`articleId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $alllifeData = $res->fetchAll();

            $this->smarty->assign('alllifeData', $alllifeData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('life/lifeList.html');
        }
    }

    /**
     * 刪除生活
     */
    public function lifeDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            //
            $this->db->beginTransaction();
            $sql = "DELETE FROM `article` WHERE `articleId` = :lifeId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':lifeId', $input['lifeId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->error = '';
            $this->msg = '刪除成功';
            $this->lifeList();
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
