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
            case 'brandEditPrepare':
                $brand0->brandEditPrepare($_POST);
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
                $brand->brandAddPrepare();
                break;
            case 'brandList':
                $brand->brandList();
                break;
            default:
                $sbrand->viewLogin();
        }
        break;
}
