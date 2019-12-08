<?php
/**
 * Controller for form routes
 *
 * @author Jason Engelbrecht
 * Date: 11/18/2019
 */
global $f3;
global $db;

//must have a get variable named type to work
$f3->route('GET /description', function($f3)
{
    $f3->set('page_title', 'Training Description');
    $trainingRoute = $_GET['type'];
    $_SESSION['trainingRoute'] = $trainingRoute;

    $view = new Template();
    echo $view->render("views/forms/specific_form_pages/$trainingRoute/trainingDescription.html");
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
        $specialNeedsText = $_POST['specialNeedsText'];
        $serviceAnimal = $_POST['serviceAnimal'];
        $serviceAnimalText = $_POST['serviceAnimalText'];
        $movementDisability = $_POST['movementDisability'];
        $movementDisabilityText = $_POST['movementDisabilityText'];
        $needAccommodations = $_POST['needAccommodations'];
        $needRoom = $_POST['needRoom'];
        $daysRooming = $_POST['daysRooming'];
        $roommate = $_POST['roommate'];
        $gender = $_POST['gender'];
        $roommateGender = $_POST['roommateGender'];
        $cpap = $_POST['cpap'];
        $cpapRoommate = $_POST['cpapRoommate'];
        $singleRoom = $_POST['singleRoom'];

        if(!isset($daysRooming))
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

        if($specialNeeds == 'false')
        {
            $specialNeedsText = 'No special needs';
        }

        if($serviceAnimal == 'false')
        {
            $serviceAnimalText = 'No service animal';
        }

        if($movementDisability == 'false')
        {
            $movementDisabilityText = 'No movement disability';
        }

        // add data to hive
        $f3->set('specialNeeds', $specialNeeds);
        $f3->set('specialNeedsText', $specialNeedsText);
        $f3->set('serviceAnimal', $serviceAnimal);
        $f3->set('serviceAnimalText', $serviceAnimalText);
        $f3->set('movementDisability', $movementDisability);
        $f3->set('movementDisabilityText', $movementDisabilityText);
        $f3->set('needAccommodations', $needAccommodations);
        $f3->set('needRoom', $needRoom);
        $f3->set('daysRooming', $daysRooming);
        $f3->set('roommate', $roommate);
        $f3->set('gender', $gender);
        $f3->set('roommateGender', $roommateGender);
        $f3->set('cpap', $cpap);
        $f3->set('cpapRoommate', $cpapRoommate);
        $f3->set('singleRoom', $singleRoom);

        $_SESSION['AdditionalInfo'] = new AdditionalInfo($specialNeeds, $specialNeedsText, $serviceAnimal,
            $serviceAnimalText, $movementDisability, $movementDisabilityText, $needAccommodations, $needRoom,
            $daysRooming, $roommate, $gender, $roommateGender, $cpap, $cpapRoommate, $singleRoom);

        /*
        if($_POST['goBack'] = 'goBack')
        {
            $f3->reroute('/personal_information');
        }
        */

        // validate data
        if(validAccommodationsForm())
        {
            if($_POST['goToReview'] == true)
            {
                $f3->reroute('/review');
            }

            $f3->reroute('/long_answer');
        }
    }

    if(!isset($_SESSION['AdditionalInfo']))
    {
        $dummyArray = array('N/A');
        $_SESSION['AdditionalInfo'] = new AdditionalInfo('', '', '',
            '', '', '', '','',
            $dummyArray, '', '', '', '', '', '');
    }

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/form2.html');
});

$f3->route('GET|POST /long_answer', function($f3)
{
    $f3->set('page_title', 'Long Answer');
    $trainingRoute = $_SESSION['trainingRoute'];

    if($_SESSION['applicationStarted'] != 1)
    {
        $f3->reroute('/');
    }

    require_once "controllers/longAnswerControllers/$trainingRoute/longAnswerController.php";

    $view = new Template();
    echo $view->render("views/forms/specific_form_pages/$trainingRoute/longAnswer.html");
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

    if($_SESSION['applicationStarted'] != 1)
    {
        $f3->reroute('/');
    }

    $f3->set('page_title', 'Review');

    $trainingRoute = $_SESSION['trainingRoute'];
    $f3->set('reviewIncludes', "views/forms/specific_form_pages/$trainingRoute/reviewIncludes.html");
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

    if(!empty($_POST))
    {
        $f3->reroute('/confirmation');
    }

    $trainingRoute = $_SESSION['trainingRoute'];
    $view = new Template();
    echo $view->render("views/forms/specific_form_pages/$trainingRoute/performanceAgreement.html");
});

$f3->route('GET|POST /confirmation', function($f3)
{
    if($_SESSION['applicationStarted'] != 1) {
        $f3->reroute('/');
    }

    global $db;
    $lastId = $db->addApplicant($_SESSION['PersonalInfo'], $_SESSION['AdditionalInfo'],
        $_SESSION['NotRequired'], $_SESSION['info_id']);

    switch ($_SESSION['trainingRoute'])
    {
        case 'familySupportGroup':
            $db->insertFSGAnswers($lastId, $_SESSION['LongAnswer']);
            break;
        case 'peer2peer':
            $db->insertP2PAnswers($lastId, $_SESSION['LongAnswer']);
            break;
        case 'endingTheSilence':
            $db->insertETSAnswers($lastId, $_SESSION['LongAnswer']);
            break;
    }

    Emailer::sendAffiliateEmail($lastId, $_SESSION['PersonalInfo']->getFname(), $_SESSION['PersonalInfo']->getLname(),
        $_SESSION['PersonalInfo']->getAffiliate(), $db);
    Emailer::sendConfirmationEmail($_SESSION['PersonalInfo']);

    $f3->set('page_title', 'Application Submitted');

    $view = new Template();
    echo $view->render('views/forms/general_form_pages/confirmation.html');
});
