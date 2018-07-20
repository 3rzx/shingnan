<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * api 使用文件https://hackmd.io/s/HJBNeAG0G
 */
class Api
{
    public $db = null;

    /**
     * Api constructor
     */
    public function __construct() {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
    }

    // POST function
    public function getUserData($input) {
        if(!$this->checkAccount($input)){                  //取得資料前先卻確認帳號密碼正確性
            echo json_encode("0");
            return;
        }
        $sql = "SELECT * FROM `user` WHERE `account` = :account;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        $res->execute();
        $userData = $res->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($userData);
        return;
    }

    public function modifyUserData($input) {
        if(!$this->checkAccount($input)){                  //修改前先卻確認帳號密碼正確性
            echo json_encode('0');
            return;
        }
    }    

    public function getCouponData($input) {
        if(!$this->checkAccount($input)){                  //取得折價券先卻確認帳號密碼正確性
            echo json_encode("0");
            return;
        }
        $sql = "SELECT * FROM `coupon`, `pushCoupon` 
                WHERE `pushCoupon`.`userId` = :$userId 
                AND `pushCoupon`.`couponId` = `coupon`.`couponId`  
                AND `pushCoupon`.`isUsed` = 0 
                AND `coupon`.`lastUpdateTime` = :lastUpdateTime ;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $input['newestDate'], PDO::PARAM_STR);
        $res->execute();
        $couponData = $res->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($couponData);
        return;
    }

    public function useCoupon($input) {
        if(!$this->checkAccount($input)){                  //使用折價券前先卻確認帳號密碼正確性
            echo json_encode('0');
            return;
        }
        $sql = "INSERT INTO `pushCoupon` ( `couponId`, `userId`,`isUsed`)
                VALUES ( :couponId,  :userId,  1);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':couponId', $input['couponId'], PDO::PARAM_STR);
        if($res->execute()){
            echo json_encode('1');
            return;
        }
        echo json_encode('0');
        return;
    }

    public function getTranData($input) {           //TODO 雲凱
        if(!$this->checkAccount($input)){
            echo json_encode('0');
            return;
        }
        $userId = $input["userId"];
        $sql = "SELECT `tran`.`tranId`, `tran`.`createTime`, `tran`.`checkState`, `tran`.`price`
        FROM `tran` 
        WHERE `userID` = '{$userId}' AND `tran`.`isDelete` = 0;";
        $res = $this->db->prepare($sql);
        if(!$res->execute()) {
            goto failed;
        }
        $allTrans = $res->fetchAll();

        foreach ($allTrans as &$singleTran) {
            $sql = "SELECT `tranDetail`.`itemId`, `tranDetail`.`itemNum`
            FROM `tranDetail` 
            WHERE `tranDetail`.`tranId` = '{$singleTran["tranId"]}' AND `tranDetail`.`isDelete` = 0;";
            $res = $this->db->prepare($sql);
            if(!$res->execute()){
                goto failed;
            }
            $tranDetail = $res->fetchAll();
            $singleTran["tranDetail"] = $tranDetail;
            
            // get item name
            foreach ($singleTran["tranDetail"] as &$singleItem) {
                $whichItem = explode("_", $singleItem["itemId"])[0]; // exmaple: frame_1234 will echo frame
                $sql = "SELECT `{$whichItem}`.`{$whichItem}Name`
                FROM `{$whichItem}` 
                WHERE `{$whichItem}`.`{$whichItem}Id` = '{$singleItem["itemId"]}';";
                $res = $this->db->prepare($sql);
                if(!$res->execute()){
                    goto failed;
                }
                $resItem = $res->fetch();
                $itemName = $resItem["{$whichItem}Name"];
                $singleItem["itemName"] = $itemName;
            }
        }
        echo json_encode($allTrans);
        return;

        failed :
        echo json_encode('0');
        return;
    }

    public function bookingCourse($input){
        if(!$this->checkAccount($input)){                  //參與課程前先卻確認帳號密碼正確性
            echo json_encode('0');    
            return;
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $sql = "INSERT INTO `attendance` (`courseId`, `userId`, `state`, `lastUpdateTime`, `createTime`, `isDelete`) 
                VALUES (:courseId, :userId, :status, :lastUpdateTime, :createTime, '0') 
                ON DUPLICATE KEY UPDATE `status` = :status, `lastUpdateTime` = :lastUpdateTime ;"; 
        $res = $this->db->prepare($sql);
        $res->bindParam(':courseId', $input['courseId'], PDO::PARAM_STR);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':status', $input['status'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if($res->execute()){
            echo json_encode("1");
            return;
        }
        echo json_encode("0"); 
        return;
    }

    public function booking($input){
        if(!$this->checkAccount($input)){                  //預約前先卻確認帳號密碼正確性
            echo json_encode('0');
            return;
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $bookId = $idGen->GetID('book');
        $sql = "INSERT INTO `booking` (`bookingId`, `userId`, `storeId`, `appointmentTime`, `memo`, `createTime`, `lastUpdateTime`, `isDelete`) 
                VALUES (:bookId, :userId, :storeId, :bookingTime, :memo, :createTime, :lastUpdateTime, '0');";                           
        $res = $this->db->prepare($sql);
        $res->bindParam(':bookId', $bookId, PDO::PARAM_STR);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':storeId', $input['status'], PDO::PARAM_STR);
        $res->bindParam(':bookingTime', $input['bookingTime'], PDO::PARAM_STR);
        $res->bindParam(':memo', $input['memo'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if($res->execute()){
            echo json_encode("1");
            return;
        }
        echo json_encode("0"); 
        return;
    }

    public function checkAccount($input){
        $account = $input['account'];
        $sql = "SELECT `user`.`userId`, `user`.`account`, `user`.`password` 
                FROM `user` 
                WHERE `user`.`account` = :account;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        if (!$res->execute()){
            return false;
        }
        $result = $res->fetch();

        if (password_verify($input['passwd'], $result['password'])){
            return true;
        }
        return false;
    } 

    // GET function
    public function getScrollData($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT  `createTime` FROM  `scroll` WHERE  `createTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount==0){
            echo json_encode("0");
        }else{
            $sql = "SELECT `scroll`.*, `image`.`path` FROM  `scroll` ,  `image` WHERE  `image`.`itemid` =  `scroll`.`scrollId`;";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allScrollData = $res->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($allScrollData);
        }
    }

    public function getTryOnData($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT  `createTime` FROM  `tryOn` WHERE  `createTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount == 0){
            echo json_encode("0");
        }else{
            $sql = "SELECT  `tryOn`. * ,  `frame`.`no` ,  `frame`.`frameName` ,  `image`.`path` 
                    FROM  `tryOn` ,  `frame` ,  `image` 
                    WHERE  `tryOn`.`frameId` =  `frame`.`frameId` 
                    AND  `tryOn`.`tryOnId` =  `image`.`itemId` 
                    AND  `frame`.`isDelete` = 0; ";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allTryOnData = $res->fetchAll(PDO::FETCH_ASSOC);       
            echo json_encode($allTryOnData);
        }
    }

    public function getCourseData($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT * FROM `course` WHERE `lastUpdateTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount == 0){
            echo json_encode("0");
        }else{
            $allCourseData = $res->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($allCourseData);
        }
    }

    public function getArticle($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT `lastUpdateTime` FROM `article` WHERE `lastUpdateTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount == 0){
            echo json_encode("0");
        }else{
            $sql = "SELECT `article`.`articleId`, `article`.`title`, `article`.`preview`, `article`.`content`, `article`.`type`, 
                            `article`.`lastUpdateTime`, `article`.`isDelete`, `image`.`path` 
                    FROM `article` ,  `image` 
                    WHERE `article`.`articleId` = `image`.`itemId` 
                    AND `lastUpdateTime` >= :appDate;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
            $res->execute();
            $allArticleData = $res->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($allArticleData);
        }
    }

    public function getStoreData($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT  `lastUpdateTime` FROM `store` WHERE `lastUpdateTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount == 0){
            echo json_encode("0");
        }else{
            $sql = "SELECT `storeName`, `phoneNumber`, `address`, `description`, `isDelete` FROM  `store` WHERE `lastUpdateTime` >= :appDate;";
            $res = $this->db->prepare($sql);
            $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
            $res->execute();
            $allStoreData = $res->fetchAll(PDO::FETCH_ASSOC);    
            echo json_encode($allStoreData);        
        }
    }
}
