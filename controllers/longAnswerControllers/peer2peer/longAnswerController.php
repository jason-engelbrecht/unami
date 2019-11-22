<?php
global $f3;

if(!empty($_POST))
{
    // get data from form
    $convict = $_POST['convict'];
    $convictText = $_POST['convictText'];
    $whyLeader = $_POST['whyLeader'];
    $mentalHealth = $_POST['mentalHealth'];
    $giveBack = $_POST['giveBack'];

    if($convict == 'no')
    {
        $convictText = 'N/A';
    }

    // add data to hive
    $f3->set('convict', $convict);
    $f3->set('convictText', $convictText);
    $f3->set('whyLeader', $whyLeader);
    $f3->set('mentalHealth', $mentalHealth);
    $f3->set('giveBack', $giveBack);

    $_SESSION['LongAnswer'] =  new P2PLongAnswers($convict, $convictText, $whyLeader, $mentalHealth, $giveBack);

    if(validP2PLongAnswersForm())
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
    $_SESSION['LongAnswer'] = new P2PLongAnswers('','','','',
        '');
}