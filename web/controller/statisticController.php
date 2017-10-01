<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/statistic.lib.php';

$statistic = new statistic();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch($action){
            case 'viewSurveyResultDate':
                $statistic->viewSurveyResultDate($_POST);
                break;
            case 'viewLikeCountDate':
                $statistic->viewLikeCountDate($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : 'view';
        switch ($action) {
            case 'viewSurveyResult':
                $statistic->viewSurveyResult();
                break;
            case 'viewLikeCount':
                $statistic->viewLikeCount();
                break;
            case 'viewHipster':
                $statistic->viewHipster();
                break;
        }
        break;
}
