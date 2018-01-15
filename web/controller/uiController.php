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
                $ui->editIndexCover($_POST);
                break;
            case 'previewIndexCover':
                $ui->previewIndexCover($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewIndexCover':
                $ui->viewIndexCover();
                break;
            case 'imgDelete':
                $ui->imgDelete($_GET);
                break;
            default:
                $ui->viewLogin();
        }
        break;
}
