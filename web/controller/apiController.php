<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/api.lib.php';
$api = new Api();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';          //POST取得的都是需要密碼得資料
        switch ($action) {
            case 'userLogin':                       //使用者登入  
                $api->getUserData($_POST);
                break;
            case 'modifyUserData':                  //更改使用者資料
                $api->modifyUserData($_POST);
                break;
            case 'getCouponData':                   //取得優惠訊息
                $api->getCouponData($_POST);
                break;
            case 'useCoupon':                       //使用優惠券
                $api->useCoupon($_POST);
                break;
            case 'getTranData':                     //取得交易紀錄
                $api->getTranData($_POST);
                break;
            case 'bookingCourse':                   //課程參與
                $api->bookingCourse($_POST);
                break;
            case 'booking':                         //預約服務
                $api->booking($_POST);
                break;
            default :
                echo json_encode("Ooh wrong POST method!");
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'get';
        switch ($action) {
            case 'getScrollOnData':                 //取得跑馬燈  傳create time回來比較
                $api->getScrollData($_GET);
                break;
            case 'getTryOnData':                    //取得試戴鏡框 傳lastupdate time回來比較
                $api->getTryOnData($_GET);
                break;
            case 'getCourseData':                   //取得課程資訊 傳lastupdate time回來比較
                $api->getCourseData($_GET);
                break;
            case 'getArticle':                      //取得文章資訊 傳lastupdate time回來比較
                $api->getArticle($_GET);
                break;
            case 'getStoreData':                    //取得店家資訊 傳lastupdate time回來比較
                $api->getStoreData($_GET);
                break;
            default :
                echo json_encode("Ooh wrong GET method!");
                break;
        }
        break;
}

