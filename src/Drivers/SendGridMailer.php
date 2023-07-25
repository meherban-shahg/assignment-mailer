<?php
namespace Meherban\Interview;

use SendGrid\Mail\Mail;
use SendGrid\Mail\Content;
use SendGrid\Mail\Personalization;
use SendGrid\Mail\EmailAddress;

class SendGridMailer
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function sendEmail($to, $subject, $body, $locale = 'en')
    {
        $email = new Mail();
        $email->setFrom('noreply@example.com', 'Your Name');
        $email->setSubject($subject);

        // Set up the email content
        $content = new Content('text/plain', $body);
        $email->addContent($content);

        // Set the email recipient(s)
        $personalization = new Personalization();
        $personalization->addTo(new EmailAddress($to));
        $email->addPersonalization($personalization);

        // Add localization settings to the email headers
        $headers = [
            'X-Locale' => $locale,
        ];
        $email->setHeaders($headers);

        // Send the email
        $sendgrid = new \SendGrid($this->apiKey);
        try {
            $response = $sendgrid->send($email);
            return $response->statusCode() === 202;
        } catch (\Exception $e) {
            // Handle any exceptions or errors here
            return false;
        }
    }
}
