<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 鏡框類別
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
     * 新增鏡框格式
     */
    public function frameAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $sql = "SELECT `brandId`, `brandName` FROM `brand` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $brandData = $res->fetchAll();
        $this->smarty->assign('brandData',$brandData);
        $sql = "SELECT `styleId`, `styleName` FROM `style` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $styleData = $res->fetchAll();
        $this->smarty->assign('styleData',$styleData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('frame/frameAdd.html');
    }

    /**
     * 新增鏡框
     */
    public function frameAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        if(!isset($input['no']) || !isset($input['frameName'])){
            $this->error = '請至少填入鏡框編號與鏡框名稱';
            $this->brandAddPrepare();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $frameId = $idGen->GetID('frame');
        $isLaunch = 0;
        if (isset($input['isLaunch']))
            $isLaunch = 1;                        


        $sql = "INSERT INTO `shingnan`.`frame` (`frameId`, `no`, `frameName`, `brandId`, `shape`, `material`, 
                                                `color`, `isLaunch`, `ctr`, `isDelete`, `lastUpdateTime`, `createTime`) 
                VALUES (:frameId, :no, :frameName, :frameBrand, :shape, :material, 
                        :color, :isLaunch, 0, 0, :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $frameId, PDO::PARAM_STR);
        $res->bindParam(':no', $input['no'], PDO::PARAM_STR);
        $res->bindParam(':frameName', $input['frameName'], PDO::PARAM_STR);
        $res->bindParam(':frameBrand',  $input['frameBrand'], PDO::PARAM_STR);
        $res->bindParam(':shape', $input['shape'], PDO::PARAM_INT);
        $res->bindParam(':material', $input['material'], PDO::PARAM_STR);
        $res->bindParam(':color', $input['color'], PDO::PARAM_STR);
        $res->bindParam(':isLaunch', $isLaunch, PDO::PARAM_INT);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
            //deal with style
            $this->msg = '資料新增成功';
            $frameStyle = $input['frameStyle'];
            if(!empty($frameStyle)){
                $sql2 = "INSERT INTO `shingnan`.`frameStyle` (`styleId`, `frameId`, `createTime`) VALUES";
                foreach($frameStyle as $s){
                    $sql2 .= " ('" . $s . "', '" . $frameId . "', '" . $now . "'),";
                }
                $sql2 = substr_replace($sql2, ";", -1);
                $res = $this->db->prepare($sql2);
                $res->execute();
                if(!$res){
                    $error = $res->errorInfo();
                    $this->error = ' 風格設定錯誤 '.$error[0];
                }
            }
            //deal with image
            $uploadPath = '../media/picture';
            $sql3 = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,`itemId`, `ctr`, `path`, `link`, `createTime`) VALUES ";
            for($i=0;$i<$input['imgCount'];$i++){
                $imgCount = 'frameImage'.(string)($i+1);
                if (isset($_FILES[$imgCount]['error']) && $_FILES[$imgCount]['error'] == 0){
                    $imgId = $idGen->GetID('image').$i;
                    $imgName = 'frame_'.$input['frameName'];
                    $fileInfo = $_FILES[$imgCount];
                    $imagePath = uploadFile($fileInfo, $uploadPath);
                    //echo $imagePath."<br>";
                    $sql3 .= "('" . $imgId . "', '" . $imgName . "' , 1, '" . $frameId . "', 0, '" . $imagePath . "', '', '" . $now . "'),";
                }
            }
            $sql3 = substr_replace($sql3, ';', -1);
            $res = $this->db->prepare($sql3);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $this->error.' 圖片新增錯誤 '.$error[0];
                $this->frameList();
            }
        }
       $this->frameList();
    }

    /**
     * 編輯鏡框前置
     */
    public function frameEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
         $sql = "SELECT `frame`.`frameName`, `frame`.`frameId` , `frame`.`no`, `frame`.`brandId`, `frame`.`shape`, 
                        `frame`.`material`, `frame`.`color`, `frame`.`isLaunch`  
                FROM  `frame` 
                WHERE  `frame`.`isDelete` = 0 AND `frame`.`frameId` = :frameId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $frameData = $res->fetch();

        $sql = "SELECT `brandId`, `brandName` FROM `brand` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $brandData = $res->fetchAll();

        $sql = "SELECT `styleId`, `styleName` FROM `style` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $styleData = $res->fetchAll();

        $sql = "SELECT `frameStyle`.`styleId` FROM `frameStyle`,`style` 
                WHERE `frameStyle`.`frameId` = :frameId 
                AND `style`.`styleId` = `frameStyle`.`styleId` 
                AND `style`.`isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $frameStyleData = $res->fetchAll();

        $this->smarty->assign('frameData', $frameData);
        $this->smarty->assign('styleData', $styleData);
        $this->smarty->assign('brandData',$brandData);
        $this->smarty->assign('frameStyleData',$frameStyleData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('frame/frameEdit.html');
    }

    /**
     * 編輯鏡框
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
     * 顯示所有鏡框列表
     */
    public function frameList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from frame
        $sql = 'SELECT `frame`.`frameId`, `frame`.`no`, `frame`.`frameName`, `frame`.`brandId`, `frame`.`shape`, `frame`.`material`, 
                     `frame`.`color`, `frame`.`isLaunch`, `frame`.`lastUpdateTime`, `brand`.`brandName` 
                FROM `frame`, `brand` 
                WHERE `frame`.`brandId` = `brand`.`brandId` AND `frame`.`isDelete` = 0 
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
     * 刪除鏡框
     */
    public function frameDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        //deal with img
        $this->db->beginTransaction();
        $sql  = "DELETE FROM `image` WHERE `itemId` = :frameId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();

        //deal with style
        $this->db->beginTransaction();
        $sql = "DELETE FROM  `frameStyle` WHERE `frameId` = :frameId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();

        //deal with data
        $this->db->beginTransaction();
        $sql = "DELETE FROM frame WHERE frameId = :frameId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->frameList();
    }

    /**
     * 刪除鏡框圖片
     */
    public function frameImageDelete($input){
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->db->beginTransaction();
        $sql = "DELETE FROM `image` WHERE `image`.`imageId` = :imgId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();
        $this->frameEditPrepare();
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
