<?php
//initialize
//ini_set("display_errors", "on");

//error_reporting(E_ALL ^ E_NOTICE);
require_once '../configs/source.php';
require_once HOME_DIR . 'model/user.lib.php';

$user = new User();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'userAdd':
                $user->userAdd($_POST);
                break;
            case 'userSearch':
                $user->userSearch($_POST);
                break;
            case 'userDelete':
                $user->userDelete($_POST);
                break;
            case 'userDetailEdit':
                $user->userDetailEdit($_POST);
                break;
            case 'userShoppingAdd':
                $user->userShoppingAdd($_POST);
                break;
            case 'userShoppingRecordDelete':
                $user->userShoppingRecordDelete($_POST);
                break;
            case 'userShoppingRecordEdit':
                $user->userShoppingRecordEdit($_POST);
                break;
            default:
                $user->viewLogin();
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'userAddPrepare':
                $user->userAddPrepare();
                break;
            case 'userSearchPrepare':
                $user->userSearchPrepare();
                break;
            case 'userDetailPrepare':
                $user->userDetailPrepare($_GET);
                break;
            case 'userShoppingRecordPrepare':
                $user->userShoppingRecordPrepare($_GET);
                break;
            case 'userCourseRecordPrepare':
                $user->userCourseRecordPrepare($_GET);
                break;

            case 'userShoppingAddPrepare':
                $user->userShoppingAddPrepare($_GET);
                break;
            case 'userShoppingRecordEdit':
                $user->userShoppingRecordEditPrepare($_GET);
                break;
            default:
                $user->viewLogin();
        }
        break;
}
