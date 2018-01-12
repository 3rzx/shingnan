<?php
//initialize
require_once '../configs/source.php';
require_once HOME_DIR . 'model/course.lib.php';

$course = new Course();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch ($action) {
            case 'courseAdd':
                $course->courseAdd($_POST);
                break;
            case 'courseEdit':
                $course->courseEdit($_POST);
                break;
        }
        break;
    case 'GET':
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'courseAddPrepare':
                $course->courseAddPrepare($_GET);
                break;
            case 'courseList':
                $course->courseList($_GET);
                break;
            case 'courseEditPrepare':
                $course->courseEditPrepare($_GET);
                break;
            case 'courseDelete':
                $course->courseDelete($_GET);
                break;
            case 'courseImageDelete':
                $course->courseImageDelete($_GET);
                break;
            default:
                $course->viewLogin();
                break;
        }
        break;
}
