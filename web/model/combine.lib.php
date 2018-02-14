<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 組合類別
 */
class Combine
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
     * 新增組合格式
     */
    public function combineAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $sql = "SELECT `frameId`, `frameName`, `no` FROM `frame` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $frameData = $res->fetchAll();
        $this->smarty->assign('frameData',$frameData);

        
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('combine/combineAdd.html');
    }

    /**
     * 新增組合
     */
    public function combineAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        if(!isset($input['combineName'])){
            $this->error = '請至少填入組合商品名稱';
            $this->combineAddPrepare();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $combineId = $idGen->GetID('combine');
        $isLaunch = 0;
        if (isset($input['isLaunch']))
            $isLaunch = 1;                        

        $sql = "INSERT INTO `shingnan`.`combine` (`combineId`, `combineName`, `price`, `discountPrice`, `isLaunch`, 
                                                  `description`, `isDelete`, `lastUpdateTime`, `createTime`) 
                VALUES (:combineId, :combineName, :price, :discountPrice, :isLaunch, :description, 0, :lastUpdateTime, :createTime);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $combineId, PDO::PARAM_STR);
        $res->bindParam(':combineName', $input['combineName'], PDO::PARAM_STR);
        $res->bindParam(':price', $input['price'], PDO::PARAM_INT);
        $res->bindParam(':discountPrice', $input['discountPrice'], PDO::PARAM_INT);
        $res->bindParam(':isLaunch', $isLaunch, PDO::PARAM_INT);
        $res->bindParam(':description', $description, PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
            
            //deal with comDetail
            $this->msg = '資料新增成功';
            $sql2 = "INSERT INTO `shingnan`.`comDetail` (`combineId` ,`frameId`) VALUES ";
            for($i=1;$i<=$input['itemCount'];$i++)
                if(isset($input['combineItem'.$i]) && $input['combineItem'.$i] !='' )
                    $sql2 .= "('".$combineId."', '". $input['combineItem'.$i] ."'),"; 
            $sql2 = substr_replace($sql2, ';', -1);
            $res = $this->db->prepare($sql2);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $this->error.' 組合鏡框新增錯誤 '.$error[2];
                $this->combineList();
            }
            //deal with image
            $uploadPath = '../media/picture';
            $sql3 = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,`itemId`, `ctr`, `path`, `link`, `createTime`) VALUES ";
            for($i=0;$i<$input['imgCount'];$i++){
                $imgCount = 'combineImage'.(string)($i+1);
                if (isset($_FILES[$imgCount]['error']) && $_FILES[$imgCount]['error'] == 0){
                    $imgId = $idGen->GetID('image').$i;
                    $imgName = 'combine_'.$input['combineName'];
                    $fileInfo = $_FILES[$imgCount];
                    $imagePath = uploadFile($fileInfo, $uploadPath);
                    //echo $imagePath."<br>";
                    $sql3 .= "('" . $imgId . "', '" . $imgName . "' , 9, '" . $combineId . "', 0, '" . $imagePath . "', '', '" . $now . "'),";
                }
            }
            $sql3 = substr_replace($sql3, ';', -1);
            $res = $this->db->prepare($sql3);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $this->error.' 圖片新增錯誤 '.$error[2];
                $this->combineList();
            }
        }
       $this->combineList();
    }

    /**
     * 編輯組合前置
     */
    public function combineEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
         $sql = "SELECT `combine`.`combineName`, `combine`.`combineId`, `combine`.`price`, `combine`.`discountPrice`, `combine`.`description`,`combine`.`isLaunch` 
                FROM  `combine` 
                WHERE  `combine`.`isDelete` = 0 AND `combine`.`combineId` = :combineId" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->execute();
        $combineData = $res->fetch();

        //join to frame name and no
        $sql = "SELECT  `comDetail`.`frameId` ,  `frame`.`frameName` ,  `frame`.`no` 
                FROM  `comDetail` ,  `combine` ,  `frame` 
                WHERE  `comDetail`.`combineId` =  :combineId
                AND  `combine`.`combineId` =  :combineId
                AND  `frame`.`frameId` =  `comDetail`.`frameId` 
                AND  `combine`.`isDelete` =0" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->execute();
        $comDetailData = $res->fetchAll();

        $sql = "SELECT `image`.`imageId`, `image`.`imageId`, `image`.`imageName`, `image`.`itemId`, `image`.`path`, `image`.`link` 
                FROM `image` 
                WHERE `image`.`itemId` = :combineId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->execute();
        $imageData = $res->fetchAll();

        $sql = "SELECT `frameId`, `frameName`, `no` FROM `frame` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $frameData = $res->fetchAll();
        
        $this->smarty->assign('frameData',$frameData);
        $this->smarty->assign('combineData', $combineData);
        $this->smarty->assign('comDetailData', $comDetailData);
        $this->smarty->assign('imageData', $imageData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('combine/combineEdit.html');
    }

    /**
     * 編輯組合
     */
    public function combineEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $combineId = $input['combineId'];
        $isLaunch = 0;
        if (isset($input['isLaunch']))
            $isLaunch = 1;
        $isPrimary = 0;
        if (isset($input['isPrimary']))
            $isPrimary = 1;

        $sql = "UPDATE `shingnan`.`combine` 
                SET `combineName` = :combineName, `price` = :price, `discountPrice` = :discountPrice, `isLaunch` = :isLaunch, 
                    `description` = :description, `lastUpdateTime` =  :lastUpdateTime 
                WHERE  `combine`.`combineId` = :combineId;" ;
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $combineId, PDO::PARAM_STR);
        $res->bindParam(':combineName',$input['combineName'], PDO::PARAM_STR);
        $res->bindParam(':price', $input['price'], PDO::PARAM_INT);
        $res->bindParam(':discountPrice', $input['discountPrice'], PDO::PARAM_INT);
        $res->bindParam('description', $input['description'], PDO::PARAM_STR);
        $res->bindParam(':isLaunch', $isLaunch, PDO::PARAM_INT);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);

        if ($res->execute()) {
             $this->msg = '資料新增成功';
            
            // //deal with comDetail
            $sql2 = "INSERT INTO `shingnan`.`comDetail` (`combineId` ,`frameId`) VALUES ";
            for($i=1;$i<=$input['itemCount'];$i++)
                if(isset($input['combineItem'.$i]) && $input['combineItem'.$i] !='' )
                    $sql2 .= "('".$combineId."', '". $input['combineItem'.$i] ."'),"; 
            $sql2 = substr_replace($sql2, ';', -1);
            $res = $this->db->prepare($sql2);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $this->error.' 組合鏡框新增錯誤 '.$error[2];
                $this->combineList();
            }

            // //deal with image
            $uploadPath = '../media/picture';
            $sql3 = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,`itemId`, `ctr`, `path`, `link`, `createTime`) VALUES ";
            for($i=0;$i<$input['imgCount'];$i++){
                $imgCount = 'combineImage'.(string)($i+1);
                if (isset($_FILES[$imgCount]['error']) && $_FILES[$imgCount]['error'] == 0){
                    $imgId = $idGen->GetID('image').$i;
                    $imgName = 'combine_'.$input['combineName'];
                    $fileInfo = $_FILES[$imgCount];
                    $imagePath = uploadFile($fileInfo, $uploadPath);
                    //echo $imagePath."<br>";
                    $sql3 .= "('" . $imgId . "', '" . $imgName . "' , 1, '" . $combineId . "', 0, '" . $imagePath . "', '', '" . $now . "'),";
                }
            }
            $sql3 = substr_replace($sql3, ';', -1);
            $res = $this->db->prepare($sql3);
            $res->execute();
            if (!$res) { 
                $error = $res->errorInfo();
                $this->error = $this->error.' 圖片新增錯誤 '.$error[2];
                $this->combineList();
            }
        }else{
            $error = $res->errorInfo();
        }
        $this->combineList();
    }

    /**
     * 顯示所有組合列表
     */
    public function combineList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        // get all data from combine
        $sql = 'SELECT `combine`.`combineId`, `combine`.`combineName`, `combine`.`isLaunch`, `combine`.`description`, `combine`.`lastUpdateTime` 
                FROM `combine` 
                WHERE `combine`.`isDelete` = 0' ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $allCombineData = $res->fetchAll();

        $this->smarty->assign('allCombineData', $allCombineData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('combine/combineList.html');
        
    }
    

    /**
     * 刪除組合
     */
    public function combineDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        //deal with img

        //取得img file path
        $sql = "SELECT `path` FROM `image` WHERE `itemId` = :combineId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->execute();
        $path = $res->fetchAll();

        //delete img data from db
        $this->db->beginTransaction();
        $sql  = "DELETE FROM `image` WHERE `itemId` = :combineId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();

        //deal with img data file
        $deleter = new deleteImgFile();
        foreach($path as $item){
            $deleter->deleteFile($item['path']);
        }

        //deal with data TODO
        $sql = "UPDATE `shingnan`.`combine` SET `isDelete` = '1' WHERE `combine`.`combineId` = :combineId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->execute();
        
        $this->combineList();
    }

    /**
     * 刪除組合圖片
     */
    public function combineImageDelete($input){
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }

        //取得img file path
        $sql = "SELECT `path` FROM `image` WHERE `image`.`imageId` = :imgId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
        $res->execute();
        $path = $res->fetch();

        //delete img data from db
        $this->db->beginTransaction();
        $sql = "DELETE FROM `image` WHERE `image`.`imageId` = :imgId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();

        //delete img data file
        $deleter = new deleteImgFile();
        $deleter->deleteFile($path['path']);

        $this->combineEditPrepare();
    }

    /**
     * 刪除組合鏡框
     */
    public function combineFrameDelete($input){
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }

        //delete img data from db
        $this->db->beginTransaction();
        $sql = "DELETE FROM `comDetail` WHERE `comDetail`.`combineId` = :combineId AND `comDetail`.`frameId` = :frameId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':combineId', $input['combineId'], PDO::PARAM_STR);
        $res->bindParam(':frameId', $input['frameId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();

        $this->combineEditPrepare();
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
