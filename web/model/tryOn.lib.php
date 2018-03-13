<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
require_once 'deleteImgFile.php';
/**
 * 試戴鏡框類別
 */
class TryOn
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
     * 新增試戴鏡框格式
     */
    public function tryOnAddPrepare() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $sql = "SELECT `frameId`, `frameName` FROM `frame` WHERE `isDelete` = 0 ;" ;
        $res = $this->db->prepare($sql);
        $res->execute();
        $frameData = $res->fetchAll();
        $this->smarty->assign('frameData',$frameData);

        $this->smarty->assign('error', $this->error);
        $this->smarty->display('tryOn/tryOnAdd.html');
    }

    /**
     * 新增試戴鏡框
     */
    public function tryOnAdd($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $tryOnId = $idGen->GetID('tryOn');
            $sql = "INSERT INTO `shingnan`.`tryOn` (`tryOnId`, `frameId`, `createTime`) 
                        VALUES (:tryOnId, :frameId, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':tryOnId', $tryOnId, PDO::PARAM_STR);
            $res->bindParam(':frameId', $input['frame'], PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
            //deal with insert image
                $this->msg = '新增成功';
                $uploadPath = '../media/picture';
                if ($_FILES['tryOnImage']['error'] == 0) {
                    $imgId = $idGen->GetID('image');
                    $imgName = $tryOnId;
                    $fileInfo = $_FILES['tryOnImage'];
                    $tryOnImage = uploadFile($fileInfo, $uploadPath);
                    $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`, 
                                                            `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES (:imgId, :imgName, 11, 
                                    :tryOnId, 0, :filePath, '', :createTime);";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                    $res->bindParam(':tryOnId', $tryOnId, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $tryOnImage, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                    if (!$res) { 
                        $error = $res->errorInfo();
                        $this->error = $error[0];
                        $this->tryOnList();
                    }
                }
            }
           //$this->tryOnList();
       }
    }

    /**
     * 顯示所有試戴鏡框列表
     */
    public function tryOnList() {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{
            // get all data from tryOn
            $sql = 'SELECT `tryOn`.`tryOnId` , `tryOn`.`frameId`, 
                            `image`.`path`,  `frame`.`frameName`,  `frame`.`no`
                    FROM `tryOn`, `image`, `frame`
                    WHERE `tryOn`.`frameId` = `frame`.`frameId`
                    AND `image`.`itemId` = `tryOn`.`tryOnId`
                    ORDER BY `tryOn`.`tryOnId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allTryOnData = $res->fetchAll();

            $this->smarty->assign('allTryOnData', $allTryOnData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('tryOn/tryOnList.html');
        }
    }
    

    /**
     * 刪除試戴鏡框
     */
    public function tryOnDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        }else{

            //取得file path
            $sql = "SELECT `path` FROM `image` WHERE `image`.`itemId` = :tryOnId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':tryOnId', $input['tryOnId'], PDO::PARAM_STR);
            $res->execute();
            $path = $res->fetch();

            //delete data from db
            $this->db->beginTransaction();
            $sql    = "DELETE FROM `image` WHERE `image`.`itemId` = :tryOnId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':tryOnId', $input['tryOnId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            //delete data file
            $deleter = new deleteImgFile();
            $deleter->deleteFile($path['path']);

            $this->db->beginTransaction();
            $sql    = "DELETE FROM `tryOn` WHERE `tryOnId` = :tryOnId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':tryOnId', $input['tryOnId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            $this->tryOnList();
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
