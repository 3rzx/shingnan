<?php
// initialize
require_once '../configs/source.php';
require_once(HOME_DIR . 'model/device.lib.php');


$device = new device();

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
	case 'POST':
		// set the current action
		$_action = isset($_POST['action']) ? $_POST['action'] : '';
		switch($_action) {
			case 'addDevice':
				$device->addDevice($_POST);
				break;
			case 'updateDevice':
				$device->updateDevice($_POST);
				break;
			default:
				header('Location:../view/error.html');
				break;
		}
		break;
	case 'GET':
		// set the current action
		$_action = isset($_GET['action']) ? $_GET['action'] : 'view';
		//echo $_action;
		switch($_action) {
			case 'addDeviceForm':
				// show add new device form
				$device->addDevicePrepare($_GET);
				break;
			case 'editDeviceForm':
				$device->updateDevicePrepare($_GET);
				break;
			case 'detailDevice':
				$device->detailDevice($_GET);
				break;
			case 'deleteDevice':
				$device->deleteDevice($_GET);
				break;
			default:
				header('Location:../view/error.html');
				break;
		}
	break;
}

?>
