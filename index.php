<?php
/**
    David Haas
    4/29/20
    https://dhaas417.greenriverdev.com/328/dating/
    Pet dating website
*/

//Turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
//require_once ('model/validate.php');

session_start();
//var_dump($_SESSION);

//Create an instance of the Base class
$f3 = Base::instance();
$validator = new Validate();
$controller = new Controller($f3, $validator);

//echo "<p>Member Object</p>";
//var_dump($f3->get('membership'));

//Define a default route
$f3->route('GET /', function() {
    $GLOBALS['controller']->home();
});

//Define a personal info route
$f3->route('GET|POST /personal_info', function() {
    $GLOBALS['controller']->personal_info();
});

//Define a profile route
$f3->route('GET|POST /profile', function() {
    $GLOBALS['controller']->profile();
});

//Define an interests route
$f3->route('GET|POST /interests', function() {
    $GLOBALS['controller']->interests();
});

//Define a summary route
$f3->route('GET /summary', function() {
    $GLOBALS['controller']->summary();
});

//Run fat free
$f3->run();