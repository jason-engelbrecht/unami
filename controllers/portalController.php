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
$f3->route('GET|POST /forgot-password', function($f3)
{
    global $db;
    $f3->set('page_title', 'Forgot Password');

    if (!empty($_POST))
    {
        Emailer::sendResetEmail($_POST['email'], $db);
    }

    $view = new Template();
    echo $view->render('views/portal/account/forgot-password.html');
});

//reset password
$f3->route('GET|POST /reset-password/@adminId/@hashcode', function($f3, $params)
{
    $f3->set('page_title', 'Reset Password');

    global $db;
    $hashedId = str_replace('-', '/', $params['hashcode']);
    if(!password_verify($params['adminId'], $hashedId))
    {
        $f3->reroute('/login');
    }

    if (!empty($_POST))
    {
        $db->changeAdminPassword($params['adminId'], $_POST['password']);
        $f3->reroute('/login');
    }

    $view = new Template();
    echo $view->render('views/portal/account/reset-password.html');
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
$f3->route('GET|POST /dashboard', function($f3)
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
    $numSubmitted = $db->countSubmitted();
    $numTrainings = $db->countTrainings();
    $numDate = $db->countDate();
    $numApplicationByMonthYear = $db->countApplicationByMonthYear();
    $first = $db->getTheFirstSlacker();
    $second = $db->getTheSecondSlacker();
    $third = $db->getTheThirdSlacker();
    $fourth = $db->getTheFourthSlacker();
    $fifth = $db->getTheFifthSlacker();
    $firstPercentage = $db->getTheFirstPercentage();
    $secondPercentage = $db->getTheSecondPercentage();
    $thirdPercentage = $db->getTheThirdPercentage();
    $fourthPercentage = $db->getTheFourthPercentage();
    $fifthPercentage = $db->getTheFifthPercentage();

    $f3->set('numActive', $numActive);
    $f3->set('numComplete', $numComplete);
    $f3->set('numApproved', $numApproved);
    $f3->set('numDenied', $numDenied);
    $f3->set('numWaitlisted', $numWaitlisted);
    $f3->set('numArchived', $numArchived);
    $f3->set('numSubmitted', $numSubmitted);
    $f3->set('numTrainings', $numTrainings);
    $f3->set('numDate',$numDate);
    $f3->set('numApplicationByMonthYear',$numApplicationByMonthYear);
    $f3->set('first',$first);
    $f3->set('second',$second);
    $f3->set('third',$third);
    $f3->set('fourth',$fourth);
    $f3->set('fifth',$fifth);
    $f3->set('firstPercentage',$firstPercentage);
    $f3->set('secondPercentage',$secondPercentage);
    $f3->set('thirdPercentage',$thirdPercentage);
    $f3->set('fourthPercentage',$fourthPercentage);
    $f3->set('fifthPercentage',$fifthPercentage);

    $labelDataForGraph = array();
    $barDataForGraph = array();

    for($i = 0; $i < sizeof($numDate); $i++)
    {
        array_push($labelDataForGraph, $numDate[$i]['MonthYear']);
        array_push($barDataForGraph, $numApplicationByMonthYear[$i]['AppSubmit']);

    }

    $f3->set('labelDataForGraph', json_encode($labelDataForGraph));
    $f3->set('barDataForGraph', json_encode($barDataForGraph));

    $f3->set('page', 'dashboard');
    $f3->set('page_title', 'Dashboard');

    //set up excel export
    $app_types = $db->getAppTypes();
    $f3->set('app_types', $app_types);

    if(!empty($_POST))
    {
        Exporter::exportTrainingInfo($_POST['formType'], $db);
    }

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
    $f3->set('numDate', $db->countDate());
    $f3->set('numApp',$db->countApplicationByMonthYear());

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

    if(isset($_POST['resendEmail']))
    {
        $id = $_POST['id'];
        $db->updateApplicantStatus(1, $id);
        $personal = $db->getInfoForEmailResend($id);
        Emailer::sendAffiliateEmail($id, $personal['fname'], $personal['lname'], $personal['affiliate'], $db);
        $f3->set('emailSent', true);
        $f3->set('affiliateName', $db->getAffiliateName($personal['affiliate']));
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
$f3->route('GET|POST /trainings', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    $f3->set('page', 'trainings');
    $f3->set('page_title', 'Trainings');

    //get trainings
    global $db;
    $f3->set('db', $db);
    $f3->set('trainings', $db->getAppTypes());
    $f3->set('trainings_infos', $db->getAppTypesInfo());

    //add training
    if(isset($_POST['add'])) {
        //insert
        $date = $_POST['dates'];
        $date2 = $_POST['dates2'];
        $location = $_POST['location'];
        $deadline = $_POST['deadline'];
        $id = $_POST['addId'];
        $db->insertAppTypeInfo($id, $date, $date2, $location, $deadline);
        $f3->reroute('/trainings');
    }

    //delete training
    if(isset($_POST['delete'])) {
        $id = $_POST['deleteId'];
        $db->deleteAppTypeInfo($id);
        $f3->reroute('/trainings');
    }

    $view = new Template();
    echo $view->render('views/portal/other/trainings.html');
});

$f3->route('GET /oldTrainings', function($f3)
{
    if($_SESSION['loggedIn'] !== 1) {
        $f3->reroute('/login');
    }

    $f3->set('page', 'trainings');
    $f3->set('page_title', 'Old Trainings');

    //get all affiliates
    global $db;
    $f3->set('oldTrainings', $db->getOldAppTypesInfo());

    $view = new Template();
    echo $view->render('views/portal/other/oldTrainings.html');
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

    //get app type
    $app_type = $applicant['app_type'];

    //pull data based on app type and id
    $longAnswers = $db->getLongAnswer($applicant_id, $app_type);
    $routing = $applicant['Reference'];

    //set to hive
    $f3->set('longAnswers', $longAnswers);

    $f3->set('applicant', $applicant);
    $f3->set('reviewIncludes', "views/portal/applications/long_answers/$routing/long_answer.html");

    if($applicant['category'] == 1) {
        $f3->set('page', 'active');
    }
    else if($applicant['category'] == 0) {
        $f3->set('page', 'archive');
    }
    else if($applicant['category'] == 2) {
        $f3->set('page', 'waitlist');
    }

    $view = new Template();
    echo $view->render('views/portal/applications/applicant.html');
});