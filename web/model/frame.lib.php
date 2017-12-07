<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
 */
class Frame
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
    public function frameAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('frame/frameAdd.html');
    }

    /**
     * 新增風格
     */
    public function frameAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $frameId = $idGen->GetID('frame');
        $sql = "INSERT INTO `shingnan`.`frame` (`frameId`, `frameName`, `isDelete`, `description`,`lastUpdateTime`, `createTime`) 
                    VALUES (:frameId, :frameName, '0', :description, :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $frameId, PDO::PARAM_STR);
        $res->bindParam(':frameName', $input['frameName'], PDO::PARAM_STR);
        $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
        //deal with insert image
            $this->msg = '新增成功';
            $uploadPath = '../media/picture';
            if ($_FILES['frameImage']['error'] == 0) {
                $imgId = $idGen->GetID('image');
                $imgName = 'frame_'.$input['frameName'];
                $fileInfo = $_FILES['frameImage'];
                $frameImage = uploadFile($fileInfo, $uploadPath);
                $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                        `itemId`, `ctr`, `path`, `link`, `createTime`) 
                        VALUES (:imgId, :imgName, 3, 
                                :frameId, 0, :filePath, '', :createTime);";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                $res->bindParam(':frameId', $frameId, PDO::PARAM_STR);
                $res->bindParam(':filePath', $frameImage, PDO::PARAM_STR);
                $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                $res->execute();
                if (!$res) { 
                    $error = $res->errorInfo();
                    $this->error = $error[0];
                    $this->frameList();
                }
            }
        }
       $this->frameList();
    }

    /**
     * 編輯風格前置
     */
    public function frameEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
         $sql = "SELECT `frame`.`frameName`, `frame`.`frameId` , `frame`.`description`, `image`.`imageId` ,`image`.`path` 
                FROM  `frame` 
                LEFT JOIN  `image` ON frame.`frameId` = image.`itemId` 
                WHERE  `frame`.`isDelete` = 0 AND  `frame`.`frameId` = :frameId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $frameData = $res->fetch();

        $this->smarty->assign('frameData', $frameData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('frame/frameEdit.html');
    }

    /**
     * 編輯風格
     */
    public function frameEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE  `shingnan`.`frame` SET  `frameName` = :frameName, `description` = :description, 
                `lastUpdateTime` =  :lastUpdateTime WHERE  `frame`.`frameId` = :frameId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->bindParam(':frameName',$input['frameName'], PDO::PARAM_STR);
        $res->bindParam(':description',$input['description'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
        $res->execute();

        if ($res->execute()) {
        //update image 
            $this->msg = '更新成功';
            if ($_FILES['frameImage']['error'] == 0) {
                if( isset($input['imageId']) ){                
                    $fileInfo = $_FILES['frameImage'];
                    $frameImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                    $res->bindParam(':pathinfo', $frameImage, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->frameList();
                    }
                }else{
                    $idGen = new IdGenerator();
                    $imgId = $idGen->GetID('image');
                    $imgName = 'frame_'.$input['frameName'];
                    $fileInfo = $_FILES['frameImage'];
                    $frameImage = uploadFile($fileInfo, '../media/picture');
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 3, 
                                    :frameId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
                    $res->bindParam(':filePath', $frameImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->frameList();
                    }
                }
            }
        }
        $this->frameList();
    }

    /**
     * 顯示所有風格列表
     */
    public function frameList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from frame
        $sql = 'SELECT `frame`.`frameName`, `frame`.`frameId` , `frame`.`description`, `frame`.`lastUpdateTime`,
                        `image`.`imageId`,`image`.`path` 
                FROM  `frame` 
                LEFT JOIN  `image` ON `frame`.`frameId` = `image`.`itemId` 
                WHERE  `frame`.`isDelete` = 0
                ORDER BY `frame`.`frameId`';
        $res = $this->db->prepare($sql);
        $res->execute();
        $allframeData = $res->fetchAll();

        $this->smarty->assign('allframeData', $allframeData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('frame/frameList.html');
        
    }
    

    /**
     * 刪除風格
     */
    public function frameDelete($input) {
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
        $sql = "DELETE FROM frame WHERE frameId = :frameId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->frameList();
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
