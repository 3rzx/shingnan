<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/coupon.lib.php';

$coupon = new Coupon();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'couponAdd':
                $coupon->couponAdd($_POST);
                break;
            case 'couponEdit':
                $coupon->couponEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'couponAddPrepare':
                $coupon->couponAddPrepare($_GET);
                break;
            case 'couponEditPrepare':
                $coupon->couponEditPrepare($_GET);
                break;
            case 'couponList':
                $coupon->couponList($_GET);
                break;
            case 'couponDelete':
                $coupon->couponDelete($_GET);
                break;
            case 'infoEditPrepare':
                $coupon->infoEditPrepare($_GET);
                break;
            case 'infoList':
                $coupon->infoList($_GET);
                break;
            case 'infoDelete':
                $coupon->infoDelete($_GET);
                break;
            default:
                $coupon->viewLogin();
        }
        break;
}
