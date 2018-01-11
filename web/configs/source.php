<?php
if (PHP_VERSION_ID <= 50300) {
    define('HOME_DIR', dirname(__FILE__) . '/../');
} else {
    define('HOME_DIR', __DIR__ . '/../');
}
//print_r(HOME_DIR);
define('APP_ROOT_DIR', dirname($_SERVER['PHP_SELF']) . '/../');
//print_r(APP_ROOT_DIR);
define('SMARTY_DIR', HOME_DIR . '../smarty/libs/');
//print_r(SMARTY_DIR);
error_reporting(0);
