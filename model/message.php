<?php

echo '<br><br>';

try {
    $message = (new Swift_Message('Wonderful Subject'))
        ->setFrom(['testUser@mlee.greenriverdev.com' => 'John Doe'])
        ->setTo(['maxwelllee56@gmail.com' => 'Max Lee'])
        ->setBody('Here is the message itself');

    $transport = (new Swift_SmtpTransport('mlee.greenriverdev.com', 25))
        ->setUsername('testUser@mlee.greenriverdev.com')
        ->setPassword('Richland#56');

    $mailer = new Swift_Mailer($transport);

    //sends the email
    //$result = $mailer->send($message);

    echo $message->toString();
}
catch (Exception $e)
{
    echo $e->getMessage();
}

echo '<br><br>';

echo $result;

echo '<br><br>';
echo function_exists('proc_open') ? 'Success' : 'Fail';