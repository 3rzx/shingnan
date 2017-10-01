<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
 */
class Lease
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
     * class constructor
     * @DateTime 2016-09-03
     */
    public function __construct()
    {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();
    }


    /**
     * 顯示login form
     * @DateTime 2016-09-11
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }


    /**
     * 顯示行動導覽裝置清單
     * @DateTime 2016-09-011
     */
    public function viewLeaseList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
            			FROM lease
            			ORDER BY id';
                $res = $this->db->prepare($sql);
                $res->execute();
                $leaseData = $res->fetchAll();

                $this->smarty->assign('leaseData', $leaseData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('lease/leaseList.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }


    /**
     * 顯示增加行動導覽裝置畫面
     * @DateTime 2016-09-11
     * @param    array     $input [未知]
     */
    public function viewAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('lease/leaseAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }


    /**
     * 顯示租借行動導覽裝置畫面
     * @DateTime 2016-09-11
     * @param    array     $input [未知]
     */
    public function viewAddRent()
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from users
            $sql = 'SELECT *
                    FROM lease
                    WHERE borrower IS NULL';
            $res = $this->db->prepare($sql);
            $res->execute();
            $padData = $res->fetchAll();

            $this->smarty->assign('padData', $padData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('lease/leaseRent.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }


    /**
     * 顯示編輯行動導覽裝置畫面
     * @DateTime 2016-09-12
     */
    public function viewEditPad($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT *
                    FROM lease
                    WHERE id = :id';
            $res = $this->db->prepare($sql);
            $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
            $res->execute();
            $leaseData = $res->fetchAll();

            $this->smarty->assign('leaseData', $leaseData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('lease/leaseEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }


    /**
     * 顯示歸還行動導覽裝置畫面
     * @DateTime 2016-09-12
     */
    public function viewReturn()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
                        FROM lease
                        WHERE borrower IS NOT NULL';
                $res = $this->db->prepare($sql);
                $res->execute();
                $leaseData = $res->fetchAll();

                $this->smarty->assign('leaseData', $leaseData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('lease/leaseReturn.html');
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }


    /**
     * 新增行動導覽裝置
     * @DateTime 2016-09-11
     * @param    array     $input [使用者資料]
     */
    public function addPad($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT pad_id
                        FROM lease
                        WHERE pad_id = :pad_id";
                $res = $this->db->prepare($sql);
                $res->bindParam(':pad_id', $input['pad_id'], PDO::PARAM_STR);
                $res->execute();
                $rows = $res->fetchAll();
                if (count($rows) == 1) {
                    $this->error = '此Pad ID已被使用';
                    $this->viewAddForm();
                } else {
                    $sql = "INSERT INTO lease (pad_id)
                            VALUES (:pad_id)";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':pad_id', $input['pad_id'], PDO::PARAM_STR);
                    if ($res->execute()) {
                        $this->error = '';
                        header('Location:../controller/leaseController.php?action=viewLeaseList');
                    } else {
                        $error = $res->errorInfo();

                        $this->error = $error[0];
                        $this->viewLeaseList();
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
     * 新增行動導覽裝置
     * @DateTime 2016-09-11
     * @param    array     $input [使用者資料]
     */
    public function EditPad($input)
    {
        if ($_SESSION['isLogin'] == true) {
           $sql = 'UPDATE lease
                SET pad_id = :pad_id
                WHERE id = :id';
            $res = $this->db->prepare($sql);
            $res->bindParam(':pad_id', $input['pad_id'], PDO::PARAM_STR);
            $res->bindParam(':id', $input['id'], PDO::PARAM_INT);
            $res->execute();
            $this->error = '';
            $this->msg   = '編輯成功';
            $this->viewLeaseList();
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }


    /**
     * 新增租借行動導覽裝置
     * @DateTime 2016-09-11
     * @param    array     $input [使用者資料]
     */
    public function addRent($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = "SELECT id
                        FROM lease
                        WHERE pad_id = :pad_id";
                $res = $this->db->prepare($sql);
                $res->bindParam(':pad_id', $input['padID'], PDO::PARAM_STR);
                $res->execute();
                $rows = $res->fetchAll();
                $now  = date('Y-m-d H:i:s');
                $sql = "UPDATE lease
                        SET borrower = :borrower, borrower_tel = :borrower_tel, lease_date = :lease_date, return_date = NULL
                        WHERE pad_id = :pad_Id";
                $res = $this->db->prepare($sql);
                $res->bindParam(':borrower', $input['borrower'], PDO::PARAM_STR);
                $res->bindParam(':borrower_tel', $input['tel'], PDO::PARAM_STR);
                $res->bindParam(':lease_date', $now, PDO::PARAM_STR);
                $res->bindParam(':pad_Id', $input['padID'], PDO::PARAM_STR);
                $res->execute();
                $this->error = '';
                $this->msg   = '租借成功';
                $this->viewReturn();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }



    /**
     * 刪除平板
     * @DateTime 2016-09-12
     * @param    array     $input [平板id]
     */
    public function deletePad($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $padId = $input['padId'];
                $sql    = "DELETE FROM lease
                           WHERE pad_id = '$padId'";
                $this->db->exec($sql);
                $this->db->commit();

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->viewLeaseList();
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
     * 歸還平板
     * @DateTime 2016-09-12
     * @param    array     $input [平板id]
     */
    public function returnPad($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $now  = date('Y-m-d H:i:s');
                $sql = "UPDATE lease
                        SET borrower = NULL, borrower_tel = NULL, return_date = :return_date
                        WHERE pad_id = :pad_Id";
                $res = $this->db->prepare($sql);
                $res->bindParam(':return_date', $now, PDO::PARAM_STR);
                $res->bindParam(':pad_Id', $input['padId'], PDO::PARAM_STR);
                $res->execute();
                $this->error = '';
                $this->msg   = '歸還成功';
                $this->viewReturn();
            } catch (PDOException $e) {
                $this->db->rollBack();
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
