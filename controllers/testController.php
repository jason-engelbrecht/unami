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

// test route for ETS training description
$f3->route('GET /test_ETStrainingDescription', function() {
    $view = new Template();

    echo $view->render('views/forms/specific_form_pages/ETS/ETStrainingDescription.html');
});

// test route for ETS performance agreement
$f3->route('GET /test_ETSperformanceAgreement', function() {
    $view = new Template();

    echo $view->render('views/forms/specific_form_pages/ETS/performanceAgreement.html');
});

// test route for P2P training description
$f3->route('GET /test_P2PtrainingDescription', function() {
    $view = new Template();

    echo $view->render('views/forms/specific_form_pages/P2P/P2PtrainingDescription.html');
});

// test route for P2P performance agreement
$f3->route('GET /test_P2PperformanceAgreement', function() {
    $view = new Template();

    echo $view->render('views/forms/specific_form_pages/P2P/performanceAgreement.html');
});

// test route for ETS long answer
$f3->route('GET /test_ETSlongAnswer', function() {
    $view = new Template();

    echo $view->render('views/forms/specific_form_pages/ETS/longAnswer.html');
});

// test route for P2P long answer
$f3->route('GET /test_P2PlongAnswer', function() {
    $view = new Template();

    echo $view->render('views/forms/specific_form_pages/P2P/longAnswer.html');
});