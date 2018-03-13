<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/scroll.lib.php';

$scroll = new Scroll();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'scrollAdd':
                $scroll->scrollAdd($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'scrollAddPrepare':
                $scroll->scrollAddPrepare($_GET);
                break;
            case 'scrollList':
                $scroll->scrollList($_GET);
                break;
            case 'scrollDelete':
                $scroll->scrollDelete($_GET);
                break;
            default:
                $scroll->viewLogin();
        }
        break;
}
