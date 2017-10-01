<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/vipDevice.lib.php';

$vipDevice = new Vip();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addVipDevice':
                $vipDevice->addVipDevice($_POST);
                break;
            case 'editVipDevice':
                $vipDevice->editVipDevice($_POST);
                break;
            case 'addVipVoice':
                $vipDevice->addVipVoice($_POST);
                break;
            case 'setVipDevice':
                $vipDevice->setVipDevice($_POST);
                break;
            case 'setVipVoice':
                $vipDevice->setVipVoice($_POST);
                break;

            default:
                header('Location:../view/error.html');
                break;
        }
        break;

    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewVIPAddForm':
                $vipDevice->viewVIPAddForm();
                break;
            case 'viewVIPEditForm':
                $vipDevice->viewVIPEditForm($_GET);
                break;
            case 'viewVIPVoiceAddForm':
                $vipDevice->viewVIPVoiceAddForm();
                break;
            case 'viewPiAddForm':
                $vipDevice->viewPiAddForm();
                break;
            case 'viewVIPList':
                $vipDevice->viewVIPList();
                break;
            case 'viewVIPVoiceList':
                $vipDevice->viewVIPVoiceList();
                break;
            case 'viewVIPPiList':
                $vipDevice->viewVIPPiList();
                break;
            case 'viewVIPSetForm':
                $vipDevice->viewVIPSetForm($_GET);
                break;
            case 'viewVIPVoiceEditForm':
                $vipDevice->viewVIPVoiceEditForm($_GET);
                break;
            case 'viewPiEditForm':
                $vipDevice->viewPiEditForm();
                break;
            case 'deleteVIPDevice':
                $vipDevice->deleteVIPDevice($_GET);
                break;
            case 'deleteVIPVoice':
                $vipDevice->deleteVIPVoice($_GET);
                break;
            case 'deletePiDevice':
                $vipDevice->deletePiDevice($_GET);
                break;
            case 'returnVIP':
                $vipDevice->returnVIP($_GET);
                break;
            default:
                header('Location:../view/error.html');
                break;
        }
        break;
}
