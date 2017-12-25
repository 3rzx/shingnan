<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/part.lib.php';

$part = new Part();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'partAdd':
                $part->partAdd($_POST);
                break;
            case 'partEdit':
                $part->partEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            //part
            case 'partAddPrepare':
                $part->partAddPrepare($_GET);
                break;
            case 'partList':
                $part->partList($_GET);
                break;
            case 'partEditPrepare':
                $part->partEditPrepare($_GET);
                break;
            case 'partDelete':
                $part->partDelete($_GET);
                break;
            default:
                $part->viewLogin();
                break;
        }
        break;
}
