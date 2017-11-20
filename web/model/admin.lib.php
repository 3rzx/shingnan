<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 管理者類別
 */
class Admin
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
     * Admin constructor
     * @DateTime 2017-11-20
     */
    public function __construct()
    {
        // Enable a session
        session_start();
        $this->db = dbSetup::getDbConn();
        $this->smarty = new SmartyConfig();
    }

    /**
     * 顯示登入畫面
     * @DateTime 2017-11-20
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

    /**
     * 驗證輸入
     * @DateTime 2017-11-20
     * @param    array     $input [帳密]
     * @return   boolean          [是否為有效輸入]
     */
    public function isValidInput($input)
    {
        // 清除空格
        $input['account']  = trim($input['account']);
        $input['password'] = trim($input['password']);

        // 測試是否為空值
        if (strlen($input['account']) == 0) {
            $this->error = '帳號不得為空值';
            return false;
        }
        if (strlen($input['password']) == 0) {
            $this->error = '密碼不得為空值';
            return false;
        }
        $this->error = '';

        return true;
    }

    /**
     * 登入
     * @DateTime 2017-11-20
     * @param    array     $input [帳密]
     */
    public function login($input)
    {
        try {
            //驗證帳密
            $file = fopen('../userkey', 'r');
            $account = trim(fgets($file));
            $pass = fgets($file);
            fclose($file);

            if($input['account'] == $account){
                if (password_verify($input['password'], $pass)) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['user']    = array(
                        'account'      => $input['account'],
                        'userId'       => 'glassAdmin',
                    );

                    $this->error = '';
                    header('Location:' . APP_ROOT_DIR . 'controller/adminController.php?action=main');
                } else {
                    $this->error = '密碼輸入錯誤';
                    $this->viewLogin();
                }
            } else {
                $this->error = '帳號輸入錯誤';
                $this->viewLogin();
            }
        } catch (Exception $e) {
            print 'Exception : ' . $e->getMessage();
        }
    }

    /**
     * 顯示主畫面
     * @DateTime 2017-11-20
     */
    public function viewMain()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('main.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 登出
     * @DateTime 2017-11-20
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        $this->viewLogin();
    }
}
