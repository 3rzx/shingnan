<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 隱形眼鏡類別
 */
class Len
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
     * 新增隱形眼鏡格式
     */
    public function lenAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $sql = "SELECT `brandId`, `brandName` FROM `brand` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $brandData = $res->fetchAll();
        $this->smarty->assign('brandData',$brandData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('len/lenAdd.html');
    }

    /**
     * 新增隱形眼鏡
     */
    public function lenAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $lenId = $idGen->GetID('len');
        echo $input['quantity'];
        $sql = "INSERT INTO `shingnan`.`len` (`lenId`, `lenName`, `brandId`, `quantity`, `size`, `period`, 
                                              `color`, `isDelete`, `lastUpdateTime`, `createTime`) 
                VALUES (:lenId, :lenName, :lenBrand, :quantity, :size, :period, 
                        :color, 0, :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $lenId, PDO::PARAM_STR);
        $res->bindParam(':lenName', $input['lenName'], PDO::PARAM_STR);
        $res->bindParam(':lenBrand', $input['lenBrand'], PDO::PARAM_STR);
        $res->bindParam(':quantity', $input['quantity'], PDO::PARAM_INT);
        $res->bindParam(':size', $input['size'], PDO::PARAM_STR);
        $res->bindParam(':period', $input['period'], PDO::PARAM_INT);
        $res->bindParam(':color', $input['color'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        $res->execute();
        if (!$res) { 
            $error = $res->errorInfo();
            $this->error = $error[0];
            $this->lenList();
        }
       $this->lenList();
    }

    /**
     * 編輯隱形眼鏡前置
     */
    public function lenEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $sql = "SELECT `len`.`lenName`, `len`.`lenId`, `len`.`brandId`, `len`.`quantity`, `len`.`size`, `len`.`period`, `len`.`color` 
                FROM `len` 
                WHERE `len`.`isDelete` = 0 AND `len`.`lenId` = :lenId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
        $res->execute();
        $lenData = $res->fetch();
        $this->smarty->assign('lenData', $lenData);

        $sql = "SELECT `brandId`, `brandName` FROM `brand` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $brandData = $res->fetchAll();
        $this->smarty->assign('brandData',$brandData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('len/lenEdit.html');
    }

    /**
     * 編輯隱形眼鏡
     */
    public function lenEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE  `shingnan`.`len` SET  `lenName` = :lenName, `brandId` = :lenBrand, `quantity` = :quantity, 
                        `period` =  :period, `size` =  :size, `color` =  :color, `lastUpdateTime` = :lastUpdateTime 
                WHERE `len`.`lenId` = :lenId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
        $res->bindParam(':lenName',$input['lenName'], PDO::PARAM_STR);
        $res->bindParam(':lenBrand', $input['lenBrand'], PDO::PARAM_STR);
        $res->bindParam(':quantity', $input['quantity'], PDO::PARAM_INT);
        $res->bindParam(':size', $input['size'], PDO::PARAM_STR);
        $res->bindParam(':period', $input['period'], PDO::PARAM_INT);
        $res->bindParam(':color', $input['color'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
        $res->execute();
        if (!$res) { 
            $error = $res->errorInfo();
            $this->error = $error[0];
            $this->lenList();
        }
        $this->lenList();
    }

    /**
     * 顯示所有隱形眼鏡列表
     */
    public function lenList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from len
        $sql = 'SELECT `len`.`lenId`, `len`.`lenName`, `len`.`brandId`, `len`.`quantity`, `len`.`size`, `len`.`period`,`len`.`color`,          `len`.`lastUpdateTime`, `brand`.`brandName` 
                FROM  `len` ,  `brand` 
                WHERE  `len`.`brandId` =  `brand`.`brandId` 
                AND  `len`.`isDelete` = 0 
                ORDER BY  `lenId` ';
        $res = $this->db->prepare($sql);
        $res->execute();
        $allLenData = $res->fetchAll();

        $this->smarty->assign('allLenData', $allLenData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('len/lenList.html');
        
    }
    

    /**
     * 刪除隱形眼鏡
     */
    public function lenDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`len` SET  `isDelete` = 1, `lastUpdateTime` = :lastUpdateTime WHERE lenId = :lenId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->lenList();
    }

    /**
     * 顯示登入畫面
     */
    public function viewLogin(){
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }
}
