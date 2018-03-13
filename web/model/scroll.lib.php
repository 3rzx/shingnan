<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 走馬燈類別
 */
class Scroll
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
     * 新增走馬燈格式
     */
    public function scrollAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
        $this->smarty->assign('error', $this->error);
        $this->smarty->display('scroll/scrollAdd.html');
    }

    /**
     * 新增走馬燈
     */
    public function scrollAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $scrollId = $idGen->GetID('scroll');
            $sql = "INSERT INTO `shingnan`.`scroll` (`scrollId`, `scrollName`, `description`,`createTime`) 
                        VALUES (:scrollId, :scrollName, :description, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':scrollId', $scrollId, PDO::PARAM_STR);
            $res->bindParam(':scrollName', $input['scrollName'], PDO::PARAM_STR);
            $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
            //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['scrollImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = 'scroll_'.$input['scrollName'];
                    $fileInfo = $_FILES['scrollImage'];
                    $scrollImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 10, 
                                    :scrollId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':scrollId', $scrollId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $scrollImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->scrollList();
                    }
                }
            }
           $this->scrollList();
       }
    }

    /**
     * 顯示所有走馬燈列表
     */
    public function scrollList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            // get all data from scroll
            $sql = 'SELECT `scroll`.`scrollName`, `scroll`.`scrollId` , `scroll`.`description`,
                            `image`.`imageId`,`image`.`path` 
                    FROM  `scroll` 
                    LEFT JOIN  `image` ON `scroll`.`scrollId` = `image`.`itemId` 
                    ORDER BY `scroll`.`scrollId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allScrollData = $res->fetchAll();

            $this->smarty->assign('allScrollData', $allScrollData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('scroll/scrollList.html');
        }
    }
    

    /**
     * 刪除走馬燈
     */
    public function scrollDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            //取得file path
            $sql = "SELECT `path` FROM `image` WHERE `image`.`itemId` = :scrollId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':scrollId', $input['scrollId'], PDO::PARAM_STR);
            $res->execute();
            $path = $res->fetch();
                
            //delete data from db
            $this->db->beginTransaction();
            $sql    = "DELETE FROM `image` WHERE `image`.`itemId` = :scrollId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':scrollId', $input['scrollId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            //delete data file
            $deleter = new deleteImgFile();
            $deleter->deleteFile($path['path']);

            $this->db->beginTransaction();
            $sql    = "DELETE FROM `scroll` WHERE `scrollId` = :scrollId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':scrollId', $input['scrollId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->scrollList();
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
