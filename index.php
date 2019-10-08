<?php

//Require autoload file
require_once('vendor/autoload.php');

session_start();

/*
 * Name: Maxwell Lee and Jittima Goodrich
 * Date: 6/4/2019
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
    echo $view->render('views/home.html');
});

//Run fat-free
$f3->run();
