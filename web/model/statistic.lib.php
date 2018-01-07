<?php
// initialize
require_once HOME_DIR . 'configs/config.php';
/**
 * 統計類別
 */
class Statistic
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
     * 顯示文章點閱率
     */
    public function viewArticleClick() {
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT * FROM `article`";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $articleList = $res->fetchAll();
                $this->setResultMsg();
                $typeMap = array(
                    1 => '衛教文章',
                    2 => '新知趨勢',
                    3 => '興南生活'
                );

                $this->smarty->assign('articleList', $articleList);   
                $this->smarty->assign('typeMap', $typeMap);            
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('statistic/articleClick.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 顯示商品點閱率
     */
    public function viewGoodsClick() {
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT `frame`.*, COUNT(`frameClick`.`itemId`) AS `ctr`
                    FROM `frame` LEFT JOIN `frameClick`
                    ON `frame`.`frameId` = `frameClick`.`itemId`
                    GROUP BY `frame`.`frameId`";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $frameList = $res->fetchAll();
                $this->setResultMsg();
                $shapeMap = array(
                    1 => '圓',
                    2 => '方',
                    3 => '全',
                    4 => '半',
                    5 => '無',
                    6 => '混合'
                );

                $this->smarty->assign('frameList', $frameList);
                $this->smarty->assign('shapeMap', $shapeMap);
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('statistic/goodsClick.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 顯示消費紀錄列表
     */
    public function viewOrderHistory() {
        if ($_SESSION['isLogin'] == true) {
            $sql = "SELECT *, `user`.`userName`, `user`.`gender` 
                    FROM `tran` INNER JOIN `user` 
                    ON `tran`.`userId` = `user`.`userId`";
            $res = $this->db->prepare($sql);

            if ($res->execute()) {
                $orderHistory = $res->fetchAll();
                $this->setResultMsg();
                $fieldMap = array(
                    1 => '女',
                    2 => '男',
                    3 => '購物',
                    4 => '維修',
                    5 => '非金錢來往行為',
                    6 => '未付任何金錢',
                    7 => '已付訂金',
                    8 => '已結清尾款'
                );

                $this->smarty->assign('orderHistory', $orderHistory);
                $this->smarty->assign('fieldMap', $fieldMap);           
            } else {
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('statistic/orderHistory.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 使用日期查詢消費紀錄列表
     */
    public function queryOrderHistoryByDate($input) {
        $startDate = $input['startDate'];
        $endDate = $input['endDate'];

        $sql = "SELECT * FROM `tran` 
                WHERE `lastUpdateTime` >= :startDate 
                AND `lastUpdateTime` <= :endDate";
        $res = $this->db->prepare($sql);
        $res->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $res->bindParam(':endDate', $endDate, PDO::PARAM_STR);

        if ($res->execute()) {
            $orderHistory = $res->fetchAll();
            $this->setResultMsg();

            $this->smarty->assign('orderHistory', $orderHistory);
        } else {        
            $error = $res->errorInfo();
            $this->setResultMsg('failure', $error[0]);
        }

        $this->smarty->assign('error', $this->error);
        $this->smarty->assign('msg', $this->msg);
        $this->smarty->display('statistic/orderHistory.html');
    }

    /**
     * 使用日期查詢文章點擊率列表
     */
    public function articleQueryByDate($input) {
        if ($_SESSION['isLogin'] == true) {
            $startDate = $input['startDate'];
            $endDate = $input['endDate'];

            $sql = "SELECT * FROM `article` 
                    WHERE `lastUpdateTime` >= :startDate 
                    AND `lastUpdateTime` <= :endDate";
            $res = $this->db->prepare($sql);
            $res->bindParam(':startDate', $startDate, PDO::PARAM_STR);
            $res->bindParam(':endDate', $endDate, PDO::PARAM_STR);

            if ($res->execute()) {
                $articleList = $res->fetchAll();
                $this->setResultMsg();
                $typeMap = array(
                    1 => '衛教文章',
                    2 => '新知趨勢',
                    3 => '興南生活'
                );

                $this->smarty->assign('articleList', $articleList);   
                $this->smarty->assign('typeMap', $typeMap);
            } else {        
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('statistic/articleClick.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
        }
    }

    /**
     * 使用日期查詢商品點擊率列表
     */
    public function goodsQueryByDate($input) {
        if ($_SESSION['isLogin'] == true) {
            $startDate = $input['startDate'];
            $endDate = $input['endDate'];

            $sql = "SELECT `frame`.*, COUNT(`frameClick`.`itemId`) AS `ctr`
                    FROM `frame` LEFT JOIN `frameClick`
                    ON `frame`.`frameId` = `frameClick`.`itemId`
                    AND `frameClick`.`createTime` >= :startDate 
                    AND `frameClick`.`createTime` <= :endDate
                    GROUP BY `frame`.`frameId`";
            $res = $this->db->prepare($sql);
            $res->bindParam(':startDate', $startDate, PDO::PARAM_STR);
            $res->bindParam(':endDate', $endDate, PDO::PARAM_STR);

            if ($res->execute()) {
                $frameList = $res->fetchAll();
                $this->setResultMsg();
                $shapeMap = array(
                    1 => '圓',
                    2 => '方',
                    3 => '全',
                    4 => '半',
                    5 => '無',
                    6 => '混合'
                );

                $this->smarty->assign('frameList', $frameList);
                $this->smarty->assign('shapeMap', $shapeMap);
            } else {        
                $error = $res->errorInfo();
                $this->setResultMsg('failure', $error[0]);
            }

            $this->smarty->assign('error', $this->error);
            $this->smarty->assign('msg', $this->msg);
            $this->smarty->display('statistic/goodsClick.html');
        } else {
            $this->setResultMsg('failure', '請先登入!');
            $this->viewLogin();
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
