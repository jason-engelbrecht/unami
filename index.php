<?php

//Require autoload file
require_once('vendor/autoload.php');


/*********swift-mailer*********/
if(isset($_POST['sendmail'])) {
    require_once 'vendor/autoload.php';
    require_once 'credential.php';

// Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
        ->setUsername(EMAIL)
        ->setPassword(PASS)
    ;

// Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

// Create a message
    $message = (new Swift_Message($_POST['subject']))
        ->setFrom([EMAIL => 'Thank you for your application'])
        ->setTo([$_POST['email']])
        ->setBody($_POST['message'])
    ;

// Send the message
   if($mailer->send($message))
    {
        echo "Mail Send";
    }
   else
   {
       echo "Failed to send";
   }
}
/*********swift-mailer*********/

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
require_once ('model/validation.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Establish connection to database
$db = new UnamiDatabase();

// Array of states
$f3->set('states', array('Alabama','Alaska','Arizona','Arkansas','California',
    'Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia',
    'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana',
    'Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri',
    'Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York',
    'North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island',
    'South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington',
    'West Virginia','Wisconsin','Wyoming'));

$f3->set('affiliates', $db->getAffiliates());

//define a default route
$f3->route('GET /', function($f3)
{
    $f3->set('page_title', 'Start');

    session_destroy();
    session_start();
    $view = new Template();
    echo $view->render('views/forms/specific_form_pages/FSG/FSGtrainingDescription.html');
});

$f3->route('GET|POST /personal_information', function($f3)
{
    $f3->set('page_title', 'Personal information');

    if(!empty($_POST))
    {

        // get data from form
        $first = $_POST['first'];
        $last = $_POST['last'];
        $pronouns = $_POST['pronouns'];
        $dateOfBirth = $_POST['month'] . "/" . $_POST['day'] . "/" . $_POST['year'];
        $address = $_POST['inputAddress'];
        $address2 = $_POST['inputAddress2'];
        $city = $_POST['inputCity'];
        $state = $_POST['inputState'];
        $zip = $_POST['inputZip'];
        $primaryPhone = $_POST['primary'];
        $primaryTime = $_POST['primary_time'];

        if(!empty($_POST['alternate'])) {
            $alternatePhone = $_POST['alternate'];
            $_SESSION['alternatePhone'] = 1;
        }
        else {
            $alternatePhone = " ";
            $_SESSION['alternatePhone'] = 0;
        }

        $alternateTime = $_POST['alternate_time'];
        $email = $_POST['email'];
        $preference = $_POST['preference'];
        $affiliate = $_POST['affiliate'];
        $member = $_POST['member'];
        $emergency_name = $_POST['emergency_name'];
        $emergency_phone = $_POST['emergency_phone'];

        // add data to hive
        $f3->set('fname', $first);
        $f3->set('lname', $last);
        $f3->set('pronouns', $pronouns);
        $f3->set('dateOfBirth', $dateOfBirth);
        $f3->set('member', $member);
        $f3->set('affiliate', $affiliate);
        $f3->set('address', $address);
        $f3->set('address2', $address2);
        $f3->set('city', $city);
        $f3->set('state', $state);
        $f3->set('zip', $zip);
        $f3->set('primary_phone', $primaryPhone);
        $f3->set('primary_time', $primaryTime);
        $f3->set('alternate_phone', $alternatePhone);
        $f3->set('alternate_time', $alternateTime);
        $f3->set('email', $email);
        $f3->set('preference', $preference);
        $f3->set('emergency_name', $emergency_name);
        $f3->set('emergency_phone', $emergency_phone);

        $_SESSION['PersonalInfo'] = new PersonalInfo($first, $last, $pronouns, $address, $address2, $city, $state, $zip,
            $primaryPhone, $primaryTime, $alternatePhone, $alternateTime, $email, $preference, $affiliate, $member,
            $emergency_name, $emergency_phone, $_POST['day'], $_POST['month'], $_POST['year']);

        $_SESSION['state'] = $_POST['inputState'];
        $_SESSION['affiliate'] = $_POST['affiliate'];

        // validate data
        if(validPersonalInfoForm())
        {
            $_SESSION['applicationStarted'] = 1;

            if($_POST['goToReview'] == true)
            {
                $f3->reroute('/review');
            }

            $f3->reroute('/additional_information');
        }
    }

    if(!isset($_SESSION['PersonalInfo']))
    {
        $_SESSION['PersonalInfo'] = new PersonalInfo('','','','','','',
            '', '', '', '', '', '', '', '',
            '', '', '', '', '', '', '');
    }

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/form1.html');
});

$f3->route('GET|POST /additional_information', function($f3)
{
    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    $f3->set('page_title', 'Accommodations');

    if(!empty($_POST))
    {
        // get data from form
        $specialNeeds = $_POST['specialNeeds'];
        $serviceAnimal = $_POST['serviceAnimal'];
        $movementDisability = $_POST['movementDisability'];
        $needAccommodations = $_POST['needAccommodations'];
        $needRoom = $_POST['needRoom'];
        $daysRooming = $_POST['daysRooming'];
        $roommate = $_POST['roommate'];
        $gender = $_POST['gender'];
        $roommateGender = $_POST['roommateGender'];
        $cpap = $_POST['cpap'];
        $cpapRoommate = $_POST['cpapRoommate'];
        $singleRoom = $_POST['singleRoom'];

        if(sizeof($daysRooming) == 0)
        {
            $daysRooming = array('N/A');
        }

        if($needAccommodations == 'false')
        {
            $singleRoom = 'false';
            $roommate = 'N/A';
            $gender = 'N/A';
            $roommateGender = 'N/A';
            $cpap = 'false';
            $cpapRoommate = 'false';
        }

        if($singleRoom == 'true')
        {
            $roommate = 'N/A';
            $gender = 'N/A';
            $roommateGender = 'N/A';
            $cpap = 'false';
            $cpapRoommate = 'false';
        }

        // add data to hive
        $f3->set('specialNeeds', $specialNeeds);
        $f3->set('serviceAnimal', $serviceAnimal);
        $f3->set('movementDisability', $movementDisability);
        $f3->set('needAccommodations', $needAccommodations);
        $f3->set('needRoom', $needRoom);
        $f3->set('daysRooming', $daysRooming);
        $f3->set('roommate', $roommate);
        $f3->set('gender', $gender);
        $f3->set('roommateGender', $roommateGender);
        $f3->set('cpap', $cpap);
        $f3->set('cpapRoommate', $cpapRoommate);
        $f3->set('singleRoom', $singleRoom);

        $_SESSION['AdditionalInfo'] = new AdditionalInfo($specialNeeds, $serviceAnimal, $movementDisability,
            $needAccommodations, $needRoom, $daysRooming, $roommate, $gender, $roommateGender, $cpap, $cpapRoommate,
            $singleRoom);

        /*
        if($_POST['goBack'] = 'goBack')
        {
            $f3->reroute('/personal_information');
        }
        */

        // validate data
        if(validAccommodationsForm())
        {
            $f3->reroute('/long_answer');
        }
    }

    if(!isset($_SESSION['AdditionalInfo']))
    {
        $dummyArray = array('N/A');
        $_SESSION['AdditionalInfo'] = new AdditionalInfo('','','',
            '','',$dummyArray, '', '', '',
            '', '', '');
    }

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/form2.html');
});

$f3->route('GET|POST /long_answer', function($f3)
{
    $f3->set('page_title', 'Long Answer');

    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    if(!empty($_POST))
    {
        // get data from form
        $relativeMentalIllness = $_POST['relativeMentalIllness'];
        $relativeMentalIllnessText = $_POST['relativeMentalIllnessText'];
        $convict = $_POST['convict'];
        $convictText = $_POST['convictText'];
        $whyFacilitator = $_POST['whyFacilitator'];
        $experience = $_POST['experience'];
        $coFacWhom = $_POST['coFacWhom'];
        $coFacWhomText = $_POST['coFacWhomText'];
        $coFacWhere = $_POST['coFacWhere'];
        $coFacWhereText = $_POST['coFacWhereText'];

        if($relativeMentalIllness == 'no')
        {
            $relativeMentalIllnessText = 'N/A';
        }

        if($convict == 'no')
        {
            $convictText = 'N/A';
        }

        if($coFacWhom == 'no')
        {
            $coFacWhomText = 'N/A';
        }

        if($coFacWhere == 'no')
        {
            $coFacWhereText = 'N/A';
        }

        // add data to hive
        $f3->set('relativeMentalIllness', $relativeMentalIllness);
        $f3->set('relativeMentalIllnessText', $relativeMentalIllnessText);
        $f3->set('convict', $convict);
        $f3->set('convictText', $convictText);
        $f3->set('whyFacilitator', $whyFacilitator);
        $f3->set('experience', $experience);
        $f3->set('coFacWhom', $coFacWhom);
        $f3->set('coFacWhomText', $coFacWhomText);
        $f3->set('coFacWhere', $coFacWhere);
        $f3->set('coFacWhereText', $coFacWhereText);

        $_SESSION['LongAnswer'] =  new LongAnswers($relativeMentalIllness, $relativeMentalIllnessText, $convict,
            $convictText, $whyFacilitator, $experience, $coFacWhom, $coFacWhomText, $coFacWhere, $coFacWhereText);

        /*
        if($_POST['goBack'] = 'goBack')
        {
            $f3->reroute('/additional_information');
        }
        */

        // validate data
        if(validLongAnswersForm())
        {
            $f3->reroute('/not_required');
        }
    }

    if(!isset($_SESSION['LongAnswer']))
    {
        $_SESSION['LongAnswer'] = new LongAnswers('','','','',
            '','', '', '', '', '');
    }

    $view = new Template();
    echo $view->render('views/forms/specific_form_pages/FSG/longAnswer.html');
});

$f3->route('GET|POST /not_required', function($f3)
{
    $f3->set('page_title', 'Additional Questions');

    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    if(!empty($_POST))
    {
        // get data from form
        $heardAboutTraining = $_POST['heardAboutTraining'];
        $trained = $_POST['trained'];
        $trainedText = $_POST['trainedText'];
        $certified = $_POST['certified'];
        $certifiedText = $_POST['certifiedText'];

        if($trained == 'no')
        {
            $trainedText = 'N/A';
        }

        if($certified == 'no')
        {
            $certifiedText = 'N/A';
        }

        // add data to hive
        $f3->set('heardAboutTraining', $heardAboutTraining);
        $f3->set('trained', $trained);
        $f3->set('trainedText', $trainedText);
        $f3->set('certified', $certified);
        $f3->set('certifiedText', $certifiedText);

        // validate data

        $_SESSION['NotRequired'] =  new NotRequired($heardAboutTraining, $trained, $trainedText, $certified,
            $certifiedText);

        /*
        if($_POST['goBack'] = 'goBack')
        {
            $f3->reroute('/long_answer');
        }
        */

        if(validNotRequiredForm())
        {
            $f3->reroute('/review');
        }
    }

    if(!isset($_SESSION['NotRequired']))
    {
        $_SESSION['NotRequired'] = new NotRequired('','','','',
            '');
    }

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/notRequiredQuestions.html');
});


$f3->route('GET|POST /review', function($f3)
{
    global $db;

    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    $f3->set('page_title', 'Review');
    $f3->set('affiliateName', $db->getAffiliateName($_SESSION['PersonalInfo']->getAffiliate()));

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/review.html');
});

$f3->route('GET|POST /performance_agreement', function($f3)
{
    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    $f3->set('page_title', 'Performance Agreement');

    if(!empty($_POST)) {
        $f3->reroute('/confirmation');
    }

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/performanceAgreement.html');
});

$f3->route('GET|POST /confirmation', function($f3)
{
    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    global $db;
    $lastId = $db->addApplicant($_SESSION['PersonalInfo'], $_SESSION['AdditionalInfo'],
        $_SESSION['NotRequired']);

    Emailer::sendAffiliateEmail($lastId, $_SESSION['PersonalInfo'], $db);
    Emailer::sendConfirmationEmail($_SESSION['PersonalInfo']);

    $f3->set('page_title', 'Application Submitted');

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/confirmation.html');
});

$f3->route('GET|POST /affiliate_review', function($f3)
{
    $f3->set('page_title', 'Application Approve/Deny');

    global $db;
    $applicant = $db->getApplicant($_GET['appId']);

    //if app is already approve/deny, no need to show it
    if($applicant['app_status'] != 1)
    {
        $f3->reroute('/application_reviewed');
    }

    $f3->set('applicant', $applicant);
    $f3->set('affiliate', $db->getAffiliateName($applicant['affiliate']));

    if(!empty($_POST))
    {
        $db->updateApplicantStatus($_POST['newStatus'], $_GET['appId']);
        $db->insertAffiliateNotes($_GET['appId'], $_POST['affiliateNotes']);

        //need to make a thank you page
        $f3->reroute('/affiliate_confirmation');
    }

    $view = new Template();
    echo $view->render('views/affiliate/affiliateReview.html');
});

$f3->route('GET|POST /affiliate_confirmation', function($f3)
{
    $f3->set('page_title', 'Thank you!');

    $view = new Template();
    echo $view->render('views/affiliate/thankyouConfirmation.html');
});

$f3->route('GET /application_reviewed', function($f3)
{
    $f3->set('page_title', 'Already reviewed');

    $view = new Template();
    echo $view->render('views/affiliate/alreadyReviewed.html');
});

///////////////////////////////////////////portal///////////////////////////////////////////////////////////////////////
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
$f3->route('GET|POST /register', function($f3)
{
    $f3->set('page_title', 'Create Account');
    global $db;

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

    $f3->set('numActive', $numActive);
    $f3->set('numComplete', $numComplete);
    $f3->set('numApproved', $numApproved);
    $f3->set('numDenied', $numDenied);

    $f3->set('page', 'dashboard');
    $f3->set('page_title', 'Dashboard');

    $view = new Template();
    echo $view->render('views/portal/dashboard.html');
});

$f3->set('applicationCategories',
    array(
        0 =>'Archive',
        1 => 'Active',
        2 => 'Waitlist'
    )
);

$f3->set('applicationStatuses',
    array(
        0 => 'Denied',
        1 => 'Submitted',
        2 => 'Approved',
        3 => 'Complete'
    )
);

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


        //run update query
        $db->updateApplicant($id, $category, $status);
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

        //run update query
        $db->updateApplicant($id, $category, $status);
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

        //run update query
        $db->updateApplicant($id, $category, $status);
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

//Run fat-free
$f3->run();
