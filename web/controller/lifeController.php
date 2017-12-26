<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/life.lib.php';

$life = new Life();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'lifeAdd':
                $life->lifeAdd($_POST);
                break;
            case 'lifeEdit':
                $life->lifeEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'lifeAddPrepare':
                $life->lifeAddPrepare($_GET);
                break;
            case 'lifeList':
                $life->lifeList($_GET);
                break;
            case 'lifeEditPrepare':
                $life->lifeEditPrepare($_GET);
                break;
            case 'lifeDelete':
                $life->lifeDelete($_GET);
                break;
            default:
                $life->viewLogin();
                break;
        }
        break;
}
