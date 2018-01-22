<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/glass.lib.php';

$glass = new Glass();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'glassAdd':
                $glass->glassAdd($_POST);
                break;
            case 'glassEdit':
                $glass->glassEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            //glass
            case 'glassAddPrepare':
                $glass->glassAddPrepare($_GET);
                break;
            case 'glassList':
                $glass->glassList($_GET);
                break;
            case 'glassEditPrepare':
                $glass->glassEditPrepare($_GET);
                break;
            case 'glassDelete':
                $glass->glassDelete($_GET);
                break;
            default:
                $glass->viewLogin();
                break;
        }
        break;
}
