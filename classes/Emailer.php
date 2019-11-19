<?php

$user = $_SERVER['USER'];
require "/home/$user/config_email.php";

/**
 * Class Emailer Handles using SwiftMailer to email the applicant and affiliate
 */
class Emailer
{
    /**
     * Handles sending the affiliate an email to review an application
     * @param $applicantId int ID of the applicant
     * @param $personalInfo PersonalInfo The personal info from the form
     * @param $db UnamiDatabase The database we are using
     */
    static function sendAffiliateEmail($applicantId, $personalInfo, $db)
    {
        $body = 'Please go here: http://mlee.greenriverdev.com/unami/affiliate_review?appId='.$applicantId;
        $toEmail = $db->getAffiliateEmail($personalInfo->getAffiliate());
        $toEmailAlias = $db->getAffiliateName($personalInfo->getAffiliate());

        $applicantName = $personalInfo->getFname() .' '.$personalInfo->getLname();

        try
        {
            $message = (new Swift_Message('Review Application: '.$applicantName))
                ->setFrom([EMAIL_USERNAME => 'UNAMI: DO-NOT-REPLY'])
                ->setTo([$toEmail => $toEmailAlias])
                ->setBody($body);

            $transport = (new Swift_SmtpTransport(EMAIL_SERVER, 465, 'ssl'))
                ->setUsername(EMAIL_USERNAME)
                ->setPassword(EMAIL_PASSWORD);

            $mailer = new Swift_Mailer($transport);

            //sends the email
            $mailer->send($message);
        }

        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Handles sending the applicant a confirmation email
     * @param $personalInfo PersonalInfo The personal info from the form
     */
    static function sendConfirmationEmail($personalInfo)
    {
        $body = 'Thank you for sending your application';
        $toEmail = $personalInfo->getEmail();
        $toEmailName = $personalInfo->getFname() .' '.$personalInfo->getLname();

        try
        {
            $message = (new Swift_Message('UNAMI application'))
                ->setFrom([EMAIL_USERNAME => 'UNAMI: DO-NOT-REPLY'])
                ->setTo([$toEmail => $toEmailName])
                ->setBody($body);

            $transport = (new Swift_SmtpTransport(EMAIL_SERVER, 465, 'ssl'))
                ->setUsername(EMAIL_USERNAME)
                ->setPassword(EMAIL_PASSWORD);
            $mailer = new Swift_Mailer($transport);

            $mailer->send($message);
        }

        catch (Exception $e)
        {
            echo $e->getMessage();
        }

    }
}