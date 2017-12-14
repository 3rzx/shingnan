<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/len.lib.php';

$len = new Len();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'lenAdd':
                $len->lenAdd($_POST);
                break;
            case 'lenEdit':
                $len->lenEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'lenAddPrepare':
                $len->lenAddPrepare($_GET);
                break;
            case 'lenList':
                $len->lenList($_GET);
                break;
            case 'lenEditPrepare':
                $len->lenEditPrepare($_GET);
                break;
            case 'lenDelete':
                $len->lenDelete($_GET);
                break;
            default:
                $len->viewLogin();
                break;
        }
        break;
}
