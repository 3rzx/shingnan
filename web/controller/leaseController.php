<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/lease.lib.php';

$lease = new Lease();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addPad':
                $lease->addPad($_POST);
                break;
            case 'addRent':
                $lease->addRent($_POST);
                break;
            case 'EditPad':
                $lease->EditPad($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $lease->viewAddForm();
                break;
            case 'viewLeaseList':
                $lease->viewLeaseList();
                break;
            case 'viewAddRent':
                $lease->viewAddRent();
                break;
            case 'viewEditPad':
                $lease->viewEditPad($_GET);
                break;
            case 'viewReturn':
                $lease->viewReturn();
                break;
            case 'deletePad':
                $lease->deletePad($_GET);
                break;
            case 'returnPad':
                $lease->returnPad($_GET);
                break;
            case 'logout':
                $lease->logout();
                break;
            case 'main':
                $lease->viewMain();
                break;
            case 'view':
            default:
                $lease->viewLogin();
        }
        break;
}
