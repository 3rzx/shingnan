<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * 風格類別
 */
class User
{
    // database object
    public $db = null;
    // smarty template object
    public $smarty = null;
    // success messages
    public $msg = '';
    // error messages
    public $error = '';
    // isSearch or not search
    public $isSearch = false;

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
     * 新增使用者頁面
     */
    public function userAddPrepare()
    {
//GET
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userAdd.html');
    }

    /**
     * 新增使用者動作
     */
    public function userAdd($input)
    {
//POST
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $idGen = new IdGenerator();
        $userId = $idGen->GetID('user');
        if ($this->userAddSql($userId, $input)) {
            $this->$msg = '新增成功';
            $this->userDetailPrepare(array('userId' =>  $userId));
        }
    }

    public function userAddSql($userId, $input)
    {
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO `shingnan`.`user` (
        `userId`, `userName`, `account`,`password`,`phone`,
        `gender`,`address`, `point`,`introducerId`,`downlineNum`,
        `isDelete`, `lastUpdateTime`,`createTime`)
        VALUES (:userId, :userName, :account, :password, :phone,
        :gender, '', 0, NULL,0,
        0,:lastUpdateTime, :createTime);";

        $res = $this->db->prepare($sql);

        $res->bindParam(':userId', $userId, PDO::PARAM_STR);
        $res->bindParam(':userName', $input['userName'], PDO::PARAM_STR);
        $res->bindParam(':gender', intval($input['gender']), PDO::PARAM_INT);
        $res->bindParam(':phone', $input['phone'], PDO::PARAM_STR);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        $res->bindParam(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);

        if ($res->execute()) {
            return true;
        }

        $error = $res->errorInfo();
        $this->$error = $error[0];
    }

    public function userSearchPrepare()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userSearch.html');
    }


    public function userSearch($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $sql = "SELECT `user`.`userId`, `user`.`userName` , `user`.`gender`, `user`.`phone` ,`user`.`downlineNum`, `user`.`lastUpdateTime`
                FROM  `user`
                WHERE  `user`.`isDelete` = 0 And `user`.`userName`=:userName And `user`.`phone`=:phone
                ORDER BY `user`.`userId`";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userName', $input['userName'], PDO::PARAM_STR);
        $res->bindParam(':phone', $input['phone'], PDO::PARAM_STR);

        $res->execute();
        $searchResult = $res->fetchAll();
        $this->smarty->assign('searchResult', $searchResult);
        $this->userSearchPrepare();

        $error = $res->errorInfo();
        $this->$error = $error[0];
    }

    public function userDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        if (!isset($input['userId'])) {
            return;
        }

        $this->db->beginTransaction();
        $sql    = "DELETE FROM `user` WHERE `userId` = :userId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->execute();
        $this->db->commit();

        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`user` SET  `isDelete` = 1, `lastUpdateTime` = :lastUpdateTime WHERE `userId` = :userId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();

        $this->userSearchPrepare();
    }

    /**
     * For user detail page
     * @DateTime 2016-09-03
     */

    public function userDetailPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $userId = $input['userId'];
        $sql = "SELECT `user`.`userId`, `user`.`userName`,
                       `user`.`account`, `user`.`password`,
                       `user`.`phone`, `user`.`gender`,
                       `user`.`address`, `user`.`point`,
                       `user`.`downlineNum`
                FROM  `user`
                WHERE  `user`.`userId` = :userId AND `user`.`isDelete` = 0";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_STR);
        $res->execute();
        $userDetailData = $res->fetch();


        //find user child
         $sql = "SELECT `user`.`userId`, `user`.`userName` 
                 FROM  `user` WHERE  `user`.`introducerId` = :userId AND `user`.`isDelete` = 0";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $userId, PDO::PARAM_STR);
        $res->execute();
        $userChildrenData = $res->fetchAll();

        $this->smarty->assign('userChildrenData', $userChildrenData);
        $this->smarty->assign('userDetailData', $userDetailData);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userDetail.html');
    }

    public function userDetailEdit($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        //TODO: Finish this sql
        $sql = "UPDATE `shingnan`.`user`
                SET  `lastUpdateTime` = :lastUpdateTime,
                     `userId` = :userId, `userName` = :userName,
                     `account` = :account, `phone` = :phone,
                     `gender` = :gender, `address` = :address,
                     `gender` = :point, `address` = :address,

                WHERE `userId` = :userId;";
    }


    /**
     * For user shopping record page
     * @DateTime 2016-09-03
     */

    public function userShoppingRecordPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        //TODO: Get user id and get the correspondin user data (use uql)
        $sql = "SELECT `user`.`userId`, `user`.`userName`, `user`.`phone`
                FROM  `user`
                WHERE  `userId` = :userId;";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->execute();
        $userData = $res->fetch();

        $this->smarty->assign('userData', $userData);

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userShoppingRecord.html');
    }

    /**
     * For user user record page
     * @DateTime 2016-09-03
     */
    public function userCourseRecordPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        //TODO: Get user id and get the corespondin user data (use uql)
        $sql = "SELECT `user`.`userId`, `user`.`userName`, `user`.`phone`
                FROM  `user`
                WHERE  `userId` = :userId;";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->execute();
        $userData = $res->fetch();

        $this->smarty->assign('userData', $userData);

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userCourseRecord.html');
    }

    public function userShoppingGetData($itemType)
    {
        $sql = null;
        switch ($itemType) {
            case 'frame':
                $sql = "SELECT  `frame`.`frameName`
                    FROM  `frame`
                    WHERE `frame`.`isDelete`=0;";
                break;
            case 'glass':
                $sql = "SELECT  `glass`.`glassName`
                    FROM  `glass`
                    WHERE  `glass`.`isDelete`=0;";
                break;
            case 'len':
                $sql = "SELECT  `len`.`lenName`
                    FROM  `len`
                    WHERE  `len`.`isDelete`=0;";
                break;
            case 'part':
                $sql = "SELECT  `part`.`partName`
                    FROM  `part`
                    WHERE  `part`.`isDelete`=0;";
                break;
            default:
                break;
        }
        $res = $this->db->prepare($sql);
        $res->execute();
        return $res->fetchAll();
    }

    public function userShoppingAddPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        $idGen = new IdGenerator();
        $tranId = $idGen->GetID('tran');

        $frameData = $this->userShoppingGetData('frame');
        $glassData = $this->userShoppingGetData('glass');
        $lenData = $this->userShoppingGetData('len');
        $partData = $this->userShoppingGetData('part');

        $userId = $input['userId'];

        $this->smarty->assign('tranId', $tranId);
        $this->smarty->assign('userId', $userId);
        $this->smarty->assign('frameData', $frameData);
        $this->smarty->assign('glassData', $glassData);
        $this->smarty->assign('lenData', $lenData);
        $this->smarty->assign('partData', $partData);


        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userShoppingAdd.html');


    }

    public function userShoppingAdd($input){
        header( "Location: ../controller/userController.php?action=userShoppingRecordPrepare&userId=".$input['userId']);
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
