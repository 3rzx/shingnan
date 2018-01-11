<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/ui.lib.php';

$ui = new Ui();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'editIndexCover':
                $ui->editIndexCover();
                break;
            case 'previewIndex':
                $ui->previewIndex();
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewIndexCover':
                $ui->viewIndexCover();
                break;
            default:
                $ui->viewLogin();
        }
        break;
}
