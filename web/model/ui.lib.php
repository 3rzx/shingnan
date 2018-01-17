<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'upload.func.php';
require_once 'IdGenerator.php';
/**
 * 前台 UI 設定
 */
class Ui
{
    public $db = null;
    public $smarty = null;
    public $msg = '';
    public $error = '';
    public $admin = null;

    /**
     * Statistic constructor
     */
    public function __construct() {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();

        if (PHP_VERSION_ID < 50400) {
            // 登記 Session 變數名稱
            session_register('isLogin');
            session_register('user');
            session_register('error');
            session_register('msg');
        }
    }

    /**
     * 顯示首頁封面設定
     */
    public function viewIndexCover() {
        // cover(3) => index_item_0~2
        // 3~22 (5 * 4) => index_item_3~22
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT * FROM `image` WHERE `itemId` like 'index_%'";
            $res = $this->db->prepare($sql);
            
            if ($res->execute()) {
                $rows = $res->fetchAll();
                $images = array();
                foreach($rows as $img) {
                    $images[$img['imageName']] = $img;
                }
                $this->setResultMsg();

                $this->smarty->assign('images', $images);             
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->display('ui/indexCoverSet.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 上傳首頁圖片
     */
    public function editIndexCover($input) {
        $updateList = json_decode($input['updateList']);

        foreach($updateList as $index) {
            $sql = "SELECT `imageId` FROM `image` WHERE `itemId` = '$index'";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $count = $res->rowCount();
                if($count == 1) {
                    $imageId = $res->fetch();
                    $fileInfo = $_FILES[$index];
                    $path = uploadFile($fileInfo, '../media/picture');
                    $sql = "UPDATE `image` SET `path` = :pathInfo
                            WHERE `imageId` = :imageId";
                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imageId', $imageId[0], PDO::PARAM_STR);
                    $res->bindParam(':pathinfo', $path, PDO::PARAM_STR);
                    $res->execute();
                } else {
                    $idGen = new IdGenerator();
                    $imgId = 'image_'. $index;
                    $imgName = $index;
                    $fileInfo = $_FILES[$index];
                    $path = uploadFile($fileInfo, '../media/picture');
                    $now = date('Y-m-d H:i:s');

                    $sql = "INSERT INTO `image` 
                            (`imageId`, `imageName`, `type`, `itemId`, `ctr`, `path`, `link`, `createTime`) 
                            VALUES
                            (:imgId, :imgName, 10, :itemId, 0, :filePath, '', :createTime)";

                    $res = $this->db->prepare($sql);
                    $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                    $res->bindParam(':imgName', $index, PDO::PARAM_STR);
                    $res->bindParam(':itemId', $index, PDO::PARAM_STR);
                    $res->bindParam(':filePath', $path, PDO::PARAM_STR);
                    $res->bindParam(':createTime', $now, PDO::PARAM_STR);
                    $res->execute();
                }
            } 
        }
        $this->viewIndexCover();
    }
    /**
     * 預覽首頁
     */
    public function previewIndexCover($input) {
        $images = array();
        for($i = 0; $i < 23; $i++) {
            $index = "index_img_$i";
            if ($_FILES[$index]['name'] != "") {
                if ($_FILES[$index]['error'] != 0) {
                    setResultMsg('failure', '圖片上傳錯誤');
                    $this->viewIndexCover();
                } else {
                    $fileInfo = getimagesize($_FILES[$index]['tmp_name']);
                    $tmpImage = "data:" . $fileInfo['mime'] . ";base64," . 
                    base64_encode(file_get_contents($_FILES[$index]['tmp_name']));
                    $images[$index] = $tmpImage;
                }  
            } else {
                $sql = "SELECT `path` FROM `image` WHERE `itemId` = '$index'";
                $res = $this->db->prepare($sql);
                
                if ($res->execute()) {
                    $data = $res->fetch();     
                    $images[$index] = $data[0];          
                }
            }
        }
        $this->smarty->assign('images', $images);
        $this->smarty->display('ui/previewIndex.html');
    }

    /**
     * 刪除圖片
     */
    public function imgDelete($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        } else {
            //取得file path
            $sql = "SELECT `path` FROM `image` WHERE `imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $path = $res->fetch();

            $this->db->beginTransaction();
            $sql = "DELETE FROM `image` WHERE `imageId` = :imgId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':imgId', $input['imageId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();

            //delete data file
            $deleter = new deleteImgFile();
            $deleter->deleteFile($path['path']);

            $this->viewIndexCover();
        }
    }

    /**
     * 設定訊息
     */
    public function setResultMsg($resultMsg = 'success', $errorMsg = '') {
        $this->msg = $resultMsg;
        $this->error = $errorMsg;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
    }

    /**
     * 顯示登入畫面
     */
    public function viewLogin()
    {
        $_SESSION['isLogin'] = false;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('homePath', APP_ROOT_DIR);
        $this->smarty->display('login.html');
    }
}
