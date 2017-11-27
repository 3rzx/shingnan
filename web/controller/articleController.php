<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/article.lib.php';

$article = new Article();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'educationAdd':
                $article->educationAdd($_POST);
                break;
            case 'articleEdit':
                $article->articleEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'educationAddPrepare':
                $article->educationAddPrepare($_GET);
                break;
            case 'newsAddPrepare':
                $article->newsAddPrepare($_GET);
                break;
            case 'lifeAddPrepare':
                $article->lifeAddPrepare($_GET);
                break;
            case 'educationList':
                $article->educationList($_GET);
                break;
            case 'articleEditPrepare':
                $article->articleEditPrepare($_GET);
                break;
            case 'articleDelete':
                $article->articleDelete($_GET);
                break;
            case 'articleImageDelete':
                $article->articleImageDelete($_GET);
                break;
            default:
                $article->viewLogin();
                break;
        }
        break;
}
