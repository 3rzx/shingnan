<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/style.lib.php';

$style = new Style();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'styleAdd':
                $style->styleEdit($_POST);
                break;
            case 'styleEdit':
                $style->styleEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'styleAdd':
                $style->styleAdd();
                break;
            case 'styleList':
                $style->styleList();
                break;
            default:
                $style->viewLogin();
        }
        break;
}
