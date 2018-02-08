<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
require_once 'pointFile.php';

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
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $sql = "SELECT `user`.`account` FROM  `user` WHERE `isDelete`='0';";
        $res = $this->db->prepare($sql);
        $res->execute();
        $allAccount = $res->fetchAll();


        $this->smarty->assign('allAccount', $allAccount);

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userAdd.html');
    }

    /**
     * 新增使用者動作
     */
    public function userAdd($input)
    {
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
        `userId`, `userName`, `account`,`password`,`phone`,`birthday`,
        `gender`,`address`, `point`,`introducerId`,`downlineNum`,
        `isDelete`, `lastUpdateTime`,`createTime`)
        VALUES (:userId, :userName, :account, :password, :phone, :birthday,
        :gender, :address, 0, NULL,0,
        0,:lastUpdateTime, :createTime);";

        $res = $this->db->prepare($sql);

        $res->bindParam(':userId', $userId, PDO::PARAM_STR);
        $res->bindParam(':userName', $input['userName'], PDO::PARAM_STR);
        $res->bindParam(':birthday', $input['birthday'], PDO::PARAM_STR);
        $res->bindParam(':gender', intval($input['gender']), PDO::PARAM_INT);
        $res->bindParam(':phone', $input['phone'], PDO::PARAM_STR);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        $res->bindParam(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':address', $input['address'], PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if ($res->execute()) {
            return true;
        }


        $error = $res->errorInfo();
        $this->$error = $error[0];
    }

    /**
     * 搜尋使用者頁面
     */
    public function userSearchPrepare()
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }
        $searchResult=null;
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->assign('searchResult', $searchResult);
        $this->smarty->display('user/userSearch.html');
    }

    /**
     * 搜尋使用者動作
     */
    public function userSearch($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return ;
        }

        $sql = "SELECT `user`.`userId`, `user`.`userName` , `user`.`gender`, `user`.`phone` ,`user`.`downlineNum`, `user`.`lastUpdateTime`, `user`.`point`
                FROM  `user`
                WHERE  `user`.`isDelete` = 0 And `user`.`userName`=:userName And `user`.`phone`=:phone
                ORDER BY `user`.`userId`";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userName', $input['userName'], PDO::PARAM_STR);
        $res->bindParam(':phone', $input['phone'], PDO::PARAM_STR);

        $res->execute();
        $searchResult = $res->fetchAll();
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->assign('searchResult', $searchResult);
        $this->smarty->display('user/userSearch.html');


        $error = $res->errorInfo();
        $this->$error = $error[0];
    }


    /**
     * 刪除使用者動作
     */
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

        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`user` SET  `isDelete` = 1, `lastUpdateTime` = :lastUpdateTime WHERE `userId` = :userId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();
    }

    /**
     * 使用者詳細資料頁面
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
                       `user`.`downlineNum`, `user`.`birthday`
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

    /**
     * 使用者詳細編輯動作
     */
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
                     `birthday` = :birthday
                WHERE `userId` = :userId;";

        $now = date('Y-m-d H:i:s');
        $res = $this->db->prepare($sql);

        $res->bindParam(':birthday', $input['birthday'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':userName', $input['userName'], PDO::PARAM_STR);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        $res->bindParam(':phone', $input['phone'], PDO::PARAM_STR);
        $res->bindParam(':gender', intval($input['gender']), PDO::PARAM_INT);
        $res->bindParam(':address', $input['address'], PDO::PARAM_STR);
        $res->execute();

        header("Location: ../controller/userController.php?action=userDetailPrepare&userId={$input["userId"]}");
    }


    /**
     * 會員購物資料頁面
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
        $sql = "SELECT `tran`.`tranId`, `tran`.`point`, `tran`.`checkState`, `tran`.`createTime`, `tran`.`score`, `tran`.`lastUpdateTime`, `tran`.`price`
                FROM  `tran`
                WHERE  `userId` = '{$input['userId']}' AND `isDelete` = 0;";

        $res = $this->db->prepare($sql);
        $res->execute();
        $allTranData = $res->fetchAll();

        $this->smarty->assign('allTranData', $allTranData);


        $sql = "SELECT `user`.`point`
                FROM  `user`
                WHERE  `userId` = '{$input['userId']}' AND `isDelete` = 0;";

        $res = $this->db->prepare($sql);
        $res->execute();
        $result = $res->fetch();
        $point = $result['point'];

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->assign('userId', $input['userId']);
        $this->smarty->assign('point', $point);
        $this->smarty->display('user/userShoppingRecord.html');
    }

    /**
     * 會員課程紀錄頁面
     * @DateTime 2016-09-03
     */
    public function userCourseRecordPrepare($input)
    {
        //TODO
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $sql = "SELECT `attendance`.`joinId`, `attendance`.`courseId`, `attendance`.`state`, `attendance`.`lastUpdateTime`,`course`.`courseName`
                FROM `attendance`
                LEFT JOIN `course` ON `attendance`.`courseId` = `course`.`courseId`
                WHERE  `userId` = '{$input["userId"]}';";

        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->execute();
        $allUserCourseData = $res->fetchAll();

        $this->smarty->assign('userId', $input['userId']);
        $this->smarty->assign('allUserCourseData', $allUserCourseData);

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userCourseRecord.html');
    }

    public function updateUserAttendance($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        $now = date('Y-m-d H:i:s');
        $attendanceState = $input["attendanceState"];
        $courseId = $input["courseId"];
        $sql = "UPDATE `shingnan`.`attendance` SET  `state` = '{$attendanceState}', `lastUpdateTime` = '{$now}' WHERE `courseId` = '{$courseId}';";
        $res = $this->db->prepare($sql);
        $res->execute();

        if (!$res) {
            $error = $res->errorInfo();
            return $sql;
        }
        return $sql;
    }

    public function userShoppingGetData($itemType)
    {
        $sql = null;
        switch ($itemType) {
            case 'frame':
                $sql = "SELECT  `frame`.`frameId`, `frame`.`frameName`
                    FROM  `frame`
                    WHERE `frame`.`isDelete`=0;";
                break;
            case 'glass':
                $sql = "SELECT  `glass`.`glassId`, `glass`.`glassName`
                    FROM  `glass`
                    WHERE  `glass`.`isDelete`=0;";
                break;
            case 'len':
                $sql = "SELECT  `len`.`lenId`, `len`.`lenName`
                    FROM  `len`
                    WHERE  `len`.`isDelete`=0;";
                break;
            case 'part':
                $sql = "SELECT  `part`.`partId`, `part`.`partName`
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

    /**
     * 新增交易紀錄頁面
     */
    public function userShoppingAddPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }


        $frameData = $this->userShoppingGetData('frame');
        $glassData = $this->userShoppingGetData('glass');
        $lenData = $this->userShoppingGetData('len');
        $partData = $this->userShoppingGetData('part');

        $userId = $input['userId'];

        $this->smarty->assign('userId', $userId);
        $this->smarty->assign('frameData', $frameData);
        $this->smarty->assign('glassData', $glassData);
        $this->smarty->assign('lenData', $lenData);
        $this->smarty->assign('partData', $partData);


        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('user/userShoppingAdd.html');
    }

    /**
     * 新增交易紀錄動作
     */
    public function userShoppingAdd($input)
    {
        $idGen = new IdGenerator();
        $tranId = $idGen->GetID("tran");
        
        $pointRateGen = new pointFile();
        $pointRate = (int)($pointRateGen->GetRate());

        $now = date('Y-m-d H:i:s');
        $point = intdiv((int)$input["price"], $pointRate);

        // TODO: checkState to be set
        // create transaction row
        $sql = "INSERT INTO `shingnan`.`tran` (
        `tranId`, `userId`, `description`,`checkState`, `price`, `point`, `isDelete`, `lastUpdateTime`,`createTime`)
        VALUES ('{$tranId}', '{$input["userId"]}', '{$input["description"]}', '{$input["checkState"]}', '{$input["price"]}', '{$point}','0', '{$now}', '{$now}' );";

        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }

        // create transaction detail
        $sql = "INSERT INTO `shingnan`.`tranDetail` (`tranId`, `itemId`, `itemNum`,`actionState`, `isDelete`) VALUES ";
        for ($i = 0; $i < (int)$input['tranDetailLength']; $i++) {
            $itemId = $input["itemName_{$i}"];
            $itemNum = $input["amount_{$i}"];
            $actionState = 0; //TODO: actionState to be set
            $sql .= "('{$tranId}', '{$itemId}', '{$itemNum}', '{$actionState}', '0'),";
        }
        $sql = substr_replace($sql, ';', -1);
        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }


        // sum of user point
        $sql = "SELECT `tran`.`point`
                FROM  `tran`
                WHERE  `tran`.`isDelete` = 0 And `tran`.`userId`='{$input["userId"]}';";
        $res = $this->db->prepare($sql);
        $res->execute();
        $allPoints = $res->fetchAll();
        $sumOfPoints = 0;
        foreach ($allPoints as $p) {
            $sumOfPoints += $p["point"];
        }

        // update user point
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `shingnan`.`user` SET  `point` = '{$sumOfPoints}', `lastUpdateTime` = '{$now}' WHERE `userId` = '{$input["userId"]}';";
        $res = $this->db->prepare($sql);
        $res->execute();
        header("Location: ../controller/userController.php?action=userShoppingRecordPrepare&userId={$input["userId"]}");
    }

    /**
     * 編輯交易紀錄頁面
     */
    public function userShoppingRecordEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $tranId = $input['tranId'];
        $frameData = $this->userShoppingGetData('frame');
        $glassData = $this->userShoppingGetData('glass');
        $lenData = $this->userShoppingGetData('len');
        $partData = $this->userShoppingGetData('part');


        $this->smarty->assign('frameData', $frameData);
        $this->smarty->assign('glassData', $glassData);
        $this->smarty->assign('lenData', $lenData);
        $this->smarty->assign('partData', $partData);

        // get tranData
        $sql = "SELECT `tran`.`tranId`, `tran`.`price`, `tran`.`description`, `tran`.`userId`, `tran`.`score`, `tran`.`opinion`, `tran`.`checkState`
                FROM `tran`
                WHERE `tranId` = '{$input["tranId"]}';";

        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }
        $tranData = $res->fetch();
        $this->smarty->assign('tranData', $tranData);

        // get corresponding trainDetail data
        $sql = "SELECT  `tranDetail`.`itemId` ,  `tranDetail`.`itemNum`
                FROM  `tranDetail`
                WHERE  `tranId` =  '{$input['tranId']}' AND `isDelete` = 0;";

        $res = $this->db->prepare($sql);
        $res->execute();
        $allTranDetailData = $res->fetchAll();

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->assign('allTranDetailData', $allTranDetailData);
        $this->smarty->display('user/userShoppingRecordEdit.html');
    }

    /**
     * 編輯交易紀錄動作
     */
    public function userShoppingRecordEdit($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        $pointRateGen = new PointFile();
        $pointRate = (int)($pointRateGen->GetRate());

        $now = date('Y-m-d H:i:s');
        $point = intdiv((int)$input["price"], $pointRate);
        $tranId = $input["tranId"];

        // user point minus the original point and add the  point which is modified
        $sql = "SELECT `user`.`point`
                FROM  `user`
                WHERE  `userId` = '{$input['userId']}' AND `isDelete` = 0;";

        $res = $this->db->prepare($sql);
        $res->execute();
        $result = $res->fetch();
        $userPoint = $result['point'];

        $sql = "SELECT `tran`.`point`
                FROM  `tran`
                WHERE  `tranId` = '{$tranId}' AND `isDelete` = 0;";
        $res = $this->db->prepare($sql);
        $res->execute();
        $result = $res->fetch();
        $originalTranPoint = $result['point'];
        
    
        $newPoint = (int)$userPoint - (int)$originalTranPoint + $point;
        $sql = "UPDATE `shingnan`.`user`
                SET `point`='{$newPoint}'
                WHERE `user`.`userId`='{$input['userId']}';";
        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }



        // update tran data
        $sql = "UPDATE `shingnan`.`tran`
                SET `description`='{$input["description"]}', `price`='{$input["price"]}', `lastUpdateTime`='{$now}', `checkState`='{$input["checkState"]}', `point`='{$point}'
                WHERE `tran`.`tranId`='{$tranId}';";

        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }

        $sql = "DELETE FROM `tranDetail` WHERE `tranId` = '{$tranId}';";
        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }


        //update tran detail data
        $sql = "INSERT INTO `tranDetail` ( `tranId`,`itemId`,`itemNum`,`actionState`, `isDelete`) VALUES ";

        for ($i = 0; $i < (int)$input['tranDetailLength']; $i++) {
            $itemId = $input["itemName_{$i}"];
            $itemNum = $input["amount_{$i}"];

            if ($input["state_{$i}"] === "insert" || $input["state_{$i}"] === "update") {
                $sql .= "('{$tranId}', '{$itemId}', '{$itemNum}', '0', '0'),";
            }
            if ($input["state_{$i}"] === "delete") {
                $sql .= "('{$tranId}', '{$itemId}', '{$itemNum}', '0', '1'),";
            }
        }

        $sql = substr_replace($sql, " ", -1);
        $sql .= "ON DUPLICATE KEY UPDATE `itemNum`=VALUES(`itemNum`), `actionState`=VALUES(`actionState`), `isDelete`=VALUES(`isDelete`);";
        $res = $this->db->prepare($sql);
        if (!$res->execute()) {
            return ;
        }
        header("Location: ../controller/userController.php?action=userShoppingRecordPrepare&userId={$input["userId"]}");
    }

    /**
     * 刪除交易紀錄動作
     */
    public function userShoppingRecordDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        $now = date('Y-m-d H:i:s');

        // delete tran
        $sql = "UPDATE `shingnan`.`tran` SET  `isDelete` = 1, `lastUpdateTime` = '{$now}' WHERE `tranId` = '{$input["tranId"]}';";
        $res = $this->db->prepare($sql);
        $res->execute();

        // delete corresponding tranDetail
        $sql = "UPDATE `shingnan`.`tranDetail` SET `isDelete` = 1  WHERE `tranId` = '{$input["tranId"]}';";
        $res = $this->db->prepare($sql);
        $res->execute();

        // get user point
        $sql = "SELECT `tran`.`point` AS `tranPoint`, `tran`.`userId`, `user`.`point` AS `userPoint`
                FROM  `tran`
                LEFT JOIN `user` ON `tran`.`userId` = `user`.`userId`
                WHERE  `tranId` = '{$input["tranId"]}';";
        $res = $this->db->prepare($sql);
        $res->execute();
        $result = $res->fetch();

        $remainPoint = (int)$result["userPoint"] - (int)$result["tranPoint"];
        $sql = "UPDATE `shingnan`.`user` SET  `point` = '{$remainPoint}', `lastUpdateTime` = '{$now}' WHERE `userId` = '{$result["userId"]}';";
        $res = $this->db->prepare($sql);
        $res->execute();
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
