<?php
global $f3;

if(!empty($_POST))
{
    var_dump($_POST);
    // get data from form
    $convict = $_POST['convict'];
    $convictText = $_POST['convictText'];
    $availability = $_POST['availability'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $languages = $_POST['languages'];
    $youngAdult = $_POST['ageRange'];
    $diagnosis = $_POST['diagnosis'];
    $selfDisclosure = $_POST['selfDisclosure'];
    $positiveOutlook = $_POST['outlook'];
    $backgroundCheck = $_POST['background'];
    $whyPresenter = $_POST['whyPresenter'];
    $personalExperience = $_POST['personalExperience'];
    $supportiveExperience = $_POST['supportiveExperience'];
    $recoveryMeaning = $_POST['recoveryMeaning'];
    $roles = $_POST['roles'];

    if($convict == 'no')
    {
        $convictText = 'N/A';
    }

    // add data to hive
    $f3->set('convict', $convict);
    $f3->set('convictText', $convictText);
    $f3->set('availability', $availability);
    $f3->set('education', $education);
    $f3->set('experience', $experience);
    $f3->set('languages', $languages);
    $f3->set('youngAdult', $youngAdult);
    $f3->set('diagnosis', $diagnosis);
    $f3->set('selfDisclosure', $selfDisclosure);
    $f3->set('positiveOutlook', $positiveOutlook);
    $f3->set('backgroundCheck', $backgroundCheck);
    $f3->set('whyPresenter', $whyPresenter);
    $f3->set('personalExperience', $personalExperience);
    $f3->set('supportiveExperience', $supportiveExperience);
    $f3->set('recoveryMeaning', $recoveryMeaning);
    $f3->set('roles', $roles);

    $_SESSION['LongAnswer'] =  new ETSLongAnswers($convict, $convictText, $availability, $education, $experience,
        $languages, $youngAdult, $diagnosis, $selfDisclosure, $positiveOutlook, $backgroundCheck, $whyPresenter,
        $personalExperience, $supportiveExperience, $recoveryMeaning, $roles);

    if(validETSLongAnswersForm())
    {
        if($_POST['goToReview'] == true)
        {
            $f3->reroute('/review');
        }

        $f3->reroute('/not_required');
    }
}

if(!isset($_SESSION['LongAnswer']))
{
    $_SESSION['LongAnswer'] = new ETSLongAnswers('','','','',
        '','', '', '', '', '', '',
        '', '', '', '', '');
}