<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/beacon.lib.php';

$beacon = new Beacon();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addBeacon':
                $beacon->addBeacon($_POST);
                break;
            case 'updateBeacon':
                $beacon->updateBeacon($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $beacon->viewAddForm();
                break;
            case 'viewEditForm':
                $beacon->viewEditForm($_GET);
                break;
            case 'viewBeaconList':
                $beacon->viewBeaconList();
                break;
            case 'deleteBeacon':
                $beacon->deleteBeacon($_GET);
                break;
            case 'logout':
                $beacon->logout();
                break;
            case 'view':
            default:
                $beacon->viewLogin();
        }
        break;
}
