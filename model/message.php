<?php

try {
    $message = (new Swift_Message('Wonderful Subject'))
        ->setFrom(['john@doe.com' => 'John Doe'])
        ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
        ->setBody('Here is the message itself')
    ;
    echo $message->toString();
}
catch (Exception $e)
{
    echo $e->getMessage();
}