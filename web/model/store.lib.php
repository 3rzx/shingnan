<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
/**
 * 風格類別
 */
class Store
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
    public function __construct()
    {
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
    public function storeAddPrepare()
    {
        if ($_SESSION['isLogin'] == true) {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('store/storeAdd.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 新增風格
     */
    public function storeAdd($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $idGen = new IdGenerator();
                $now = date('Y-m-d H:i:s');
                $storeId = $idGen . GetID('store');
                $this->db->beginTransaction();
                $sql = "INSERT INTO `shingnan`.`store` (`storeId`, `storeName`,  `description`, `isDelete`, `lastUpdateTime`, `createTime`)
                        VALUES (:storeId, :storeName, :description, '0', :lastUpdateTime, :createTime);";
                $res->bindParam(':storeId', $storeId, PDO::PARAM_STR);
                $res->bindParam(':storeName', $input['storeName'], PDO::PARAM_STR);
                $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
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
                    if ($_FILES['storeImage']['error'] == 0) {
                        $imgId = $idGen . GetID('image');
                        $imgName = 'store_' . $input['storeName'];
                        $fileInfo = $_FILES['storeImage'];
                        $storeImage = uploadFile($fileInfo, $uploadPath);
                        $sql = "INSERT INTO `shingnan`.`image` (`imageId`, `imageName`, `type`,
                                                                `itemId`, `ctr`, `path`, `link`, `crateTime`)
                                VALUES (:imgId, :imgName, 2,
                                        :storeId, 0, :filePath, '', :createTime);";
                        $res = $this->db->prepare($sql);
                        $res->bindParam(':imgId', $imgId, PDO::PARAM_STR);
                        $res->bindParam(':imgName', $imgName, PDO::PARAM_STR);
                        $res->bindParam(':storeId', $storeId, PDO::PARAM_STR);
                        $res->bindParam(':filePath', $storeImage, PDO::PARAM_STR);
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
                //$this->storeList();
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
    public function storeEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT * FROM store WHERE storeId = :storeId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->execute();
            $storeData = $res->fetchAll();

            //get image
            $sql = 'SELECT `path`
                    FROM image
                    WHERE type = 2 and itemId = :storeId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->execute();
            $storeImg = $res->fetchAll();

            $this->smarty->assign('storeData', $storeData);
            $this->smarty->assign('storeImg', $storeImg);
            $this->smarty->assign('error', $this->error);
            $this->display('store/storeEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 編輯風格
     */
    public function storeEdit($input)
    {
        if ($_SESSION['isLogin'] == true) {
            $sql = 'SELECT * FROM store WHERE storeId = :storeId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->execute();
            $storeData = $res->fetchAll();

            //get image
            $sql = 'SELECT `path`
                    FROM image
                    WHERE type = 2 and itemId = :storeId';
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->execute();
            $storeImg = $res->fetchAll();

            $this->smarty->assign('storeData', $storeData);
            $this->smarty->assign('storeImg', $storeImg);
            $this->smarty->assign('error', $this->error);
            $this->display('store/storeEdit.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 顯示所有風格列表
     */
    public function storeList()
    {
        if ($_SESSION['isLogin'] == true) {
            // get all data from store
            $sql = 'SELECT *
                    FROM article
                    ORDER BY storeId';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allstoreData = $res->fetchAll();

            $sql = 'SELECT `path`,`itemId`
                    FROM image
                    WHERE type = 2
                    ORDER BY itemId';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allstoreImg = $res->fetchAll();

            $this->smarty->assign('allstoreData', $allstoreData);
            $this->smarty->assign('allstoreImg', $allstoreImg);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('store/storeList.html');
        } else {
            $this->error = '請先登入!';
            $this->viewLogin();
        }
    }

    /**
     * 刪除風格
     */
    public function storeDelete($input)
    {
        if ($_SESSION['isLogin'] == true) {
            try {
                $this->db->beginTransaction();
                $sql = "DELETE FROM store
                           WHERE storeId = :storeId";
                $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
                $this->db->exec($sql);
                $this->db->commit();
                //deal with img
                $this->error = '';
                $this->msg = '刪除成功';
                $this->smarty->display('store/storeList.html');
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
