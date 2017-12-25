<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/frame.lib.php';
require_once HOME_DIR . 'model/glass.lib.php';
require_once HOME_DIR . 'model/len.lib.php';
require_once HOME_DIR . 'model/part.lib.php';

$frame = new Frame();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'frameAdd':
                $frame->frameAdd($_POST);
                break;
            case 'frameEdit':
                $frame->frameEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'frameAddPrepare':
                $frame->frameAddPrepare($_GET);
                break;
            case 'frameList':
                $frame->frameList($_GET);
                break;
            case 'frameEditPrepare':
                $frame->frameEditPrepare($_GET);
                break;
            case 'frameDelete':
                $frame->frameDelete($_GET);
                break;
            case 'frameImageDelete':
                $frame->frameImageDelete($_GET);
                break;
            default:
                $frame->viewLogin();
                break;
        }
        break;
}
