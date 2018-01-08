<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/point.lib.php';

$point = new Point();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'pointEdit':
                $point->pointEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'pointEditPrepare':
                $point->pointEditPrepare($_GET);
                break;
            default:
                $point->viewLogin();
        }
        break;
}
