<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/education.lib.php';

$education = new Education();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'educationAdd':
                $education->educationAdd($_POST);
                break;
            case 'educationEdit':
                $education->educationEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'educationAddPrepare':
                $education->educationAddPrepare($_GET);
                break;
            case 'educationList':
                $education->educationList($_GET);
                break;
            case 'educationEditPrepare':
                $education->educationEditPrepare($_GET);
                break;
            case 'educationDelete':
                $education->educationDelete($_GET);
                break;
            default:
                $education->viewLogin();
                break;
        }
        break;
}
