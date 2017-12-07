<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
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
     * 新增風格格式
     */
    public function glassAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('glass/glassAdd.html');
    }

    /**
     * 新增風格
     */
    public function glassAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $glassId = $idGen->GetID('glass');
        $sql = "INSERT INTO `shingnan`.`glass` (`glassId`, `glassName`, `isDelete`, `description`,`lastUpdateTime`, `createTime`) 
                    VALUES (:glassId, :glassName, '0', :description, :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $glassId, PDO::PARAM_STR);
        $res->bindParam(':glassName', $input['glassName'], PDO::PARAM_STR);
        $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
        //deal with insert image
            $this->msg = '新增成功';
            $uploadPath = '../media/picture';
            if ($_FILES['glassImage']['error'] == 0) {
                $imgId = $idGen->GetID('image');
                $imgName = 'glass_'.$input['glassName'];
                $fileInfo = $_FILES['glassImage'];
                $glassImage = uploadFile($fileInfo, $uploadPath);
                $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                        `itemId`, `ctr`, `path`, `link`, `createTime`) 
                        VALUES (:imgId, :imgName, 3, 
                                :glassId, 0, :filePath, '', :createTime);";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                $res->bindParam(':glassId', $glassId, PDO::PARAM_STR);
                $res->bindParam(':filePath', $glassImage, PDO::PARAM_STR);
                $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                $res->execute();
                if (!$res) { 
                    $error = $res->errorInfo();
                    $this->error = $error[0];
                    $this->glassList();
                }
            }
        }
       $this->glassList();
    }

    /**
     * 編輯風格前置
     */
    public function glassEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
         $sql = "SELECT `glass`.`glassName`, `glass`.`glassId` , `glass`.`description`, `image`.`imageId` ,`image`.`path` 
                FROM  `glass` 
                LEFT JOIN  `image` ON glass.`glassId` = image.`itemId` 
                WHERE  `glass`.`isDelete` = 0 AND  `glass`.`glassId` = :glassId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);
        $res->execute();
        $glassData = $res->fetch();

        $this->smarty->assign('glassData', $glassData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('glass/glassEdit.html');
    }

    /**
     * 編輯風格
     */
    public function glassEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE  `shingnan`.`glass` SET  `glassName` = :glassName, `description` = :description, 
                `lastUpdateTime` =  :lastUpdateTime WHERE  `glass`.`glassId` = :glassId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);
        $res->bindParam(':glassName',$input['glassName'], PDO::PARAM_STR);
        $res->bindParam(':description',$input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
        $res->execute();

        if ($res->execute()) {
        //update image 
            $this->msg = '更新成功';
            if ($_FILES['glassImage']['error'] == 0) {
                if( isset($input['imageId']) ){                
                    $fileInfo = $_FILES['glassImage'];
                    $glassImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                    $res->bindParam(':pathinfo', $glassImage, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->glassList();
                    }
                }else{
                    $idGen = new IdGenerator();
                    $imgId = $idGen->GetID('image');
                    $imgName = 'glass_'.$input['glassName'];
                    $fileInfo = $_FILES['glassImage'];
                    $glassImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 3, 
                                    :glassId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);
                    $res->bindParam(':filePath', $glassImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->glassList();
                    }
                }
            }
        }
        $this->glassList();
    }

    /**
     * 顯示所有風格列表
     */
    public function glassList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from glass
        $sql = 'SELECT `glass`.`glassName`, `glass`.`glassId` , `glass`.`description`, `glass`.`lastUpdateTime`,
                        `image`.`imageId`,`image`.`path` 
                FROM  `glass` 
                LEFT JOIN  `image` ON `glass`.`glassId` = `image`.`itemId` 
                WHERE  `glass`.`isDelete` = 0
                ORDER BY `glass`.`glassId`';
        $res = $this->db->prepare($sql);
        $res->execute();
        $allglassData = $res->fetchAll();

        $this->smarty->assign('allglassData', $allglassData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('glass/glassList.html');
        
    }
    

    /**
     * 刪除風格
     */
    public function glassDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        if(isset($input['imageId'])){
        //deal with img
            $this->db->beginTransaction();
            $sql    = "DELETE FROM `image` WHERE `imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
        }
        $this->db->beginTransaction();
        $sql = "DELETE FROM glass WHERE glassId = :glassId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':glassId', $input['glassId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->glassList();
    }


}
