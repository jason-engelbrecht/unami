<?php
/**
 * Controller for portal routes
 *
 * @author Jason Engelbrecht
 * Date: 11/18/2019
 */
global $f3;
global $db;

//login
$f3->route('GET|POST /login', function($f3)
{
    $f3->set('page_title', 'Login');
    global $db;

    //for logout/just in case
    $_SESSION['loggedIn'] = 0;

    if(!empty($_POST)) {

        //get email and password
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        //get user password with email
        $adminUser = $db->getAdminPassword($email);

        //sticky email
        $_SESSION['adminEmail'] = $email;

        //verify correct password entered
        if(password_verify($password, $adminUser['password'])) {

            //set logged in to 1 - and set name
            $_SESSION['loggedIn'] = 1;
            $_SESSION['adminFname'] = $adminUser['fname'];
            $_SESSION['adminLname'] = $adminUser['lname'];

            //get rid of
            unset($_SESSION['adminEmail']);

            //go to dashboard
            $f3->reroute('/dashboard');
        }
        else {
            $f3->set('loginError', 'Email and password do not match');
        }
    }

    $view = new Template();
    echo $view->render('views/portal/account/login.html');
});

//forgot password
$f3->route('GET /forgot-password', function($f3)
{
    $f3->set('page_title', 'Forgot Password');

    $view = new Template();
    echo $view->render('views/portal/account/forgot-password.html');
});

//create account
$f3->route('GET|POST /create-account', function($f3)
{
    $f3->set('page_title', 'Create Account');
    global $db;

    /*if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }*/

    //form submission
    if(!empty($_POST)) {
        //get post data
        $fname = $_POST['adminFname'];
        $lname = $_POST['adminLname'];
        $email = $_POST['adminEmail'];
        $password = $_POST['adminPassword'];
        $passwordRepeat = $_POST['adminPasswordRepeat'];

        $f3->set('adminFname', $fname);
        $f3->set('adminLname', $lname);
        $f3->set('adminEmail', $email);

        //validate
        if(validAccount($fname, $lname, $email, $password, $passwordRepeat))
        {
            //prefill email for login
            $_SESSION['adminEmail'] = $email;

            //insert into db - go to login
            $db->insertAdminUser($fname, $lname, $email, $password);
            $f3->reroute('/login');
        }
    }

    $view = new Template();
    echo $view->render('views/portal/account/register.html');
});

//dashboard
$f3->route('GET /dashboard', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    //get metrics
    global $db;
    $active = 1;

    $numActive = $db->countApplicants($active);
    $numComplete = $db->countComplete();
    $numApproved = $db->countApproved();
    $numDenied = $db->countDenied();
    $numWaitlisted = $db->countApplicants(2);
    $numArchived = $db->countApplicants(0);

    $f3->set('numActive', $numActive);
    $f3->set('numComplete', $numComplete);
    $f3->set('numApproved', $numApproved);
    $f3->set('numDenied', $numDenied);
    $f3->set('numWaitlisted', $numWaitlisted);
    $f3->set('numArchived', $numArchived);

    $f3->set('page', 'dashboard');
    $f3->set('page_title', 'Dashboard');

    $view = new Template();
    echo $view->render('views/portal/dashboard.html');
});

//active
$f3->route('GET|POST /active', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    global $db;
    $f3->set('page', 'active');
    $f3->set('page_title', 'Active Applicants');

    //get all active applicants
    $active = 1;
    $f3->set('ActiveApplicants', $db->getApplicants($active));

    //get various metrics
    $f3->set('active', $db->countApplicants($active));
    $f3->set('submitted', $db->countSubmitted());
    $f3->set('approved', $db->countApproved());
    $f3->set('denied', $db->countDenied());
    $f3->set('complete', $db->countComplete());

    //update submission
    if(isset($_POST['update'])) {

        $id = $_POST['id'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $notes = $_POST['notes'];

        //run update query
        $db->updateApplicant($id, $category, $status, $notes);
        $f3->reroute('/active');
    }

    $view = new Template();
    echo $view->render('views/portal/applications/active.html');
});

//waitlist
$f3->route('GET|POST /waitlist', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    //get all waitlisted applicants
    global $db;
    $waitilist = 2;
    $f3->set('WaitlistedApplicants', $db->getApplicants($waitilist));
    $f3->set('numWaitlist', $db->countApplicants($waitilist));

    $f3->set('page', 'waitlist');
    $f3->set('page_title', 'Waitlisted Applicants');

    //update submission
    if(isset($_POST['updateWaitlist'])) {

        $id = $_POST['id'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $notes = $_POST['notes'];

        //run update query
        $db->updateApplicant($id, $category, $status, $notes);
        $f3->reroute('/waitlist');
    }

    $view = new Template();
    echo $view->render('views/portal/applications/waitlist.html');
});

//archive
$f3->route('GET|POST /archive', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    //get all archived applicants
    global $db;
    $archive = 0;
    $f3->set('ArchivedApplicants', $db->getApplicants($archive));
    $f3->set('numArchive', $db->countApplicants($archive));

    $f3->set('page', 'archive');
    $f3->set('page_title', 'Archived Applicants');

    //update submission
    if(isset($_POST['updateArchive'])) {

        $id = $_POST['id'];
        $category = $_POST['category'];
        $status = $_POST['status'];
        $notes = $_POST['notes'];

        //run update query
        $db->updateApplicant($id, $category, $status, $notes);
        $f3->reroute('/archive');
    }

    $view = new Template();
    echo $view->render('views/portal/applications/archive.html');
});

//affiliates
$f3->route('GET /affiliates', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    $f3->set('page', 'affiliates');
    $f3->set('page_title', 'Affiliates');

    //get all affiliates
    global $db;
    $f3->set('Affiliates', $db->getAffiliates());
    $f3->set('NumAffiliates', $db->countAffiliates());

    $view = new Template();
    echo $view->render('views/portal/other/affiliates.html');
});

//trainings
$f3->route('GET /trainings', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    $f3->set('page', 'trainings');
    $f3->set('page_title', 'Trainings');

    $view = new Template();
    echo $view->render('views/portal/other/trainings.html');
});

//full application
$f3->route('GET /@applicant', function($f3, $params)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    $f3->set('page_title', 'Applicant');

    global $db;

    $applicant_id = $params['applicant']; //must match^
    $applicant = $db->getApplicant($applicant_id);

    if($applicant['category'] == 1) {
        $f3->set('page', 'active');
    }
    else if($applicant['category'] == 0) {
        $f3->set('page', 'archive');
    }
    else if($applicant['category'] == 2) {
        $f3->set('page', 'waitlist');
    }

    $f3->set('applicant', $applicant);

    $view = new Template();
    echo $view->render('views/portal/applications/applicant.html');
});