<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/frame.lib.php';
require_once HOME_DIR . 'model/glass.lib.php';
require_once HOME_DIR . 'model/len.lib.php';
require_once HOME_DIR . 'model/part.lib.php';

$frame = new Frame();
$grass = new Glass();
$len = new Len();
$part = new Part();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'AddFrame':
                $frame->frameAdd($_POST);
                break;
            case 'AddGlass':
                $glass->grassAdd($_POST);
                break;
            case 'AddLen':
                $len->lenAdd($_POST);
                break;
            case 'AddPart':
                $part->partAdd($_POST);
                break;
            case 'frameEdit':
                $frame->frameEdit($_POST);
                break;
            case 'glassEdit':
                $glass->glassEdit($_POST);
                break;
            case 'lenEdit':
                $len->lanEdit($_POST);
                break;
            case 'partEdit':
                $part->partEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            //frame
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
            //len
            case 'lenAddPrepare':
                $len->lenAddPrepare($_GET);
                break;
            case 'lenList':
                $len->lenList($_GET);
                break;
            case 'lenEditPrepare':
                $len->lenEditPrepare($_GET);
                break;
            case 'lenDelete':
                $len->lenDelete($_GET);
                break;
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
                $frame->viewLogin();
                break;
        }
        break;
}
