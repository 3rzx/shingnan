<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 鏡片類別
 */
class Glass
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
     * 新增鏡片格式
     */
    public function glassAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $sql = "SELECT `brandId`, `brandName` FROM `brand` WHERE `isDelete` = 0 ;" ;
            $res = $this->db->prepare($sql);
            $res->execute();
            $brandData = $res->fetchAll();
            $this->smarty->assign('brandData',$brandData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('glass/glassAdd.html');
        }
    }

    /**
     * 新增鏡片
     */
    public function glassAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $glassId = $idGen->GetID('glass');
            $sql = "INSERT INTO `shingnan`.`glass` (`glassId`, `no`, `glassName`, `brandId`, `type`, `memo`, 
                                                    `isDelete`, `lastUpdateTime`, `createTime`) 
                    VALUES (:glassId, :glassNo, :glassName, :glassBrand, :glassType, :memo, 
                            '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':glassId', $glassId, PDO::PARAM_STR);
            $res->bindParam(':glassNo', $input['glassNo'], PDO::PARAM_STR);
            $res->bindParam(':glassName', $input['glassName'], PDO::PARAM_STR);
            $res->bindParam(':glassBrand', $input['glassBrand'], PDO::PARAM_STR);
            $res->bindParam(':glassType', $input['type'], PDO::PARAM_STR);
            $res->bindParam(':memo', $input['memo'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $error[0];
                $this->glassList();
            }
           $this->glassList();
        }
    }

    /**
     * 編輯鏡片前置
     */
    public function glassEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
         $sql = "SELECT `glass`.`glassId`, `glass`.`glassName`, `glass`.`no`, `glass`.`brandId`, `glass`.`type`, `glass`.`memo` 
                FROM  `glass` 
                WHERE  `glass`.`isDelete` = 0 AND  `glass`.`glassId` = :glassId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);
        $res->execute();
        $glassData = $res->fetch();
        $this->smarty->assign('glassData', $glassData);
        
        $sql = "SELECT `brandId`, `brandName` FROM `brand` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $brandData = $res->fetchAll();
        $this->smarty->assign('brandData',$brandData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('glass/glassEdit.html');
    }}

    /**
     * 編輯鏡片
     */
    public function glassEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE  `shingnan`.`glass` SET  `glassName` = :glassName, `brandId`= :brandId, `no` = :no, `type` = :type, `memo` = :memo,
                `lastUpdateTime` =  :lastUpdateTime WHERE `glass`.`glassId` = :glassId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);        
        $res->bindParam(':no', $input['glassNo'], PDO::PARAM_STR);
        $res->bindParam(':glassName', $input['glassName'], PDO::PARAM_STR);
        $res->bindParam(':brandId', $input['glassBrand'], PDO::PARAM_STR);
        $res->bindParam(':type', $input['type'], PDO::PARAM_STR);
        $res->bindParam(':memo', $input['memo'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();

        if (!$res) { 
            $error = $res->errorInfo();
            $this->error = $error[0];
            $this->glassList();
        }
        $this->glassList();
    }
    }

    /**
     * 顯示所有鏡片列表
     */
    public function glassList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
        // get all data from glass
        $sql = 'SELECT `glass`.`glassId`, `glass`.`no`, `glass`.`glassName`, `glass`.`type`, `glass`.`memo`, `glass`.`lastUpdateTime`, 
                        `brand`.`brandName` 
                FROM `glass`,  `brand` 
                WHERE `glass`.`isDelete`= 0 
                AND `brand`.`brandId` = `glass`.`brandId` 
                ORDER BY `glass`.`glassId`';
        $res = $this->db->prepare($sql);
        $res->execute();
        $allGlassData = $res->fetchAll();

        $this->smarty->assign('allGlassData', $allGlassData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('glass/glassList.html');
        }
    }
    

    /**
     * 刪除鏡片
     */
    public function glassDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`glass` SET  `isDelete` = 1, `lastUpdateTime` = :lastUpdateTime WHERE `glass`.`glassId` = :glassId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();
        $this->glassList();
    }
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
