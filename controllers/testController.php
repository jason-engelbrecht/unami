<?php
/**
 * Controller for test routes
 *
 * @author Jason Engelbrecht
 * Date: 11/18/2019
 */
global $f3;
global $db;

//testing
$f3->route('GET /unit_testing', function() {
    $view = new Template();
    echo $view->render('model/unit_testing/validationTesting.php');
});