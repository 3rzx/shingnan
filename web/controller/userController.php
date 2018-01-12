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
            case 'userAdd':
                $user->userAdd($_POST);
                break;
            //TODO: to be add
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'userAddPrepare':
                $user->userAddPrepare();
                break;
        }
        break;
}
