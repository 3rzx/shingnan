<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 風格類別
 */
class Style
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
    public function styleAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('style/styleAdd.html');
        }
    }

    /**
     * 新增風格
     */
    public function styleAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            if(!isset($input['styleName'])){
                $this->error = '請至少填入風格名稱';
                $this->styleAddPrepare();
            }
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $styleId = $idGen->GetID('style');
            $sql = "INSERT INTO `shingnan`.`style` (`styleId`, `styleName`, `isDelete`, `lastUpdateTime`, `createTime`) 
                        VALUES (:styleId, :styleName, '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $styleId, PDO::PARAM_STR);
            $res->bindParam(':styleName', $input['styleName'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
            //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['styleImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = 'style_'.$input['styleName'];
                    $fileInfo = $_FILES['styleImage'];
                    $styleImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `crateTime`) 
                            VALUES (:imgId, :imgName, 2, 
                                    :styleId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':styleId', $styleId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $styleImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->styleList();
                    }
                }
            }
            $this->styleList();
        }
    }

    /**
     * 編輯風格前置
     */
    public function styleEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $sql = "SELECT `style`.`styleName`, `style`.`styleId` , `image`.`imageId` ,`image`.`path` 
                    FROM  `style` 
                    LEFT JOIN  `image` ON style.`styleId` = image.`itemId` 
                    WHERE  `style`.`isDelete` = 0 AND  `style`.`styleId` = :styleId " ;
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->execute();
            $styleData = $res->fetch();
            $this->smarty->assign('styleData', $styleData);
            $this->smarty->assign('error', $this->error);
            //echo $styleData['path'];
            $this->smarty->display('style/styleEdit.html');
        }
    }

    /**
     * 編輯風格
     */
    public function styleEdit($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE  `shingnan`.`style` SET  `styleName` =  :styleName,
                    `lastUpdateTime` =  :lastUpdateTime WHERE  `style`.`styleId` = :styleId;" ;
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->bindParam(':styleName',$input['styleName'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime',$now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
            //update image 
                $this->msg = '更新成功';
                if ($_FILES['styleImage']['error'] == 0) {
                    if( isset($input['imageId']) ){                
                        $fileInfo = $_FILES['styleImage'];
                        $styleImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "UPDATE  `shingnan`.`image` SET  `path` = :pathinfo WHERE `image`.`imageId` = :imageId;";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imageId', $input['imageId'], PDO::PARAM_STR);
                        $res->bindParam(':pathinfo', $styleImage, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) { 
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->styleList();
                        }
                    }else{
                        $idGen = new IdGenerator();
                        $imgId = $idGen->GetID('image');
                        $imgName = 'style_'.$input['styleName'];
                        $fileInfo = $_FILES['styleImage'];
                        $styleImage = uploadFile($fileInfo, '../media/picture');
                        $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                                `itemId`, `ctr`, `path`, `link`, `createTime`) 
                                VALUES (:imgId, :imgName, 2, 
                                        :styleId, 0, :filePath, '', :createTime);";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                        $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                        $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
                        $res->bindParam(':filePath', $styleImage, PDO::PARAM_STR);
                        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                        $res->execute();
                        if (!$res) { 
                            $error = $res->errorInfo();
                            $this->error = $error[0];
                            $this->styleList();
                        }
                    }
                }
            }
            $this->styleList();
        }
    }

    /**
     * 顯示所有風格列表
     */
    public function styleList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            // get all data from style
            $sql = 'SELECT `style`.`styleName`, `style`.`styleId` , `style`.`lastUpdateTime`, `image`.`imageId` ,`image`.`path` 
                    FROM  `style` 
                    LEFT JOIN  `image` ON `style`.`styleId` = `image`.`itemId` 
                    WHERE  `style`.`isDelete` = 0
                    ORDER BY `style`.`styleId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allStyleData = $res->fetchAll();
            $this->smarty->assign('allStyleData', $allStyleData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('style/styleList.html');
        }
    }
    

    /**
     * 刪除風格
     */
    public function styleDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            if(isset($input['imageId'])){
            //deal with img
                $this->db->beginTransaction();
                $sql    = "DELETE FROM `image` WHERE `imageId` = :imgId;";
                $res = $this->db->prepare($sql);
                $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
                $res->execute();
                $this->db->commit();
            }
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE `shingnan`.`style` SET  `isDelete` = 1, `lastUpdateTime` = :lastUpdateTime WHERE `styleId` = :styleId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->execute();
            $this->styleList();
        }
    }

        
    public function styleImageDelete($input){
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

            $this->db->beginTransaction();
            $sql = "DELETE FROM `image` WHERE `image`.`imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            //delete data file
            $deleter = new deleteImgFile();
            $deleter->deleteFile($path['path']);

            $this->styleList();
        }
    }

    /**
     * 顯示登入畫面
     * @DateTime 2016-09-03
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }

}
