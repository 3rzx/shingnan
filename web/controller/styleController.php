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
                $style->styleAdd($_POST);
                break;
            case 'styleEdit':
                $style->styleEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'styleAddPrepare':
                $style->styleAddPrepare($_GET);
                break;
            case 'styleList':
                $style->styleList($_GET);
                break;
            case 'styleEditPrepare':
                $style->styleEditPrepare($_GET);
                break;
            case 'styleDelete':
                $style->styleDelete($_GET);
                break;
            case 'styleImageDelete':
                $style->styleImageDelete($_GET);
                break;
            default:
                $style->viewLogin();
                break;
        }
        break;
}
