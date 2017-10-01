<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/template.lib.php';

$template = new Template();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addTemplate':
                $template->addTemplate($_POST);
                break;
            case 'editTemplate':
                $template->editTemplate($_POST);
                break;
            case 'addText':
                $template->addText($_POST);
                break;
            case 'editText':
                $template->editText($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $template->viewAddForm();
                break;
            case 'viewTemplateList':
                $template->viewTemplateList();
                break;
            case 'viewEditForm':
                $template->viewEditForm($_GET);
                break;
            case 'deleteTemplate':
                $template->deleteTemplate($_GET);
                break;
            case 'viewAddText':
                $template->viewAddText();
                break;
            case 'viewTextList':
                $template->viewTextList();
                break;
            case 'viewEditText':
                $template->viewEditText($_GET);
                break;
            case 'deleteText':
                $template->deleteText($_GET);
                break;
            case 'logout':
                $template->logout();
                break;
            case 'main':
                $template->viewMain();
                break;
            case 'view':
            default:
                $template->viewLogin();
        }
        break;
}
