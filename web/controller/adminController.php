<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/admin.lib.php';

$admin = new Admin();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'login':
                if ($admin->isValidInput($_POST)) {
                    $admin->login($_POST);
                } else {
                    $admin->viewLogin();
                }
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'logout':
                $admin->logout();
                break;
            case 'main':
                $admin->viewMain();
                break;
            case 'view':
            default:
                $admin->viewLogin();
        }
        break;
}
