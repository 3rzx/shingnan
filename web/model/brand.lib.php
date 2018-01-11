<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 品牌類別
 */
class Brand
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
     * 新增品牌格式
     */
    public function brandAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('brand/brandAdd.html');
    }

    /**
     * 新增品牌
     */
    public function brandAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            if(!isset($input['brandName'])){
                $this->error = '請至少填入品牌名稱';
                $this->brandAddPrepare();
            }
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $brandId = $idGen->GetID('brand');
            $sql = "INSERT INTO `shingnan`.`brand` (`brandId`, `brandName`, `isDelete`, `description`,`lastUpdateTime`, `createTime`) 
                        VALUES (:brandId, :brandName, '0', :description, :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':brandId', $brandId, PDO::PARAM_STR);
            $res->bindParam(':brandName', $input['brandName'], PDO::PARAM_STR);
            $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
            //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['brandImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = 'brand_'.$input['brandName'];
                    $fileInfo = $_FILES['brandImage'];
                    $brandImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 3, 
                                    :brandId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':brandId', $brandId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $brandImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->brandList();
                    }
                }
            }
           $this->brandList();
       }
    }

    /**
     * 編輯品牌前置
     */
    public function brandEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $sql = "SELECT `brand`.`brandName`, `brand`.`brandId` , `brand`.`description`, `image`.`imageId` ,`image`.`path` 
                    FROM  `brand` 
                    LEFT JOIN  `image` ON brand.`brandId` = image.`itemId` 
                    WHERE  `brand`.`isDelete` = 0 AND  `brand`.`brandId` = :brandId" ;
            $res = $this->db->prepare($sql);
            $res->bindParam(':brandId', $input['brandId'], PDO::PARAM_STR);
            $res->execute();
            $brandData = $res->fetch();

            $this->smarty->assign('brandData', $brandData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('brand/brandEdit.html');
        }
    }

    /**
     * 編輯品牌
     */
    public function brandEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE  `shingnan`.`brand` SET  `brandName` = :brandName, `description` = :description, 
                    `lastUpdateTime` =  :lastUpdateTime WHERE  `brand`.`brandId` = :brandId;" ;
            $res = $this->db->prepare($sql);
            $res->bindParam(':brandId', $input['brandId'], PDO::PARAM_STR);
            $res->bindParam(':brandName',$input['brandName'], PDO::PARAM_STR);
            $res->bindParam(':description',$input['description'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
            //update image 
                $this->msg = '更新成功';
                if ($_FILES['brandImage']['error'] == 0) {
                    if( isset($input['imageId']) ){
                        $fileInfo = $_FILES['brandImage'];
                        $brandImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                        $res->bindParam(':pathinfo', $brandImage, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) { 
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->brandList();
                        }
                    }else{
                        $idGen = new IdGenerator();
                        $imgId = $idGen->GetID('image');
                        $imgName = 'brand_'.$input['brandName'];
                        $fileInfo = $_FILES['brandImage'];
                        $brandImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                                `itemId`, `ctr`, `path`, `link`, `createTime`) 
                                VALUES (:imgId, :imgName, 3, 
                                        :brandId, 0, :filePath, '', :createTime);";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                        $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                        $res->bindParam(':brandId', $input['brandId'], PDO::PARAM_STR);
                        $res->bindParam(':filePath', $brandImage, PDO::PARAM_STR);
                        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) { 
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->brandList();
                        }
                    }
                }
            }
            $this->brandList();
        }
    }

    /**
     * 顯示所有品牌列表
     */
    public function brandList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            // get all data from brand
            $sql = 'SELECT `brand`.`brandName`, `brand`.`brandId` , `brand`.`description`, `brand`.`lastUpdateTime`,
                            `image`.`imageId`,`image`.`path` 
                    FROM  `brand` 
                    LEFT JOIN  `image` ON `brand`.`brandId` = `image`.`itemId` 
                    WHERE  `brand`.`isDelete` = 0
                    ORDER BY `brand`.`brandId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allbrandData = $res->fetchAll();

            $this->smarty->assign('allbrandData', $allbrandData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('brand/brandList.html');
        }
    }
    

    /**
     * 刪除品牌
     */
    public function brandDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            if(isset($input['imageId'])){
            //deal with img

                //取得file path
                $sql = "SELECT `path` FROM `image` WHERE `image`.`imageId` = :imgId;";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
                $res->execute();
                $path = $res->fetch();

                //delete data from db
                $this->db->beginTransaction();
                $sql    = "DELETE FROM `image` WHERE `imageId` = :imgId;";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
                $res->execute();
                $this->db->commit();

                //delete data file
                $deleter = new deleteImgFile();
                $deleter->deleteFile($path['path']);
            }
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE `shingnan`.`brand` SET  `isDelete` = 1, `lastUpdateTime` = :lastUpdateTime WHERE brandId = :brandId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':brandId', $input['brandId'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->execute();
            $this->brandList();
        }
    }


    public function brandImageDelete($input){
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            //取得file path
            $sql = "SELECT `path` FROM `image` WHERE `image`.`imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $path = $res->fetch();

            //delete data from db
            $this->db->beginTransaction();
            $sql = "DELETE FROM `image` WHERE `image`.`imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            //delete data file
            $deleter = new deleteImgFile();
            $deleter->deleteFile($path['path']);

            $this->brandList();
        }
    }

    /**
     * 顯示登入畫面
     * @DateTime 2016-09-03
     */
    public function viewLogin(){
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

}
