<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/frame.lib.php';
require_once HOME_DIR . 'model/combine.lib.php';

$combine = new Combine();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'combineAdd':
                $combine->combineAdd($_POST);
                break;
            case 'combineEdit':
                $combine->combineEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'combineAddPrepare':
                $combine->combineAddPrepare($_GET);
                break;
            case 'combineList':
                $combine->combineList($_GET);
                break;
            case 'combineEditPrepare':
                $combine->combineEditPrepare($_GET);
                break;
            case 'combineDelete':
                $combine->combineDelete($_GET);
                break;
            case 'combineImageDelete':
                $combine->combineImageDelete($_GET);
                break;
            case 'combineFrameDelete':
                $combine->combineFrameDelete($_GET);
            default:
                $combine->viewLogin();
                break;
        }
        break;
}
