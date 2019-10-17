<?php

//Require autoload file
require_once('vendor/autoload.php');

session_start();

/*
 * Name: Maxwell Lee
 * Date: 10/9/2019
 * File: index.php use for routing and store session data
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Get validation functions
//require_once ('model/validation.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Establish connection to database

//If the cart is not created yet, then initialize it
/*
if(!isset($_SESSION['user']))
{
    $_SESSION['user'] = new Guest();
}
*/

//define a default route
$f3->route('GET /', function()
{
    $view = new Template();
    echo $view->render('views/FSGtrainingDescription.html');
});

$f3->route('GET|POST /personal_information', function($f3)
{
    if(!empty($_POST))
    {
        // get data from form
        $first = $_POST['first'];
        $last = $_POST['last'];
        $pronouns = $_POST['pronouns'];
        $address = $_POST['inputAddress'];
        $address2 = $_POST['inputAddress2'];
        $city = $_POST['inputCity'];
        $state = $_POST['inputState'];
        $zip = $_POST['inputZip'];
        $primaryPhone = $_POST['primary'];
        $primaryTime = $_POST['primary_time'];
        $alternatePhone = $_POST['alternate'];
        $alternateTime = $_POST['alternate_time'];
        $email = $_POST['email'];
        $preference = $_POST['preference'];
        $emergency_name = $_POST['emergency_name'];
        $emergency_phone = $_POST['emergency_phone'];

        // add data to hive
        $f3->set('fname', $first);
        $f3->set('lname', $last);
        $f3->set('pronouns', $pronouns);
        $f3->set('address', $address);
        $f3->set('address2', $address2);
        $f3->set('city', $city);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('primary_phone', $primaryPhone);
        $f3->set('primary_time', $primaryTime);
        $f3->set('alternate_phone', $alternatePhone);
        $f3->set('alternate_time', $alternateTime);
        $f3->set('emergency_name', $emergency_name);
        $f3->set('emergency_phone', $emergency_phone);

        // validate data

        $_SESSION['PersonalInfo'] = new PersonalInfo($first, $last, $pronouns, $address, $address2, $city, $state, $zip,
            $primaryPhone, $primaryTime, $alternatePhone, $alternateTime, $email, $preference, $emergency_name,
            $emergency_phone);
        $f3->reroute('/additional_information');
    }

   $view = new Template();
   echo $view->render('views/form1.html');
});

$f3->route('GET|POST /additional_information', function($f3)
{
    if(!empty($_POST))
    {
        // get data from form

        // add data to hive

        // validate data

        $f3->reroute('/long_answer');
    }

    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3->route('GET|POST /long_answer', function($f3)
{
    if(!empty($_POST))
    {
        // get data from form

        // add data to hive

        // validate data

        $f3->reroute('/review');
    }

    $view = new Template();
    echo $view->render('views/longAnswer.html');
});

$f3->route('GET|POST /review', function()
{
    $view = new Template();
    echo $view->render('views/review.html');
});

$f3->route('GET|POST /performance_agreement', function() {
    $view = new Template();
    echo $view->render('views/performanceAgreement.html');
});

//test route
$f3->route('GET|POST /test', function()
{
    $view = new Template();
    echo $view->render('views/FSGtrainingDescription.html');
});

//Run fat-free
$f3->run();
