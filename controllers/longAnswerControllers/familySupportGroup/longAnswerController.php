<?php
global $f3;

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

    $_SESSION['LongAnswer'] =  new FSGLongAnswers($relativeMentalIllness, $relativeMentalIllnessText, $convict,
        $convictText, $whyFacilitator, $experience, $coFacWhom, $coFacWhomText, $coFacWhere, $coFacWhereText);

    if(validFSGLongAnswersForm())
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
    $_SESSION['LongAnswer'] = new FSGLongAnswers('','','','',
        '','', '', '', '', '');
}