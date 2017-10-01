<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/path.lib.php';

$path = new path();

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
	case 'POST':
		// set the current action
		$_action = isset($_POST['action']) ? $_POST['action'] : '';
		switch($_action) {
			case 'addChoosePath':
				$path->addChoosePath($_POST);
				break;
			case 'updateChoosePath':
				$path->updateChoosePath($_POST);
				break;
			case 'addPath':
				$path->addPath($_POST);
				break;
			case 'updatePath':
				$path->updatePath($_POST);
				break;
			default:
				break;
		}
		break;
	case 'GET':
		// set the current action
		$_action = isset($_GET['action']) ? $_GET['action'] : 'view';
		//echo $_action;
		switch($_action) {
			case 'addChoosePathForm':
				// show add new journal form
				$path->addChoosePathPrepare();
				break;
			case 'editChoosePathForm':
				$path->updateChoosePathPrepare($_GET);
				break;
			case 'listChoosePath':
				$path->listChoosePath();
				break;
			case 'deleteChoosePath':
				$path->deleteChoosePath($_GET);
				break;
			case 'addPathForm':
				// show add new journal form
				$path->addPathPrepare();
				break;
			case 'editPathForm':
				$path->updatePathPrepare($_GET);
				break;
			case 'listPath':
				$path->listPath();
				break;
			case 'deletePath':
				$path->deletePath($_GET);
				break;
			case 'editPathUsed':
				$path->editPathUsed($_GET);
				break;
			default:
				break;

		}
	break;
}

?>
