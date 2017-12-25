<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/store.lib.php';

$store = new Store();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'storeAdd':
                $store->storeAdd($_POST);
                break;
            case 'storeEdit':
                $store->storeEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'storeAddPrepare':
                $store->storeAddPrepare($_GET);
                break;
            case 'storeList':
                $store->storeList($_GET);
                break;
            case 'storeEditPrepare':
                $store->storeEditPrepare($_GET);
                break;
            case 'storeDelete':
                $store->storeDelete($_GET);
                break;
            default:
                $store->viewLogin();
                break;
        }
        break;
}
