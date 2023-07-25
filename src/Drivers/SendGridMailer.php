<?php
namespace Meherban\Interview;

class SendGridMailer
{
    private $sendgridApiKey;

    public function __construct($apiKey) {
        $this->sendgridApiKey = $apiKey;
    }

    public function sendMail($to, $cc = [], $bcc = [], $subject, $body, $senderEmail, $senderName,$attachments = [], $locale = 'en') {
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom($senderEmail, $senderName);
        $email->setSubject($subject);

        // Set the email body with both plain text and HTML versions for localization
        $email->addContent(
            "text/plain", $body[$locale]['text']
        );
        $email->addContent(
            "text/html", $body[$locale]['html']
        );

        // Add recipients
        $email->addTo($to);

        // Add CC recipients
        foreach ($cc as $ccEmail) {
            $email->addCc($ccEmail);
        }

        // Add BCC recipients
        foreach ($bcc as $bccEmail) {
            $email->addBcc($bccEmail);
        }

        // Attach files
        foreach ($attachments as $attachment) {
            $fileContent = base64_encode(file_get_contents($attachment['path']));
            $email->addAttachment(
                $fileContent,
                $attachment['mimeType'],
                $attachment['filename'],
                $attachment['disposition'],
                $attachment['contentId']
            );
        }

        $sendgrid = new \SendGrid($this->sendgridApiKey);
        try {
            $response = $sendgrid->send($email);
            return $response->statusCode() == 202; // Check if email was sent successfully (status code 202)
        } catch (\Exception $e) {
            return false;
        }
    }
}
