<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/zone.lib.php';

$zone = new Zone();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addZone':
                if ($zone->isValidAddForm($_POST)) {
                    $zone->addZone($_POST);
                } else {
                    $zone->viewAddForm($_POST);
                }
                break;
            case 'updateZone':
                $zone->updateZone($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $zone->viewAddForm($_GET);
                break;
            case 'viewEditForm':
                $zone->viewEditForm($_GET);
                break;
            case 'viewZoneDetail':
                $zone->viewZoneDetail($_GET);
                break;
            case 'deleteZone':
                $zone->deleteZone($_GET);
                break;
        }
        break;
}
