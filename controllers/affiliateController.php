<?php
/**
 * Controller for affiliate routes
 *
 * @author Jason Engelbrecht
 * Date: 11/18/2019
 */
global $f3;
global $db;

$f3->route('GET|POST /affiliate_review/@applicantId/@hashcode', function($f3, $params)
{
    if(!password_verify($params['applicantId'], $params['hashcode']))
    {
        $f3->reroute('/home');
    }

    $f3->set('page_title', 'Application Approve/Deny');

    global $db;
    $applicant = $db->getApplicant($params['applicantId']);

    //if app is already approve/deny, no need to show it
    if($applicant['app_status'] != 1)
    {
        $f3->reroute('/application_reviewed');
    }

    $f3->set('applicant', $applicant);
    $f3->set('affiliate', $db->getAffiliateName($applicant['affiliate']));

    if(!empty($_POST))
    {
        $db->updateApplicantStatus($_POST['newStatus'], $params['applicantId']);
        $db->insertAffiliateNotes($params['applicantId'], $_POST['affiliateNotes']);

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
