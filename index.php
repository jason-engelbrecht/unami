<?php
//require fatfree autoload file
require_once 'vendor/autoload.php';

//start session
session_start();

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//create an instance of the Base class
$f3 = Base::instance();

//establish connection to database
$db = new UnamiDatabase();

//validation
require_once 'model/validation.php';
//import data
require_once 'model/data.php';

//default route
$f3->route('GET|POST /', function($f3)
{
    $f3->set('page_title', 'Trainings');

    if(isset($_POST['fsgSubmit'])) {
        //get selection


        $f3->reroute('/fsg');
    }

    //get other submissions


    session_start();
    $view = new Template();
    echo $view->render('views/forms/general_form_pages/home.html');
});

//add other controllers
require_once 'controllers/formsController.php';
require_once 'controllers/affiliateController.php';
require_once 'controllers/portalController.php';
require_once 'controllers/testController.php';

//run fat-free
$f3->run();
