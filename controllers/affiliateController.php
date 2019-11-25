<?php
/**
 * Controller for affiliate routes
 *
 * @author Jason Engelbrecht & Max Lee
 * Date: 11/18/2019
 */
global $f3;
global $db;

$f3->route('GET|POST /affiliate_review/@applicantId/@hashcode', function($f3, $params)
{
    $hashedId = str_replace('-', '/', $params['hashcode']);
    if(!password_verify($params['applicantId'], $hashedId))
    {
        $f3->reroute('/home');
    }

    $f3->set('page_title', 'Application Approve/Deny');

    global $db;

    if(!empty($_POST))
    {
        $db->insertAffiliateNotes($params['applicantId'], $_POST['affiliateNotes'], $_POST['membershipExpiration']);

        if($_POST['saveNotes'] != 'save')
        {
            $db->updateApplicantStatus($_POST['newStatus'], $params['applicantId']);

            //reroute to thank you message
            $f3->reroute('/affiliate_confirmation');
        }
    }

    $applicant = $db->getApplicant($params['applicantId']);

    //if app is already approve/deny, no need to show it
    if($applicant['app_status'] != 1)
    {
        $f3->reroute('/application_reviewed');
    }

    //table names for reference
    $tables = array(
        1 => 'FSG',
        2 => 'P2P',
        3=> 'ETS');

    //get app id
    $app_id = $params['applicantId'];

    //get app type
    $app_type = $applicant['app_type'];
    $table = $tables[$app_type];

    //pull data based on app type and id
    $longAnswers = $db->getLongAnswer($app_id, $table);

    //set to hive
    $f3->set('longAnswers', $longAnswers);

    $f3->set('applicant', $applicant);
    $f3->set('affiliate', $db->getAffiliateName($applicant['affiliate']));

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
