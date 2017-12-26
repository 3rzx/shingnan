<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
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
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('news/newsAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
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
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $newsId = $idGen->GetID('news');
        $sql = "INSERT INTO `shingnan`.`article` (`articleId`, `title`, `content`, `type`, `ctr`, `isDelete`, `lastUpdateTime`, `createTime`) VALUES (:articleId, :title, :content, '2', '0', '0', :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':articleId', $newsId, PDO::PARAM_STR);
        $res->bindParam(':title', $input['newsTitle'], PDO::PARAM_STR);
        $res->bindParam(':content', $input['newsEditor'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
            $this->msg = '新增成功';
        } else {
            $error = $res->errorInfo();
            $this->error = $error[0];
            $this->newsList();
        }

        $this->newsList();
    }

    /**
     * 編輯趨勢前置
     */
    public function newsEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $sql = "SELECT `article`.`articleId`, `article`.`title` , `article`.`content`
                FROM  `article`
                WHERE  `article`.`isDelete` = 0 and `article`.`articleId` = :newsId";
        $res = $this->db->prepare($sql);
        $res->bindParam(':newsId', $input['newsId'], PDO::PARAM_STR);
        $res->execute();
        $newsData = $res->fetch();

        $this->smarty->assign('newsData', $newsData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('news/newsEdit.html');
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
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`article` SET `title` = :title ,`content` = :content , `lastUpdateTime` =  :lastUpdateTime
        WHERE  `article`.`articleId` = :articleId";
        $res = $this->db->prepare($sql);
        $res->bindParam(':articleId', $input['newsId'], PDO::PARAM_STR);
        $res->bindParam(':title', $input['newsTitle'], PDO::PARAM_STR);
        $res->bindParam(':content', $input['newsEditor'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();

        if ($res->execute()) {
            $this->msg = '更新成功';
        } else {
            $error = $res->errorInfo();
            $this->error = $error[0];
            $this->newsList();
        }

        $this->newsList();
    }

    /**
     * 顯示所有趨勢列表
     */
    public function newsList()
    {
        if ($_SESSION['isLogin'] == true) {
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
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除趨勢
     */
    public function newsDelete($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $this->db->beginTransaction();
            $sql = "DELETE FROM `article` WHERE `articleId` = :newsId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':newsId', $input['newsId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->error = '';
            $this->msg = '刪除成功';
            $this->newsList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
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
