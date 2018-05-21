<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
require_once 'IdGenerator.php';
require_once 'pointFile.php';

/**
 * 訊息 or 折價卷推播 類別
 */
class Coupon
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
     * 新增訊息 or 折價卷推播 頁面
     */
    public function couponAddPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }


        $this->smarty->display('coupon/couponAdd.html');
    }

    /**
     * 新增訊息 or 折價卷推播 動作
     */
    public function couponAdd($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }


        $idGen = new IdGenerator();
        $couponId = $idGen->GetID('coupon');
        $now = date('Y-m-d H:i:s');

        // insert coupon
        $couponPrice = $input["couponType"] === "2" ? intval($input["price"]) : 0; // type=1 -> info   type=2 -> coupon
        $limitStrTemplate= ":couponPriceStatement;".
                   "活動日期:{$input["activity"]["startDate"]} - {$input["activity"]["endDate"]};".
                   "性別::genderStatement;".
                   "生日::birthdayStatement;".
                   "最後交易時間::lastTranStatement;".
                   "單筆交易金額::singlePayStatement;".
                   "交易總金額::allPayStatement";
        $genderStatement =  $input['gender']['enable'] === 'on' ? ($intput["gender"]["val"] === '1' ?  '女' : '男') : '-' ;
        $birthdayStatement = $input['birthday']['enable'] === 'on' ? 
                            "{$input["birthday"]["startDate"]} - {$input["birthday"]["endDate"]}" : '-';
        $lastTranStatement = $input['lastTran']['enable'] === 'on' ?
                            "{$input["lastTran"]["startDate"]} - {$input["lastTran"]["endDate"]}" : '-';
        $singlePayStatement = $input['singlePay']['enable'] === 'on' ? 
                            "{$input["singlePay"]["min"]} - {$input["singlePay"]["max"]}" : '-';
        $allPayStatement = $input['allPay']['enable'] === 'on' ?
                            "{$input["allPay"]["min"]} - {$input["allPay"]["max"]}" : '-';
        $couponPriceStatement = $couponPrice === 0 ? "" :  "面額:{$couponPrice}" ;

        $mapping = [
            ":couponPriceStatement" => $couponPriceStatement,
            ":couponId" => $couponId,
            ":genderStatement" => $genderStatement,
            ":birthdayStatement" => $birthdayStatement,
            ":lastTranStatement" => $lastTranStatement,
            ":singlePayStatement" => $singlePayStatement,
            ":allPayStatement" => $allPayStatement
        ];
        $limitStr = strtr($limitStrTemplate, $mapping);

        $sql = "INSERT INTO `coupon`(`couponId`, `type`, `price`, `title`, `content`, `limit`,`startTime`, `endTime`, `isDelete`, `createTime`, `lastUpdateTime`)
                 VALUES ('{$couponId}', '{$input["couponType"]}' , '{$couponPrice}', '{$input["title"]}', '{$input["content"]}', '{$limitStr}','{$input["activity"]["startDate"]}', '{$input["activity"]["endDate"]}','0', '{$now}', '{$now}')";

        $res = $this->db->prepare($sql);
        if(!$res->execute()) {
            goto failed;
        }
        /*   push coupon or info */
        // EXAMPLE:
        // SELECT  `user`.`userId` , MAX( IFNULL( (`tran`.`price`), 0 ) ), SUM(IFNULL( (`tran`.`price`), 0 ) )
        // FROM  `user` 
        // LEFT JOIN  `tran` ON  `user`.`userId` =  `tran`.`userId`
        // WHERE `user`.`gender`=1 AND `user`.`birthday` < Now() AND `tran`.`lastUpdateTime` < Now()
        // GROUP BY  `user`.`userId`
        // HAVING (MAX(IFNULL((`tran`.`price`),0)) BETWEEN 0 AND 10000 )
        //    AND (SUM(IFNULL((`tran`.`price`),0)) BETWEEN 0 AND 10000 );
        $genderStatement = $input['gender']['enable'] === 'on' ? "`user`.`gender`={$input["gender"]["val"]}" : '1';
        $birthdayStatement = $input['birthday']['enable'] === 'on' ? 
            "(`user`.`birthday` BETWEEN '{$input["birthday"]["startDate"]}' AND '{$input["birthday"]["endDate"]}')" : '1';
        $lastTranStatement = $input['lastTran']['enable'] === 'on' ? 
            "(`tran`.`lastUpdateTime` BETWEEN '{$input["lastTran"]["startDate"]}' AND '{$input["lastTran"]["endDate"]}')" : '1';
        $singlePayStatement = $input['singlePay']['enable'] === 'on' ? 
            "(MAX(IFNULL((`tran`.`price`),0)) BETWEEN {$input["singlePay"]["min"]} AND {$input["singlePay"]["max"]})" : '1';
        $allPayStatement = $input['allPay']['enable'] === 'on' ?
            "(SUM(IFNULL((`tran`.`price`),0)) BETWEEN {$input["allPay"]["min"]} AND {$input["allPay"]["max"]})" : '1';
        
        $sqlTemplate = "INSERT INTO `pushCoupon`(`userId`,`couponId`,`isUsed`)
                        SELECT `user`.`userId`, ':couponId', '0'
                        FROM `user`
                        LEFT JOIN `tran` ON `user`.`userId`=`tran`.`userId`
                        WHERE :genderStatement AND :birthdayStatement AND :lastTranStatement
                        GROUP BY `user`.`userId`
                        HAVING :singlePayStatement
                        AND :allPayStatement ;";
        $mapping = [
            ":couponId" => $couponId,
            ":genderStatement" => $genderStatement,
            ":birthdayStatement" => $birthdayStatement,
            ":lastTranStatement" => $lastTranStatement,
            ":singlePayStatement" => $singlePayStatement,
            ":allPayStatement" => $allPayStatement
        ];
        $sql = strtr($sqlTemplate, $mapping);
        $res = $this->db->prepare($sql);
        if(!$res->execute()) {
            goto failed;
        }

        //info
        if ($input["couponType"] === '1') {
            header("Location: ../controller/couponController.php?action=infoList");
        }

        // coupon
        if ($input["couponType"] === '2') {
            header("Location: ../controller/couponController.php?action=couponList");
        }


        // TODO: goto couponList or infoList view page

        failed:
        $error = $res->errorInfo();
        $this->$error = $error[0];
        //$this->viewLogin();
    }

    /**
     * 編輯折價卷推播 頁面
     */
    public function couponEditPrepare($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $sql = "SELECT `coupon`.`limit`,  `coupon`.`title`, `coupon`.`content`
                FROM `coupon` 
                WHERE `coupon`.`couponId` = :couponId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':couponId', $input['couponId'], PDO::PARAM_STR);
        $res->execute();
        $result = $res->fetch();
        $constrains = explode(";", $result['limit']);
        $couponDetail = [];
        foreach ($constrains as &$constrain) {
            $constrainName = explode(":", $constrain)[0];
            $constrainVal = explode(":", $constrain)[1];
            $couponDetail += [$constrainName => $constrainVal];
        }
        $couponDetail += ["標題" => $result["title"]];
        $couponDetail += ["內容" => $result["content"]];

        $this->smarty->assign('couponDetail', $couponDetail);
        $this->smarty->display('coupon/couponEdit.html');

       

    }


    /**
     * 折價卷 列表頁面
     */
    public function couponList($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        $sql = "SELECT `couponId`, `type`, `title`, `startTime`, `endTime`, `limit`,`isDelete`, `createTime`, `lastUpdateTime` 
                FROM `coupon` 
                WHERE `coupon`.`isDelete` = 0 AND `coupon`.`type` = 2
                ORDER BY `coupon`.`couponId`;";
        $res = $this->db->prepare($sql);
        $res->execute();
        $allCoupons = $res->fetchAll();
        $this->smarty->assign('allCoupons', $allCoupons);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('coupon/couponList.html');
    }

    /**
     * 訊息 編輯頁面
     */
    public function infoEditPrepare($input) {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $sql = "SELECT `coupon`.`limit`,  `coupon`.`title`, `coupon`.`content`
                FROM `coupon` 
                WHERE `coupon`.`couponId` = :couponId;";
        $res = $this->db->prepare($sql);
        $res->bindParam(':couponId', $input['couponId'], PDO::PARAM_STR);
        $res->execute();
        $result = $res->fetch();
        $constrains = explode(";", $result['limit']);
        $infoDetail = [];
        foreach ($constrains as &$constrain) {
            $constrainName = explode(":", $constrain)[0];
            $constrainVal = explode(":", $constrain)[1];
            $infoDetail += [$constrainName => $constrainVal];
        }
        $infoDetail += ["標題" => $result["title"]];
        $infoDetail += ["內容" => $result["content"]];

        $this->smarty->assign('infoDetail', $infoDetail);
        $this->smarty->display('coupon/infoEdit.html');
    }

    /**
     * 訊息 列表頁面
     */
    public function infoList($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }

        $sql = "SELECT `couponId`, `type`, `title`, `startTime`, `endTime`, `isDelete`, `createTime`, `lastUpdateTime` 
                FROM `coupon` 
                WHERE `coupon`.`isDelete` = 0 AND `coupon`.`type` = 1
                ORDER BY `coupon`.`couponId`;";
        $res = $this->db->prepare($sql);
        $res->execute();
        $allInfos = $res->fetchAll();
        $this->smarty->assign('allInfos', $allInfos);
        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('coupon/infoList.html');

    }

    /**
     * 刪除折價卷推播 動作
     */
    public function couponDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `coupon` 
                SET `isDelete`=1, `lastUpdateTime` = :lastUpdateTime
                WHERE `couponId` = :couponId;";
        
        $res = $this->db->prepare($sql);
        $res->bindParam(':couponId', $input['couponId'], PDO::PARAM_STR);
        echo("TEST");
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();
        echo($input['couponId']);
        header("Location: ../controller/couponController.php?action=couponList");

    }

    public function infoDelete($input)
    {
        if ($_SESSION['isLogin'] == false) {
            $this->error = '請先登入!';
            $this->viewLogin();
            return;
        }
        $now = date('Y-m-d H:i:s');
        $sql = "UPDATE `coupon` 
                SET `isDelete`=1, `lastUpdateTime` = :lastUpdateTime
                WHERE `couponId` = :couponId;";
        
        $res = $this->db->prepare($sql);
        $res->bindParam(':couponId', $input['couponId'], PDO::PARAM_STR);
        echo("TEST");
        $res->bindParam(':lastUpdateTime', $now, PDO::PARAM_STR);
        $res->execute();
        echo($input['couponId']);
        header("Location: ../controller/couponController.php?action=infoList");

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

    public function isNullOrEmptyString($question)
    {
        return (!isset($question) || trim($question) === '');
    }
}
