<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
/**
 * 前台 UI 設定
 */
class Api
{
    public $db = null;
    public $smarty = null;
    public $msg = '';
    public $error = '';

    /**
     * Api constructor
     */
    public function __construct() {
        session_start();
        // instantiate the pdo object
        $this->db = dbSetup::getDbConn();
        // instantiate the template object
        $this->smarty = new SmartyConfig();
    }

    // POST function
    public function getUserData($input) {
        if(!checkAccount($input)){                  //取得資料前先卻確認帳號密碼正確性
            return json_encode('0');
        }
        $sql = "SELECT * FROM `user` WHERE `account` = :account;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        $res->execute();
        $userData = $res->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($userData);
    }

    public function modifyUserData($input) {
        if(!checkAccount($input)){                  //修改前先卻確認帳號密碼正確性
            return json_encode('0');
        }
    }    

    public function getCouponData($input) {
        if(!checkAccount($input)){                  //取得折價券先卻確認帳號密碼正確性
            return json_encode('0');
        }
        $sql = "SELECT * FROM `coupon`, `pushCoupon` 
                WHERE `pushCoupon`.`userId` = :$userId 
                AND `pushCoupon`.`couponId` = `coupon`.`couponId` 
                AND `conpon`.`isDelete` = 0 
                AND `pushCoupon`.`isUsed` = 0;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->execute();
        $couponData = $res->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($couponData);
    }

    public function useCoupon($input) {
        if(!checkAccount($input)){                  //使用折價券前先卻確認帳號密碼正確性
            return json_encode('0');
        }
        $sql = "INSERT INTO `pushCoupon` ( `couponId`, `userId`,`isUsed`)
                VALUES ( :couponId,  :userId,  1);";
        $res = $this->db->prepare($sql);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':couponId', $input['couponId'], PDO::PARAM_STR);
        if($res->execute()){
            return json_encode('1');
        }
        return json_encode('0');
    }

    public function getTranData($input) {           //TODO 雲凱
        if(!checkAccount($input)){
            return json_encode('0');
        }
        
    }

    public function bookingCourse($input){
        if(!checkAccount($input)){                  //參與課程前先卻確認帳號密碼正確性
            return json_encode('0');    
        }
        $idGen = new IdGenerator();
        $now = date('Y-m-d H:i:s');
        $joinId = $idGen->GetID('join');
        $sql = "INSERT INTO `attendance` (`courseId`, `userId`, `state`, `lastUpdateTime`, `createTime`, `isDelete`) 
                VALUES (:courseId, :userId, :status, :lastUpdateTime, :createTime, '0') 
                ON DUPLICATE KEY UPDATE `status` = :status, `lastUpdateTime` = :lastUpdateTime ;"; 
        $res = $this->db->prepare($sql);
        $res->bindParam(':joinId', $joinId, PDO::PARAM_STR);
        $res->bindParam(':courseId', $input['courseId'], PDO::PARAM_STR);
        $res->bindParam(':userId', $input['userId'], PDO::PARAM_STR);
        $res->bindParam(':status', $input['status'], PDO::PARAM_STR);
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->bindParam(':createTime', $now, PDO::PARAM_STR);
        if($res->execute()){
            return json_encode("1");
        }
        return json_encode("0"); 
    }

    public function booking($input){
        if(!checkAccount($input)){                  //預約前先卻確認帳號密碼正確性
            return json_encode('0');
        }
        $sql = "INSERT;";                           //TODO 俊逸insert booking data
        $res = $this->db->prepare($sql);
        if($res->execute()){
            return json_encode("1");
        }
        return json_encode("0"); 
    }

    private function checkAccount($input){
        $account = $input['account'];
        $sql = "SELECT `user`.`userId`, `user`.`account`, `user`.`password` 
                FROM `user` 
                WHERE `user`.`account` = :account;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':account', $input['account'], PDO::PARAM_STR);
        if (!$res->execute())
            return false;
        $result = $res->fetch();

        if (password_verify($input['password'], $result['password']))
            return true;
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
            return json_encode("0");
        }else{
            $sql = "SELECT `scroll`.*, `image`.`path` FROM  `scroll` ,  `image` WHERE  `image`.`itemid` =  `scroll`.`scrollId`;";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allScrollData = $res->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($allScrollData);
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
            return json_encode("0");
        }else{
            $sql = "SELECT  `tryOn`. * ,  `frame`.`no` ,  `frame`.`frameName` ,  `image`.`path` 
                    FROM  `tryOn` ,  `frame` ,  `image` 
                    WHERE  `tryOn`.`frameId` =  `frame`.`frameId` 
                    AND  `tryOn`.`tryOnId` =  `image`.`itemId` 
                    AND  `frame`.`isDelete` = 0; ";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allTryOnData = $res->fetchAll(PDO::FETCH_ASSOC);            
            return json_encode($allTryOnData);
        }
    }

    public function getCourseData($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT `lastUpdateTime` FROM `course` WHERE `lastUpdateTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount == 0){
            return json_encode("0");
        }else{
            $sql = "SELECT * FROM `course` WHERE `isDelete` = 0;";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allCourseData = $res->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($allCourseData);
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
            return json_encode("0");
        }else{
            $sql = "SELECT `article`.`articleId`, `article`.`title`, `article`.`preview`, 
                            `article`.`content`, `article`.`type`,`article`.`lastUpdateTime`, `image`.`path` 
                    FROM `article` ,  `image` 
                    WHERE `article`.`articleId` = `image`.`itemId` 
                    AND `article`.`isDelete` = 0;";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allArticleData = $res->fetchAll(PDO::FETCH_ASSOC);
            return json_encode($allArticleData);
        }
    }

    public function getStoreData($input){
        $appDate = $input['newestDate'];
        $sql = "SELECT  `lastUpdateTime` FROM  `store` WHERE  `lastUpdateTime` >= :appDate;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':appDate', $appDate, PDO::PARAM_STR);
        $res->execute();
        $rowCount = $res->rowCount();
        if($rowCount == 0){
            return json_encode("0");
        }else{
            $sql = "SELECT  `storeName` ,  `phoneNumber` ,  `address` ,  `description` FROM  `store`;";
            $res = $this->db->prepare($sql);
            $res->execute();
            $allStoreData = $res->fetchAll(PDO::FETCH_ASSOC);            
            return json_encode($allStoreData);
        }
    }
}
