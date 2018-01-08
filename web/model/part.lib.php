<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 零件類別
 */
class Part
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
     * 新增零件格式
     */
    public function partAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('part/partAdd.html');
    }

    /**
     * 新增零件
     */
    public function partAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        if(!isset($input['partName'])){
            $this->error = '請至少填入零件名稱';
            $this->partAddPrepare();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $partId = $idGen->GetID('part'); 

        $sql = "INSERT INTO `shingnan`.`part` (`partId`, `partName`, `type`, `size`, `isDelete`, `lastUpdateTime`, `createTime`) 
                VALUES ( :partId , :partName , :partType, :partSize, '0', :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':partId', $partId, PDO::PARAM_STR);
        $res->bindParam(':partName', $input['partName'], PDO::PARAM_STR);
        $res->bindParam(':partType', $input['partType'], PDO::PARAM_INT);
        $res->bindParam(':partSize', $input['partSize'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
            $this->msg = '資料新增成功';
        }else{
            $error = $res->errorInfo();
            $this->error = $error[0];
        }
       $this->partList();
    }

    /**
     * 編輯零件前置
     */
    public function partEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $sql = "SELECT `part`.`partName`, `part`.`partId` , `part`.`type`, `part`.`size`  
                FROM  `part` 
                WHERE  `part`.`isDelete` = 0 AND  `part`.`partId` = :partId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':partId', $input['partId'], PDO::PARAM_STR);
        $res->execute();
        $partData = $res->fetch();

        $this->smarty->assign('partData', $partData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('part/partEdit.html');
    }

    /**
     * 編輯零件
     */
    public function partEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`part` SET  `partName` = :partName, `type` = :partType, `size` = :partSize, 
                `lastUpdateTime` =  :lastUpdateTime WHERE `part`.`partId` = :partId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':partId', $input['partId'], PDO::PARAM_STR);
        $res->bindParam(':partName',$input['partName'], PDO::PARAM_STR);
        $res->bindParam(':partType', $input['partType'], PDO::PARAM_INT);
        $res->bindParam(':partSize', $input['partSize'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
        if ($res->execute()) {
            $this->msg = '資料新增成功';
        }else{
            $error = $res->errorInfo();
            $this->error = $error[0];
        }
       $this->partList();
    }

    /**
     * 顯示所有零件列表
     */
    public function partList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from part
        $sql = 'SELECT `part`.`partId`, `part`.`partName`, `part`.`type`, `part`.`size`, `part`.`lastUpdateTime` 
                FROM `part` 
                WHERE `part`.`isDelete` = 0 
                ORDER BY `part`.`partId`';
        $res = $this->db->prepare($sql);
        $res->execute();
        $allPartData = $res->fetchAll();

        $this->smarty->assign('allPartData', $allPartData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('part/partList.html');
        
    }
    

    /**
     * 刪除零件
     */
    public function partDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }

        //deal with data
        $this->db->beginTransaction();
        $sql = "DELETE FROM part WHERE partId = :partId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':partId', $input['partId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->partList();
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
