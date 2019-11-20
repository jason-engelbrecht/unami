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
        $hashedId = password_hash($applicantId, PASSWORD_BCRYPT);
        $applicantName = $personalInfo->getFname() .' '.$personalInfo->getLname();

        $toEmail = $db->getAffiliateEmail($personalInfo->getAffiliate());
        $toEmailAlias = $db->getAffiliateName($personalInfo->getAffiliate());

        try
        {
            $message = (new Swift_Message('Review Application: '.$applicantName))
                ->setFrom([EMAIL_USERNAME => 'UNAMI: DO-NOT-REPLY'])
                ->setTo([$toEmail => $toEmailAlias]);


            $cid = $message->embed(Swift_Image::fromPath('http://mlee.greenriverdev.com/unami/images/namiLogo.png',
                'image.png', 'image/png'));

            $body = <<<EOD
        <html lang="en">
            <body>
                <div style="background-color: #0c499c">
                    <img src="$cid" alt="NAMI WA Logo">
                </div>
                
                <div>
                    <p>Please review $applicantName's application: 
                    <a href="http://mlee.greenriverdev.com/unami/affiliate_review/$applicantId/$hashedId">Here</a></p>
                </div>
            </body>
        </html>
EOD;

            $message->setBody($body, 'text/html');
            $message->addPart('Please review '.$applicantName."'s application: 
            http://mlee.greenriverdev.com/unami/affiliate_review/".$applicantId.'/'.$hashedId, 'text/plain');

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
        //$body = 'Thank you for sending your application';
        $toEmail = $personalInfo->getEmail();
        $toEmailName = $personalInfo->getFname() .' '.$personalInfo->getLname();

        try
        {
            $message = (new Swift_Message('UNAMI application'))
                ->setFrom([EMAIL_USERNAME => 'UNAMI: DO-NOT-REPLY'])
                ->setTo([$toEmail => $toEmailName]);
            $cid = $message->embed(Swift_Image::fromPath('http://mlee.greenriverdev.com/unami/images/namiLogo.png',
                'image.png', 'image/png'));
            $body = <<<EOD
        <html lang="en">
            <body>
                <div style="background-color: #0c499c">
                    <img src="$cid" alt="NAMI WA Logo">
                </div>
                
                <div>
                    <p><center>Thank you for sending your application!</center></p><br>
                    <p><center>If you're not a NAMI member, please sign-up 
                    <a href="https://www.nami.org/Get-Involved/Join">here
                    </a> to complete the training with NAMI.</center></p>
                </div>
            </body>
        </html>
EOD;
            $message->setBody($body, 'text/html');


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