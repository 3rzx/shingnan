<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/brand.lib.php';

$brand = new Brand();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'brandAdd':
                $brand->brandAdd($_POST);
                break;
            case 'brandEdit':
                $brand->brandEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'brandAddPrepare':
                $brand->brandAddPrepare($_GET);
                break;
            case 'brandEditPrepare':
                $brand->brandEditPrepare($_GET);
                break;
            case 'brandList':
                $brand->brandList($_GET);
                break;
            case 'brandDelete':
                $brand->brandDelete($_GET);
                break;
            case 'brandImageDelete':
                $brand->brandImageDelete($_GET);
                break;
            default:
                $brand->viewLogin();
        }
        break;
}
