<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/tryOn.lib.php';

$tryOn = new TryOn();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'tryOnAdd':
                $tryOn->tryOnAdd($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'tryOnAddPrepare':
                $tryOn->tryOnAddPrepare($_GET);
                break;
            case 'tryOnList':
                $tryOn->tryOnList($_GET);
                break;
            case 'tryOnDelete':
                $tryOn->tryOnDelete($_GET);
                break;
            default:
                $tryOn->viewLogin();
        }
        break;
}
