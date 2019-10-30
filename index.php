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
require_once ('model/validation.php');

//Create an instance of the Base class
$f3 = Base::instance();

//Establish connection to database

// Array of states
$f3->set('states', array('Alabama','Alaska','Arizona','Arkansas','California',
    'Colorado','Connecticut','Delaware','District of Columbia','Florida','Georgia',
    'Hawaii','Idaho','Illinois','Indiana','Iowa','Kansas','Kentucky','Louisiana',
    'Maine','Maryland','Massachusetts','Michigan','Minnesota','Mississippi','Missouri',
    'Montana','Nebraska','Nevada','New Hampshire','New Jersey','New Mexico','New York',
    'North Carolina','North Dakota','Ohio','Oklahoma','Oregon','Pennsylvania','Rhode Island',
    'South Carolina','South Dakota','Tennessee','Texas','Utah','Vermont','Virginia','Washington',
    'West Virginia','Wisconsin','Wyoming'));

// Array of NAMI Affiliates
$f3->set('affiliates', array('NAMI Chelan-Douglas', 'NAMI Clallam County', 'NAMI Eastside', 'NAMI Jefferson County',
    'NAMI Kitsap County', 'NAMI Lewis County', 'NAMI Pierce County', 'NAMI Seattle', 'NAMI Skagit',
    'NAMI Snohomish County', 'NAMI South King County', 'NAMI Southwest Washington', 'NAMI Spokane',
    'NAMI Thurston-Mason', 'NAMI Tri-Cities', 'NAMI Walla Walla', 'NAMI Washington Coast',
    'NAMI Whatcom', 'Yakima'));

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
        $dateOfBirth = $_POST['day'] . "/" . $_POST['month'] . "/" . $_POST['year'];
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
    $f3->set('page_title', 'Accommodations');

    if(!empty($_POST))
    {
        // get data from form
        $specialNeeds = $_POST['specialNeeds'];
        $serviceAnimal = $_POST['serviceAnimal'];
        $movementDisability = $_POST['movementDisability'];
        $noAccommodations = $_POST['noAccommodations'];
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

        if($noAccommodations == 'yes')
        {
            $singleRoom = 'N/A';
            $roommate = 'N/A';
            $gender = 'N/A';
            $roommateGender = 'N/A';
            $cpap = 'N/A';
            $cpapRoommate = 'N/A';
        }

        if($singleRoom == 'yes')
        {
            $roommate = 'N/A';
            $gender = 'N/A';
            $roommateGender = 'N/A';
            $cpap = 'N/A';
            $cpapRoommate = 'N/A';
        }

        // add data to hive
        $f3->set('specialNeeds', $specialNeeds);
        $f3->set('serviceAnimal', $serviceAnimal);
        $f3->set('movementDisability', $movementDisability);
        $f3->set('noAccommodations', $noAccommodations);
        $f3->set('needRoom', $needRoom);
        $f3->set('daysRooming', $daysRooming);
        $f3->set('roommate', $roommate);
        $f3->set('gender', $gender);
        $f3->set('roommateGender', $roommateGender);
        $f3->set('cpap', $cpap);
        $f3->set('cpapRoommate', $cpapRoommate);
        $f3->set('singleRoom', $singleRoom);

        $_SESSION['AdditionalInfo'] = new AdditionalInfo($specialNeeds, $serviceAnimal, $movementDisability,
            $noAccommodations, $needRoom, $daysRooming, $roommate, $gender, $roommateGender, $cpap, $cpapRoommate,
            $singleRoom);

        // validate data
        $valid = true;
        if($singleRoom == 'no')
        {
           if(!validAccommodationsForm())
           {
               $valid = false;
           }
        }
        if($valid)
        {
            $f3->reroute('/long_answer');
        }
    }

    if(!isset($_SESSION['AdditionalInfo']))
    {
        $dummyArray = array('1');
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
    $f3->set('page_title', 'Other Questions');

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
    $f3->set('page_title', 'Review');

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/review.html');
});

$f3->route('GET|POST /performance_agreement', function($f3) {
    $f3->set('page_title', 'Performance Agreement');

    if(!empty($_POST)) {
        $f3->reroute('/confirmation');
    }

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/performanceAgreement.html');
});

$f3->route('GET|POST /confirmation', function($f3)
{
    $f3->set('page_title', 'Application Submitted');

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/confirmation.html');
});

///////////////////////////////////////////portal///////////////////////////////////////////////////////////////////////

//login
$f3->route('GET /login', function($f3)
{
    $f3->set('page_title', 'Login');

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
$f3->route('GET /register', function($f3)
{
    $f3->set('page_title', 'Create Account');

    $view = new Template();
    echo $view->render('views/portal/account/register.html');
});

//dashboard
$f3->route('GET /dashboard', function($f3)
{
    $f3->set('page', 'dashboard');
    $f3->set('page_title', 'Dashboard');

    $view = new Template();
    echo $view->render('views/portal/dashboard.html');
});

//active
$f3->route('GET /active', function($f3)
{
    $f3->set('page', 'active');
    $f3->set('page_title', 'Active Applicants');

    $view = new Template();
    echo $view->render('views/portal/applications/active.html');
});

//waitlist
$f3->route('GET /waitlist', function($f3)
{
    $f3->set('page', 'waitlist');
    $f3->set('page_title', 'Waitlisted Applicants');

    $view = new Template();
    echo $view->render('views/portal/applications/waitlist.html');
});

//archive
$f3->route('GET /archive', function($f3)
{
    $f3->set('page', 'archive');
    $f3->set('page_title', 'Archived Applicants');

    $view = new Template();
    echo $view->render('views/portal/applications/archive.html');
});

//affiliates
$f3->route('GET /affiliates', function($f3)
{
    $f3->set('page', 'affiliates');
    $f3->set('page_title', 'Affiliates');

    $view = new Template();
    echo $view->render('views/portal/other/affiliates.html');
});

//trainings
$f3->route('GET /trainings', function($f3)
{
    $f3->set('page', 'trainings');
    $f3->set('page_title', 'Trainings');

    $view = new Template();
    echo $view->render('views/portal/other/trainings.html');
});

//Run fat-free
$f3->run();
