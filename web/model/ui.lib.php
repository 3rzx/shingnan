<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
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
        // cover => index_item_00
        // 01~20 => index_item_01~20
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT * FROM `image` WHERE `itemId` like 'index_%'";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $images = $res->fetchAll();
                $this->setResultMsg();

                $this->smarty->assign('images', $images);             
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('ui/indexCoverSet.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 顯示商品點閱率
     */
    public function editIndexCover($file) {
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

    /**
     * 設定訊息
     */
    public function setResultMsg($resultMsg = 'success', $errorMsg = '') {
        $this->msg = $resultMsg;
        $this->error = $errorMsg;
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
