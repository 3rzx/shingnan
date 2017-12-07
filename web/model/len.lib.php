<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
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
     * 新增風格格式
     */
    public function lenAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('len/lenAdd.html');
    }

    /**
     * 新增風格
     */
    public function lenAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $lenId = $idGen->GetID('len');
        $sql = "INSERT INTO `shingnan`.`len` (`lenId`, `lenName`, `isDelete`, `description`,`lastUpdateTime`, `createTime`) 
                    VALUES (:lenId, :lenName, '0', :description, :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $lenId, PDO::PARAM_STR);
        $res->bindParam(':lenName', $input['lenName'], PDO::PARAM_STR);
        $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
        //deal with insert image
            $this->msg = '新增成功';
            $uploadPath = '../media/picture';
            if ($_FILES['lenImage']['error'] == 0) {
                $imgId = $idGen->GetID('image');
                $imgName = 'len_'.$input['lenName'];
                $fileInfo = $_FILES['lenImage'];
                $lenImage = uploadFile($fileInfo, $uploadPath);
                $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                        `itemId`, `ctr`, `path`, `link`, `createTime`) 
                        VALUES (:imgId, :imgName, 3, 
                                :lenId, 0, :filePath, '', :createTime);";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                $res->bindParam(':lenId', $lenId, PDO::PARAM_STR);
                $res->bindParam(':filePath', $lenImage, PDO::PARAM_STR);
                $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                $res->execute();
                if (!$res) { 
                    $error = $res->errorInfo();
                    $this->error = $error[0];
                    $this->lenList();
                }
            }
        }
       $this->lenList();
    }

    /**
     * 編輯風格前置
     */
    public function lenEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
         $sql = "SELECT `len`.`lenName`, `len`.`lenId` , `len`.`description`, `image`.`imageId` ,`image`.`path` 
                FROM  `len` 
                LEFT JOIN  `image` ON len.`lenId` = image.`itemId` 
                WHERE  `len`.`isDelete` = 0 AND  `len`.`lenId` = :lenId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
        $res->execute();
        $lenData = $res->fetch();

        $this->smarty->assign('lenData', $lenData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('len/lenEdit.html');
    }

    /**
     * 編輯風格
     */
    public function lenEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE  `shingnan`.`len` SET  `lenName` = :lenName, `description` = :description, 
                `lastUpdateTime` =  :lastUpdateTime WHERE  `len`.`lenId` = :lenId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
        $res->bindParam(':lenName',$input['lenName'], PDO::PARAM_STR);
        $res->bindParam(':description',$input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
        $res->execute();

        if ($res->execute()) {
        //update image 
            $this->msg = '更新成功';
            if ($_FILES['lenImage']['error'] == 0) {
                if( isset($input['imageId']) ){                
                    $fileInfo = $_FILES['lenImage'];
                    $lenImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                    $res->bindParam(':pathinfo', $lenImage, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->lenList();
                    }
                }else{
                    $idGen = new IdGenerator();
                    $imgId = $idGen->GetID('image');
                    $imgName = 'len_'.$input['lenName'];
                    $fileInfo = $_FILES['lenImage'];
                    $lenImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 3, 
                                    :lenId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
                    $res->bindParam(':filePath', $lenImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->lenList();
                    }
                }
            }
        }
        $this->lenList();
    }

    /**
     * 顯示所有風格列表
     */
    public function lenList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from len
        $sql = 'SELECT `len`.`lenName`, `len`.`lenId` , `len`.`description`, `len`.`lastUpdateTime`,
                        `image`.`imageId`,`image`.`path` 
                FROM  `len` 
                LEFT JOIN  `image` ON `len`.`lenId` = `image`.`itemId` 
                WHERE  `len`.`isDelete` = 0
                ORDER BY `len`.`lenId`';
        $res = $this->db->prepare($sql);
        $res->execute();
        $alllenData = $res->fetchAll();

        $this->smarty->assign('alllenData', $alllenData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('len/lenList.html');
        
    }
    

    /**
     * 刪除風格
     */
    public function lenDelete($input) {
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
        $sql = "DELETE FROM len WHERE lenId = :lenId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':lenId', $input['lenId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->lenList();
    }


}
