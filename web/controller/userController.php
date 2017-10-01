<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/user.lib.php';

$user = new User();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'login':
                if ($user->isValidInput($_POST)) {
                    $user->login($_POST);
                } else {
                    $user->viewLogin();
                }
                break;
            case 'addUser':
                $user->addUser($_POST);
                break;
            case 'updateUser':
                $user->updateUser($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $user->viewAddForm();
                break;
            case 'viewEditForm':
                $user->viewEditForm($_GET);
                break;
            case 'viewUserList':
                $user->viewUserList();
                break;
            case 'deleteUser':
                $user->deleteUser($_GET);
                break;
            case 'logout':
                $user->logout();
                break;
            case 'main':
                $user->viewMain();
                break;
            case 'view':
            default:
                $user->viewLogin();
        }
        break;
}
