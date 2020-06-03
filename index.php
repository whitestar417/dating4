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

session_start();
var_dump($_SESSION);

//Require the autoload file
require_once('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation-functions.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function () {

    $view = new Template();
    echo $view->render('views/home.html');
});

//Define a personal info route
$f3->route('GET|POST /personal_info', function($f3)
{
    //Check if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $_SESSION['gender'] = $_POST['gender'];

        if (validName($_POST['fName'], $_POST['lName']))
        {
            $_SESSION['fName'] = $_POST['fName'];
            $_SESSION['lName'] = $_POST['lName'];
        }
        else
        {
            //Data is invalid
            $f3->set("errors['name']", "Please enter a valid name.");
        }

        if (validAge($_POST['age']))
        {
            $_SESSION['age'] = $_POST['age'];
        }
        else
        {
            //Data is invalid
            $f3->set("errors['age']", "Please enter a valid age.");
        }

        if (validPhone($_POST['phone']))
        {
            $_SESSION['phone'] = $_POST['phone'];
        }
        else
        {
            //Data is invalid
            $f3->set("errors['phone']", "Please enter a valid phone number.");
        }

        if (empty($f3['errors'])) {

            //Redirect to the profile route
            $f3->reroute("profile");
        }
    }

    $f3->set('genders', getGenders());

    $view = new Template();
    echo $view->render('views/personal_info.html');
});

//Define a profile route
$f3->route('GET|POST /profile', function($f3)
{
    $states = getStates();

    //Check if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['seeking'] = $_POST['seeking'];
        $_SESSION['bio'] = $_POST['bio'];

        if (validEmail($_POST['email']))
        {
            //Data is valid
            $_SESSION['email'] = $_POST['email'];

            //Redirect to the interests route
            $f3->reroute("interests");
        }
        else
        {
            //Data is invalid
            $f3->set("errors['email']", "Please enter a valid email address.");
        }
    }

    $f3->set('genders', getGenders());
    $f3->set('states', $states);
    $view = new Template();
    echo $view->render('views/profile.html');
});

//Define an interests route
$f3->route('GET|POST /interests', function($f3)
{
    $indoors = getIndoorInterests();
    $outdoors = getOutdoorInterests();

    //Check if the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (validIndoor($_POST['indoors']))
        {
            $_SESSION['indoors'] = $_POST['indoors'];
        }
        else
        {
            //Data is invalid
            $f3->set("errors['indoors']", "Please do not spoof me.");
        }

        if (validOutdoor($_POST['outdoors']))
        {
            $_SESSION['outdoors'] = $_POST['outdoors'];
        }
        else
        {
            //Data is invalid
            $f3->set("errors['outdoors']", "Please do not spoof me.");
        }

        if (empty($f3['errors'])) {
            //Redirect to the profile route
            $f3->reroute("summary");
        }
    }

    $f3->set('indoors', $indoors);
    $f3->set('outdoors', $outdoors);

    $view = new Template();
    echo $view->render('views/interests.html');
});

//Define a summary route
$f3->route('GET /summary', function()
{
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run fat free
$f3->run();