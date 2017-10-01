<?php
// initialize
require_once '../configs/source.php';
require_once(HOME_DIR . 'model/mode.lib.php');


$mode = new mode();

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
	case 'POST':
		// set the current action
		$_action = isset($_POST['action']) ? $_POST['action'] : '';
		switch($_action) {
			case 'addMode':
				$mode->addMode($_POST);
				break;
			case 'updateMode':
				$mode->updateMode($_POST);
				break;
			default:
				header('Location:../view/error.html');
				break;;
		}
		break;
	case 'GET':
		// set the current action
		$_action = isset($_GET['action']) ? $_GET['action'] : 'view';
		//echo $_action;
		switch($_action) {
			case 'addModeForm':
				// show add new device form
				$mode->addModePrepare($_GET);
				break;
			case 'editModeForm':
				$mode->updateModePrepare($_GET);
				break;
			case 'detailMode':
				$mode->detailMode($_GET);
				break;
			case 'deleteMode':
				$mode->deleteMode($_GET);
				break;
			default:
				header('Location:../view/error.html');
				break;
		}
	break;
}

?>
