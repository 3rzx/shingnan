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
        $isLaunch = 0;
        if (isset($input['isLaunch']))
            $isLaunch = 1;  

        $sql = "INSERT INTO `shingnan`.`part` (`partId`, `partName`, `type`, `size`, `isLaunch`, `isDelete`, `lastUpdateTime`, `createTime`) 
                VALUES ( :partId , :partName , :partType, :partSize, :isLaunch, '0', :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':partId', $partId, PDO::PARAM_STR);
        $res->bindParam(':partName', $input['partName'], PDO::PARAM_STR);
        $res->bindParam(':partType', $input['partType'], PDO::PARAM_INT);
        $res->bindParam(':partSize', $input['partSize'], PDO::PARAM_STR);
        $res->bindParam(':isLaunch', $isLaunch, PDO::PARAM_INT);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
            $this->msg = '資料新增成功';

            //deal with image
            $uploadPath = '../media/picture';
            $sql3 = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,`itemId`, `ctr`, `path`, `link`, `createTime`) VALUES ";
            for($i=0;$i<$input['imgCount'];$i++){
                $imgCount = 'partImage'.(string)($i+1);
                if (isset($_FILES[$imgCount]['error']) && $_FILES[$imgCount]['error'] == 0){
                    $imgId = $idGen->GetID('image').$i;
                    $imgName = 'part_'.$input['partName'];
                    $fileInfo = $_FILES[$imgCount];
                    $imagePath = uploadFile($fileInfo, $uploadPath);
                    $sql3 .= "('" . $imgId . "', '" . $imgName . "' , 1, '" . $partId . "', 0, '" . $imagePath . "', '', '" . $now . "'),";
                }
            }
            $sql3 = substr_replace($sql3, ';', -1);
            echo $sql3;
            $res = $this->db->prepare($sql3);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $this->error.' 圖片新增錯誤 '.$error[0];
                $this->frameList();
            }
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
         $sql = "SELECT `part`.`partName`, `part`.`partId` , `part`.`description`, `image`.`imageId` ,`image`.`path` 
                FROM  `part` 
                LEFT JOIN  `image` ON part.`partId` = image.`itemId` 
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
        $sql = "UPDATE  `shingnan`.`part` SET  `partName` = :partName, `description` = :description, 
                `lastUpdateTime` =  :lastUpdateTime WHERE  `part`.`partId` = :partId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':partId', $input['partId'], PDO::PARAM_STR);
        $res->bindParam(':partName',$input['partName'], PDO::PARAM_STR);
        $res->bindParam(':description',$input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
        $res->execute();

        if ($res->execute()) {
        //update image 
            $this->msg = '更新成功';
            if ($_FILES['partImage']['error'] == 0) {
                if( isset($input['imageId']) ){                
                    $fileInfo = $_FILES['partImage'];
                    $partImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                    $res->bindParam(':pathinfo', $partImage, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->partList();
                    }
                }else{
                    $idGen = new IdGenerator();
                    $imgId = $idGen->GetID('image');
                    $imgName = 'part_'.$input['partName'];
                    $fileInfo = $_FILES['partImage'];
                    $partImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 3, 
                                    :partId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':partId', $input['partId'], PDO::PARAM_STR);
                    $res->bindParam(':filePath', $partImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->partList();
                    }
                }
            }
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
        $sql = 'SELECT `part`.`partId`, `part`.`partName`, `part`.`type`, `part`.`size`, `part`.`isLaunch`, `part`.`lastUpdateTime` 
                FROM `part` 
                WHERE `part`.`isDelete` = 0 
                ORDER BY `part`.`partId`';
        $res = $this->db->prepare($sql);
        $res->execute();
        $allpartData = $res->fetchAll();

        $this->smarty->assign('allpartData', $allpartData);
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
