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
    session_start();

    global $db;
    $f3->set('db', $db);


    $f3->set('page_title', 'Trainings');

    //get app types
    $app_types = $db->getAppTypes();
    $f3->set('app_types', $app_types);

    //get app types info
    $app_types_info = $db->getAppTypesInfo();
    $f3->set('app_types_info', $app_types_info);

    foreach ($app_types as $type)
    {
        $refName = $type['ref_name'];
        $postName = $refName.'Submit';
        $infoName = $refName.'Info';
        if(isset($_POST["$postName"]))
        {
            //get training date and location(info)
            $info_id = $_POST["$infoName"];
            $_SESSION['training_info'] = $db->getAppTypeInfo($info_id);
            $_SESSION['info_id'] = $info_id;

            //get training_type
            $_SESSION['training_type'] = $_POST['trainingType'];

            //go to right form
            $f3->reroute("/description?type=$refName");
        }
    }

    $view = new Template();
    echo $view->render('views/forms/home.html');
});

//add other controllers
require_once 'controllers/formsController.php';
require_once 'controllers/affiliateController.php';
require_once 'controllers/portalController.php';
require_once 'controllers/testController.php';

//run fat-free
$f3->run();
