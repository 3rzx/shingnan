<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
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
    /**
     * 驗證輸入
     * @DateTime 2016-09-03
     * @param    array     $input [帳密]
     * @return   boolean          [是否為有效輸入]
     */
    public function isValidInput($input)
    {
        // 清除空格
        $input['account']    = trim($input['account']);
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
     * @DateTime 2016-09-03
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
                        'userId'     => $rows[0]['user_id'],
                        'competence' => $rows[0]['competence'],
                    );

                    // 更新最後登入時間
                    $now = date('Y-m-d H:i:s');
                    $sql = "UPDATE users
                        SET last_login = :lastLogin
                        WHERE user_id = :userId";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':lastLogin', $now, PDO::PARAM_STR);
                    $res->bindParam(':userId', $rows[0]['user_id'], PDO::PARAM_INT);
                    $res->execute();

                    $this->error = '';

                    header('Location: ' . APP_ROOT_DIR . 'controller/userController.php?action=main');
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
     * 移除 utf-8 檔案的 bom
     */
    public function removeBOM($str)
    {
        if (substr($str, 0, 3) == pack("CCC", 0xef, 0xbb, 0xbf))
            $str = substr($str, 3);

        return $str;
    }

    /**
     * 顯示主畫面
     * @DateTime 2016-09-03
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
     * 顯示增加使用者畫面
     * @DateTime 2016-09-03
     * @param    array     $input [未知]
     */
    public function viewAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('user/userAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增使用者
     * @DateTime 2016-09-03
     * @param    array     $input [使用者資料]
     */
    public function addUser($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT email
                        FROM users
                        WHERE email = :email";
                $res = $this->db->prepare($sql);
                $res->bindParam(':email', $input['email'], PDO::PARAM_STR);
                $res->execute();
                $rows = $res->fetchAll();
                if (count($rows) == 1) {
                    $this->error = 'E-mail已有人使用';
                    $this->viewAddForm();
                } else {
                    $now  = date('Y-m-d H:i:s');
                    $pass = password_hash($input['password'], PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (email, password, competence, last_login, create_date, lastupdate_date)
                            VALUES (:email, :password, :competence, :lastLogin, :createDate, :lastupdateDate)";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':email', $input['email'], PDO::PARAM_STR);
                    $res->bindParam(':password', $pass, PDO::PARAM_STR);
                    $res->bindParam(':competence', $input['competence'], PDO::PARAM_INT);
                    $res->bindValue(':lastLogin', '0000-00-00 00:00:00', PDO::PARAM_STR);
                    $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                    if ($res->execute()) {
                        $this->error = '';
                        $this->msg   = '新增成功';
                        $this->viewUserList();
                    } else {
                        $error = $res->errorInfo();

                        $this->error = $error[0];
                        $this->viewAddForm();
                    }
                }
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示編輯使用者畫面
     * @DateTime 2016-09-03
     * @param    array     $input [使用者ID]
     */
    public function viewEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from users
            $sql = 'SELECT *
            		FROM users
            		WHERE user_id = :userId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':userId', $input['userId'], PDO::PARAM_INT);
            $res->execute();
            $userData = $res->fetchAll();

            $this->smarty->assign('userData', $userData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('user/userEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 更新使用者資料
     * @DateTime 2016-09-04
     * @param    array     $input [使用者資料]
     * @return   json             [使用者更新後的資料]
     */
    public function updateUser($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $now = date('Y-m-d H:i:s');
                // update data from users
                if ($input['password'] == '') {
                    $sql = 'UPDATE users
                        SET email = :email, competence = :competence, lastupdate_date = :lastupdateDate
                        WHERE user_id = :userId';
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':email', $input['email'], PDO::PARAM_STR);
                    $res->bindParam(':competence', $input['competence'], PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':userId', $input['userId'], PDO::PARAM_INT);
                    $res->execute();
                } else {
                    $pass = password_hash($input['password'], PASSWORD_DEFAULT);
                    $sql  = 'UPDATE users
                        SET email = :email, competence = :competence, password = :password, lastupdate_date = :lastupdateDate
                        WHERE user_id = :userId';
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':email', $input['email'], PDO::PARAM_STR);
                    $res->bindParam(':competence', $input['competence'], PDO::PARAM_STR);
                    $res->bindParam(':password', $pass, PDO::PARAM_STR);
                    $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                    $res->bindParam(':userId', $input['userId'], PDO::PARAM_INT);
                    $res->execute();
                }

                $this->error = '';
                $this->msg   = '更新成功';
                $this->viewUserList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除使用者
     * @DateTime 2016-09-04
     * @param    array     $input [使用者id]
     */
    public function deleteUser($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $userId = $input['userId'];
                $sql    = "DELETE FROM users
                           WHERE user_id = $userId";
                $this->db->exec($sql);
                $this->db->commit();

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->viewUserList();
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
     * 顯示使用者清單
     * @DateTime 2016-09-04
     */
    public function viewUserList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
            			FROM users
            			ORDER BY email';
                $res = $this->db->prepare($sql);
                $res->execute();
                $userData = $res->fetchAll();

                $this->smarty->assign('userData', $userData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('user/userList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->viewLogin();
    }
}
