<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/project.lib.php';

$project = new Project();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'addProject':
                if ($project->isValidAddForm($_POST)) {
                    $project->addProject($_POST);
                } else {
                    $project->viewAddForm();
                }
                break;
            case 'updateProject':
                $project->updateProject($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewAddForm':
                $project->viewAddForm();
                break;
            case 'viewEditForm':
                $project->viewEditForm($_GET);
                break;
            case 'viewProjectList':
                $project->viewProjectList();
                break;
            case 'viewProjectDetail':
                $project->viewProjectDetail($_GET);
                break;
            case 'deleteProject':
                $project->deleteProject($_GET);
                break;
        }
        break;
}
