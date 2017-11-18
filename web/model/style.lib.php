<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
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
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('style/styleAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增風格
     */
    public function styleAdd($input) {
        if ($_SESSION['isLogin'] == true) {
            try{
                $idGen = new IdGenerator();
                $now = date('Y-m-d H:i:s');
                $styleId = $idGen.GetID('style');
                $this->db->beginTransaction();
                $sql = "INSERT INTO `shingnan`.`style` (`styleId`, `styleName`, `isDelete`, `lastUpdateTime`, `createTime`) 
                        VALUES (:styleId, :styleName, '0', :lastUpdateTime, :createTime);";
                $res->bindParam(':styleId', $styleId, PDO::PARAM_STR);
                $res->bindParam(':styleName', $input['styleName'], PDO::PARAM_STR);
                $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
                $res->bindParam(':createTime', $now, PDO::PARAM_STR);

                if ($res->execute()) {
                    //deal with insert image
                    $this->msg = '新增成功';
                    $uploadPath = '../media/picture';
                    if (!file_exists($uploadPath) && !is_dir($uploadPath)) {
                        // create project folder with 777 permissions
                        mkdir($uploadPath);
                        chmod($uploadPath, 0777);
                    }
                    if ($_FILES['styleImage']['error'] == 0) {
                        $imgId = $idGen.GetID('image');
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
                            var_dump($res->errorInfo());
                            exit;
                            $this->error = $error[0];
                            $this->smarty->assign('error', $this->error);
                        }
                    }
                }
                //$this->styleList();
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage();
                $this->smarty->assign('error', $e->getMessage());
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯風格前置
     */
    public function styleEditPrepare($input) {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT * FROM style WHERE styleId = :styleId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->execute();
            $styleData = $res->fetchAll();

            //get image 
            $sql = 'SELECT `path`
                    FROM image
                    WHERE type = 2 and itemId = :styleId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->execute();
            $styleImg = $res->fetchAll();

            $this->smarty->assign('styleData', $styleData);
            $this->smarty->assign('styleImg',$styleImg);
            $this->smarty->assign('error', $this->error);
            $this->display('style/styleEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯風格
     */
    public function styleEdit($input) {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT * FROM style WHERE styleId = :styleId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->execute();
            $styleData = $res->fetchAll();

            //get image 
            $sql = 'SELECT `path`
                    FROM image
                    WHERE type = 2 and itemId = :styleId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
            $res->execute();
            $styleImg = $res->fetchAll();

            $this->smarty->assign('styleData', $styleData);
            $this->smarty->assign('styleImg',$styleImg);
            $this->smarty->assign('error', $this->error);
            $this->display('style/styleEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示所有風格列表
     */
    public function styleList() {
        if ($_SESSION['isLogin'] == true) {
            // get all data from style
            $sql = 'SELECT *
            		FROM style
                    ORDER BY styleId';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allStyleData = $res->fetchAll();

            $sql = 'SELECT `path`,`itemId`
                    FROM image
                    WHERE type = 2
                    ORDER BY itemId';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allStyleImg = $res->fetchAll();

            $this->smarty->assign('allStyleData', $allStyleData);
            $this->smarty->assign('allStyleImg', $allStyleImg);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('style/styleList.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }
    

    /**
     * 刪除風格
     */
    public function styleDelete($input) {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $sql    = "DELETE FROM style
                           WHERE styleId = :styleId";
                $res->bindParam(':styleId', $input['styleId'], PDO::PARAM_STR);
                $this->db->exec($sql);
                $this->db->commit();
                //deal with img
                $this->error = '';
                $this->msg   = '刪除成功';
                $this->smarty->display('style/styleList.html');
            } catch (PDOException $e) {
                $this->db->rollBack();
                print "Error!: " . $e->getMessage();
            }
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
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
