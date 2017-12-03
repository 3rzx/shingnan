<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
 */
class User
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
     * 新增使用者頁面
     */
    public function userAddPrepare()
    {
//GET
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }
        
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('user/userAdd.html');
    }

    /**
     * 新增使用者動作
     */
    public function userAdd($input)
    {
//POST
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $this->userAddSql($input);
        $this->smarty->display('user/userAdd.html');
    }

    public function userAddSql($input)
    {
        $idGen = new IdGenerator();
        $userId = $idGen->GetID('user');
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `shingnan`.`user` (
        `userId`, `userName`, `account`,`password`,`phone`,
        `gender`,`address`, `point`,`introducerId`,`downlineNum`,
        `isDelete`, `lastUpdateTime`,`createTime`)
        VALUES (:userId, :userName, :account, :password, :phone,
        :gender, '', 0, NULL,0,
        0,:lastUpdateTime, :createTime);";

        $res = $this->db->prepare($sql);
        var_dump($now);

        $res->bindParam(':userId', $userId, PDO::PARAM_STR);
        $res->bindParam(':userName', $input['userName'], PDO::PARAM_STR);
        $res->bindParam(':gender', intval($input['gender']), PDO::PARAM_INT);
        $res->bindParam(':phone', $input['phone'], PDO::PARAM_STR);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        $res->bindParam(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);

        if ($res->execute()) {
            $this->$msg = '新增成功';
        }

        $error = $res->errorInfo();
        $this->$error = $error[0];
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
