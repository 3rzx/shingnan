<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * 店家類別
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
     * 新增店家格式
     */
    public function storeAddPrepare()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('store/storeAdd.html');
        }
    }

    /**
     * 新增店家
     */
    public function storeAdd($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $idGen = new IdGenerator();
            $now = date('Y-m-d H:i:s');
            $storeId = $idGen->GetID('store');
            $sql = "INSERT INTO `store` (`storeId`, `storeName`, `phoneNumber`, `address`, `businessFrom`,`businessTo`, `description`, `isDelete`, `lastUpdateTime`, `createTime`) VALUES (:storeId, :storeName, :phoneNumber, :address, :businessFrom , :businessTo , :description, '0', :lastUpdateTime, :createTime);";
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $storeId, PDO::PARAM_STR);
            $res->bindParam(':storeName', $input['storeName'], PDO::PARAM_STR);
            $res->bindParam(':phoneNumber', $input['storePhone'], PDO::PARAM_STR);
            $res->bindParam(':address', $input['storeAddress'], PDO::PARAM_STR);
            $res->bindParam(':businessFrom', $input['businessFrom'], PDO::PARAM_STR);
            $res->bindParam(':businessTo', $input['businessTo'], PDO::PARAM_STR);
            $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->bindParam(':createTime', $now, PDO::PARAM_STR);
            if ($res->execute()) {
                $this->msg = '新增成功';
            } else {
                $error = $res->errorInfo();
                $this->error = $error[0];
                $this->storeList();
            }

            $this->storeList();
        }
    }

    /**
     * 編輯店家前置
     */
    public function storeEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $sql = "SELECT `store`.`storeId`, `store`.`storeName` , `store`.`phoneNumber` , `store`.`address` , `store`.`description` , `store`.`businessFrom`, `store`.`businessTo`
                        FROM  `store`
                        WHERE  `store`.`isDelete` = 0 and `store`.`storeId` = :storeId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->execute();
            $storeData = $res->fetch();

            $this->smarty->assign('storeData', $storeData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->display('store/storeEdit.html');
        }
    }

    /**
     * 編輯店家
     */
    public function storeEdit($input)
    {
        //
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE `store` SET `storeName` = :storeName ,`phoneNumber` = :phoneNumber , `address` =  :address , `description` =  :description , `businessFrom` =  :businessFrom , `businessTo` =  :businessTo ,
                `lastUpdateTime` = :lastUpdateTime
                WHERE  `store`.`storeId` = :storeId";
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->bindParam(':storeName', $input['storeName'], PDO::PARAM_STR);
            $res->bindParam(':phoneNumber', $input['phoneNumber'], PDO::PARAM_STR);
            $res->bindParam(':address', $input['address'], PDO::PARAM_STR);
            $res->bindParam(':description', $input['description'], PDO::PARAM_STR);
            $res->bindParam(':businessFrom', $input['businessFrom'], PDO::PARAM_STR);
            $res->bindParam(':businessTo', $input['businessTo'], PDO::PARAM_STR);
            $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
            $res->execute();

            if ($res->execute()) {
                $this->msg = '更新成功';
            } else {
                $error = $res->errorInfo();
                $this->error = $error[0];
                $this->storeList();
            }

            $this->storeList();
        }
    }

    /**
     * 顯示所有店家列表
     */
    public function storeList()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            // get all data from store
            $sql = 'SELECT `store`.`storeId`, `store`.`storeName` , `store`.`phoneNumber`,`store`.`address` , `store`.`businessFrom`,`store`.`businessTo`, `store`.`description` ,`store`.`lastUpdateTime`,`store`.`createTime`
                FROM  `store`
                ORDER BY `store`.`storeId`';
            $res = $this->db->prepare($sql);
            $res->execute();
            $allstoreData = $res->fetchAll();

            $this->smarty->assign('allstoreData', $allstoreData);
            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('store/storeList.html');
        }
    }

    /**
     * 刪除店家
     */
    public function storeDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
        } else {
            $this->db->beginTransaction();
            $sql = "DELETE FROM `store` WHERE `storeId` = :storeId;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':storeId', $input['storeId'], PDO::PARAM_STR);
            $res->execute();
            $this->db->commit();
            $this->error = '';
            $this->msg = '刪除成功';
            $this->storeList();
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
