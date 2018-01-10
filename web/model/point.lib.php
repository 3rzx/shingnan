<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'pointFile.php';
/**
 * 品牌類別
 */
class Point
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
     * 編輯品牌前置
     */
    public function PointEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $pointFile = new pointFile();
        $oldRate = $pointFile->GetRate();
        $this->smarty->assign('oldRate', $oldRate);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('Point/PointEdit.html');
    }

    /**
     * 編輯品牌
     */
    public function PointEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $newRate = $input['pointNewRate'];
        $pointFile = new pointFile();
        $pointFile->SetRate($newRate);
        $this->smarty->assign('oldRate', $newRate);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('Point/PointEdit.html');
    }

    /**
     * 顯示登入畫面
     * @DateTime 2016-09-03
     */
    public function viewLogin(){
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

}
