<?php

$user = $_SERVER['USER'];
require "/home/$user/config_email.php";

/**
 * Class Emailer Handles using SwiftMailer to email the applicant and affiliate
 */
class Emailer
{
    /**
     * @param $applicantId int
     * @param $personalInfo PersonalInfo
     * @param $db UnamiDatabase
     */
    static function sendAffiliateEmail($applicantId, $personalInfo, $db)
    {
        $body = 'Please go here: http://mlee.greenriverdev.com/unami/affiliate_review?appId='.$applicantId;
        $toEmail = $db->getAffiliateEmail($personalInfo->getAffiliate());
        $toEmailAlias = $db->getAffiliateName($personalInfo->getAffiliate());

        try {
            $message = (new Swift_Message('Wonderful Subject'))
                ->setFrom([EMAIL_USERNAME => 'UNAMI: DO-NOT-REPLY'])
                ->setTo([$toEmail => $toEmailAlias])
                ->setBody($body);

            $transport = (new Swift_SmtpTransport(EMAIL_SERVER, 465, 'ssl'))
                ->setUsername(EMAIL_USERNAME)
                ->setPassword(EMAIL_PASSWORD);

            $mailer = new Swift_Mailer($transport);

            //sends the email
            $result = $mailer->send($message);

            //for testing
            //echo $message->toString();
            //echo '<br><br>'.$result;
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    static function sendConfirmationEmail($personalInfo)
    {
        $body = 'Thank you for sending your application';
        $toEmail = $personalInfo->getEmail();

        try {
            $message = (new Swift_Message('UNAMI application'))
                ->setFrom(['_mainaccount@tluu9.greenriverdev.com' => 'DO-NOT-REPLY'])
                ->setTo([$toEmail => 'Trang Luu'])
                ->setBody($body);

            $transport = (new Swift_SmtpTransport('mail.tluu9.greenriverdev.com', 25))
                ->setUsername('trangluu@tluu9.greenriverdev.com')
                ->setPassword('xEu)2mm-V4Yz');
            $mailer = new Swift_Mailer($transport);

            $result = $mailer->send($message);
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }

    }
}