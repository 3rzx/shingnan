<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/news.lib.php';

$news = new News();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'newsAdd':
                $news->newsAdd($_POST);
                break;
            case 'newsEdit':
                $news->newsEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'newsAddPrepare':
                $news->newsAddPrepare($_GET);
                break;
            case 'newsList':
                $news->newsList($_GET);
                break;
            case 'newsEditPrepare':
                $news->newsEditPrepare($_GET);
                break;
            case 'newsDelete':
                $news->newsDelete($_GET);
                break;
            case 'newsImageDelete':
                $news->newsImageDelete($_GET);
                break;
            default:
                $news->viewLogin();
                break;
        }
        break;
}
