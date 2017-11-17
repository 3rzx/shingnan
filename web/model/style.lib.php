<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
 */
class Style
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
    public function __construct() {
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
     * 新增風格格式
     */
    public function styleAdd() {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('style/styleAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增風格
     */
    public function styleAdd($input) {
        if ($_SESSION['isLogin'] == true) {
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $this->db->beginTransaction();
            $sql = "INSERT INTO `shingnan`.`style` (`styleId`, `styleName`, `isDelete`, `lastUpdateTime`, `createTime`) VALUES (:styleId, :styleName, '0', :lastUpdateTime, :createTime);";
            $res->bindParam(':styleId', $idGen.GetID('style'), PDO::PARAM_STR);
            $res->bindParam(':styleName', $input['styleName'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            $this->db->exec($sql);
            $this->db->commit();

            //deal with insert image

            $this->smarty->assign('error', $this->error);
            $this->styleList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯風格
     */
    public function styleEdit($input) {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT * FROM style WHERE ';
            $res = $this->db->prepare($sql);
            $res->execute();
            $styleData = $res->fetchAll();

            //get image 
            $sql = 'SELECT path
                    FROM image
                    WHERE type = ? and itemId = ?'
            $this->smarty->assign('error', $this->error);
            $this->styleList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示所有風格列表
     */
    public function styleList() {
        if ($_SESSION['isLogin'] == true) {
            // get all data from style
            $sql = 'SELECT *
            		FROM style';
            $res = $this->db->prepare($sql);
            $res->execute();
            $styleData = $res->fetchAll();

            $this->smarty->assign('styelData', $styleData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('style/styleList.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    

    /**
     * 刪除風格
     */
    public function styleDelete($input) {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $sql    = "DELETE FROM style
                           WHERE styleId = :styleId";
                $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
                $this->db->exec($sql);
                $this->db->commit();

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->smarty->display('style/styleList.html');
            } catch (PDOException $e) {
                $this->db->rollBack();
                print "Error!: " . $e->getMessage();
            }
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
