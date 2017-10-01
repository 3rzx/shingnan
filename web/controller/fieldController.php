<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/field.lib.php';

$field = new Field();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addField':
                if ($field->isValidAddForm($_POST)) {
                    $field->addField($_POST);
                } else {
                    $field->viewAddForm($_POST);
                }
                break;
            case 'updateField':
                $field->updateField($_POST);
                break;
            case 'addBeacon':
                $field->addBeacon($_POST);
                break;
            case 'updateBeacon':
                $field->updateBeacon($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $field->viewAddForm($_GET);
                break;
            case 'viewEditForm':
                $field->viewEditForm($_GET);
                break;
            case 'viewFieldDetail':
                $field->viewFieldDetail($_GET);
                break;
            case 'deleteField':
                $field->deleteField($_GET);
                break;
            case 'viewBeaconAddForm':
                $field->viewBeaconAddForm($_GET);
                break;
            case 'viewBeaconEditForm':
                $field->viewBeaconEditForm($_GET);
                break;
            case 'deleteBeacon':
                $field->deleteBeacon($_GET);
                break;
        }
        break;
}
