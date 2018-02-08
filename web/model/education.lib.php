<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * 衛教類別
 */
class Education
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
     * 新增衛教格式
     */
    public function educationAddPrepare()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('education/educationAdd.html');
        }
    }

    /**
     * 新增衛教
     */
    public function educationAdd($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return 0;
        } else {
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $educationId = $idGen->GetID('education');
            $sql = "INSERT INTO `shingnan`.`article` (`articleId`, `title`, `content`, `type`, `ctr`, `isDelete`, `lastUpdateTime`, `createTime`) VALUES (:articleId, :title, :content, '1', '0', '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':articleId', $educationId, PDO::PARAM_STR);
            $res->bindParam(':title', $input['educationTitle'], PDO::PARAM_STR);
            $res->bindParam(':content', $input['educationEditor'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);

            if ($res->execute()) {
                $this->msg = '新增成功';
            } else {
                $error = $res->errorInfo();
                $this->error = $error[0];
                $this->educationList();
            }
            $this->educationList();
        }
    }

    /**
     * 編輯衛教前置
     */
    public function educationEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return 0;
        } else {
            $sql = "SELECT `article`.`articleId`, `article`.`title` , `article`.`content`
                FROM  `article`
                WHERE  `article`.`isDelete` = 0 and `article`.`articleId` = :educationId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':educationId', $input['educationId'], PDO::PARAM_STR);
            $res->execute();
            $educationData = $res->fetch();

            $this->smarty->assign('educationData', $educationData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('education/educationEdit.html');
        }
    }

    /**
     * 編輯衛教
     */
    public function educationEdit($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return 0;
        } else {
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE `shingnan`.`article` SET `title` = :title ,`content` = :content , `lastUpdateTime` =  :lastUpdateTime
                WHERE  `article`.`articleId` = :articleId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':articleId', $input['educationId'], PDO::PARAM_STR);
            $res->bindParam(':title', $input['educationTitle'], PDO::PARAM_STR);
            $res->bindParam(':content', $input['educationEditor'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
                $this->msg = '更新成功';
            } else {
                $error = $res->errorInfo();
                $this->error = $error[0];
                $this->educationList();
            }

            $this->educationList();
        }
    }

    /**
     * 顯示所有衛教列表
     */
    public function educationList()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            // get all data from education
            $sql = 'SELECT `article`.`title`, `article`.`articleId` , `article`.`type`,`article`.`ctr` , `article`.`lastUpdateTime`
                , `article`.`createTime`
                FROM  `article`
                WHERE type = 1
                ORDER BY `article`.`articleId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $alleducationData = $res->fetchAll();

            $this->smarty->assign('alleducationData', $alleducationData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('education/educationList.html');
        }
    }

    /**
     * 刪除衛教
     */
    public function educationDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            //
            $this->db->beginTransaction();
            $sql = "DELETE FROM `article` WHERE `articleId` = :educationId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':educationId', $input['educationId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->error = '';
            $this->msg = '刪除成功';
            $this->educationList();
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
