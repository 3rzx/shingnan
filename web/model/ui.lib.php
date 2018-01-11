<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
/**
 * 前台 UI 設定
 */
class Ui
{
    public $db = null;
    public $smarty = null;
    public $msg = '';
    public $error = '';
    public $admin = null;

    /**
     * Statistic constructor
     */
    public function __construct() {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();

        if (PHP_VERSION_ID < 50400) {
            // 登記 Session 變數名稱
            session_register('isLogin');
            session_register('user');
            session_register('error');
            session_register('msg');
        }
    }

    /**
     * 顯示首頁封面設定
     */
    public function viewIndexCover() {
        // cover => index_item_00
        // 01~20 => index_item_01~20
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT * FROM `image` WHERE `itemId` like 'index_%'";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $images = $res->fetchAll();
                $this->setResultMsg();

                $this->smarty->assign('images', $images);             
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('ui/indexCoverSet.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 顯示商品點閱率
     */
    public function editIndexCover() {
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT `frame`.*";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $frameList = $res->fetchAll();
                $this->setResultMsg();
                

                $this->smarty->assign('frameList', $frameList);
                $this->smarty->assign('shapeMap', $shapeMap);
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('statistic/goodsClick.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 設定訊息
     */
    public function setResultMsg($resultMsg = 'success', $errorMsg = '') {
        $this->msg = $resultMsg;
        $this->error = $errorMsg;
    }

    /**
     * 顯示登入畫面
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }
}
