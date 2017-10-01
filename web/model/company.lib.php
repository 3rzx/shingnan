<?php
// initialize
require_once HOME_DIR . 'configs/config.php';

/**
 * 使用者類別
 */
class Company
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
     * @DateTime 2016-09-10
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
     * @DateTime 2016-09-10
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }
    /**
     * 顯示增加Company畫面
     * @DateTime 2016-09-13
     * @param    array     $input [未知]
     */
    public function viewAddForm()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('company/companyAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增Company
     * @DateTime 2016-09-13
     * @param    array     $input [Company資料]
     */
    public function addCompany($input)
    {
        if ($_SESSION['isLogin'] == true) {

            //upload qrcode
            $newFilePath = '';
            if((isset($_FILES["qrcode"])) && ($_FILES["qrcode"]["size"] > 0)){
                if($_FILES["qrcode"]["error"] > 0){
                    $this->error = '檔案上傳錯誤!';
                } else{
                    $file_tmp = explode(".", $_FILES['qrcode']['name']);

                    $uploadPath = '../media/company';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }
                        
                    $newFilePath = $uploadPath . '/'.uniqid($file_tmp[0], true);
                    move_uploaded_file($_FILES['qrcode']['tmp_name'], $newFilePath);//複製檔案
                }
            }

            try {
                $now  = date('Y-m-d H:i:s');

                $sql = "INSERT INTO company (name, name_en, tel, fax, addr, web, qrcode, create_date, lastupdate_date)
                        VALUES (:name, :nameEn, :tel, :fax, :addr, :web, :qrcode, :createDate, :lastupdateDate)";
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['nameEn'], PDO::PARAM_STR);
                $res->bindParam(':tel', $input['tel'], PDO::PARAM_STR);
                $res->bindValue(':fax', $input['fax'], PDO::PARAM_STR);
                $res->bindValue(':addr', $input['addr'], PDO::PARAM_STR);
                $res->bindValue(':web', $input['web'], PDO::PARAM_STR);
                $res->bindValue(':qrcode', $newFilePath, PDO::PARAM_STR);
                $res->bindParam(':createDate', $now, PDO::PARAM_STR);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);

                if ($res->execute()) {
                    $companyId      = $this->db->lastInsertId();
                    $this->error = '';
                    header('Location:../controller/companyController.php?action=viewCompanyList');
                } else {
                    $error = $res->errorInfo();

                    $this->error = $error[0];
                    $this->viewAddForm();
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
     * 顯示編輯Company畫面
     * @DateTime 2016-09-13
     * @param    array     $input [CompanyID]
     */
    public function viewEditForm($input)
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from company
            $sql = 'SELECT *
            		FROM company
            		WHERE company_id = :companyId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':companyId', $input['companyId'], PDO::PARAM_INT);
            $res->execute();
            $companyData = $res->fetchAll();

            $this->smarty->assign('companyData', $companyData[0]);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('homePath', APP_ROOT_DIR);
            $this->smarty->display('company/companyEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    /**
     * 更新Company資料
     * @DateTime 2016-09-13
     * @param    array     $input [Company資料]
     * @return   json             [Company更新後的資料]
     */
    public function updateCompany($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                //get the new qrcode file path
                $newFilePath = '';
                if((isset($_FILES["qrcode"])) && ($_FILES["qrcode"]["size"] > 0)){
                    unlink($input['oldqrcode']);

                    if($_FILES["qrcode"]["error"] > 0){
                        $this->error = '檔案上傳錯誤!';
                    } else{
                        $file_tmp = explode(".", $_FILES['qrcode']['name']);
                        
                        $newFilePath = '../media/company/'.uniqid($file_tmp[0], true);
                        move_uploaded_file($_FILES['qrcode']['tmp_name'], $newFilePath);//複製檔案
                    }
                }
                else{
                    $newFilePath = $input['oldqrcode'];
                }

                // update data from company
                $sql = 'UPDATE company
                    SET name = :name, name_en = :nameEn, tel = :tel, fax = :fax, addr = :addr, web = :web, qrcode = :qrcode
                    WHERE company_id = :companyId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':name', $input['name'], PDO::PARAM_STR);
                $res->bindParam(':nameEn', $input['nameEn'], PDO::PARAM_STR);
                $res->bindParam(':tel', $input['tel'], PDO::PARAM_STR);
                $res->bindValue(':fax', $input['fax'], PDO::PARAM_STR);
                $res->bindValue(':addr', $input['addr'], PDO::PARAM_STR);
                $res->bindValue(':web', $input['web'], PDO::PARAM_STR);
                $res->bindValue(':qrcode', $newFilePath, PDO::PARAM_STR);
                $res->bindParam(':companyId', $input['companyId'], PDO::PARAM_INT);
                $res->execute();
                // 更新最後修改時間
                $now = date('Y-m-d H:i:s');
                $sql = "UPDATE company
                    SET lastupdate_date = :lastupdateDate
                    WHERE company_id = :companyId";
                $res = $this->db->prepare($sql);
                $res->bindParam(':lastupdateDate', $now, PDO::PARAM_STR);
                $res->bindParam(':companyId', $input['companyId'], PDO::PARAM_INT);
                $res->execute();

                $this->error = '';
                $this->msg   = '更新成功';
                $this->viewCompanyList();
            } catch (PDOException $e) {
                print_r("Error!: " . $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除Company
     * @DateTime 2016-09-13
     * @param    array     $input [Companyid]
     */
    public function deleteCompany($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                //get file path
                $sql = 'SELECT qrcode
                    FROM company
                    WHERE company_id = :companyId';
                $res = $this->db->prepare($sql);
                $res->bindParam(':companyId', $input['companyId'], PDO::PARAM_INT);
                $res->execute();
                $file = $res->fetchAll();

                $this->db->beginTransaction();
                $companyId = $input['companyId'];
                $sql    = "DELETE FROM company
                           WHERE company_id = $companyId";
                $this->db->exec($sql);
                $this->db->commit();

                if(file_exists($file[0]['qrcode'])){
                    unlink($file[0]['qrcode']);
                }

                $this->error = '';
                $this->msg   = '刪除成功';
                $this->viewCompanyList();
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
     * 顯示Company清單
     * @DateTime 2016-09-13
     */
    public function viewCompanyList()
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $sql = 'SELECT *
            			FROM company
            			ORDER BY company_id';
                $res = $this->db->prepare($sql);
                $res->execute();
                $companyData = $res->fetchAll();

                $this->smarty->assign('companyData', $companyData);
                $this->smarty->assign('msg', $this->msg);
                $this->smarty->assign('error', $this->error);
                $this->smarty->assign('homePath', APP_ROOT_DIR);
                $this->smarty->display('company/companyList.html');
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
