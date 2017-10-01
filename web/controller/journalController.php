<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/journal.lib.php';

$journal = new journal();

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
	case 'POST':
		// set the current action
		$_action = isset($_POST['action']) ? $_POST['action'] : '';
		switch($_action) {
			case 'addJournal':
				$journal->addJournal($_POST);
				break;
			case 'updateJournal':
				$journal->updateJournal($_POST);
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
			case 'addJournalForm':
				// show add new journal form
				$journal->addJournalPrepare();
				break;
			case 'editJournalForm':
				$journal->updateJournalPrepare($_GET);
				break;
			case 'listJournal':
				$journal->listJournal();
				break;
			case 'delectPath':
				$journal->delectPath($_GET);
				break;
			case 'editPathUsed':
				$journal->editPathUsed($_GET);
				break;
			default:
				break;

		}
	break;
}

?>
