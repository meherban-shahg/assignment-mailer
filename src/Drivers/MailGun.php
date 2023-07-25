<?php
namespace Meherban\Interview;


class Mailgun {
    private $mailgun;
    private $domain;
    private $locale;

    public function __construct($apiKey, $domain, $locale = 'en') {
        $this->mailgun = \Mailgun\Mailgun::create($apiKey);
        $this->domain = $domain;
        $this->locale = $locale;
    }

    

    public function sendEmail($to = array(),$cc = array(), $bcc = array(),$subject, $body, $senderEmail, $senderName,$attachments = array()) {
        // Set the locale in the email headers
        $headers = array(
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Mailgun-Variables' => json_encode(array('locale' => $this->locale))
        );

        $params = array(
            'from' => "$senderName <$senderEmail>",
            'subject' => $subject,
            'html' => $body,
            'text' => strip_tags($body)
        );

        if (!empty($cc)) {
            $params['to'] = $to;
        }
        if (!empty($cc)) {
            $params['cc'] = $cc;
        }

        if (!empty($bcc)) {
            $params['bcc'] = $bcc;
        }
        // Add attachments if provided
        foreach ($attachments as $attachment) {
            $params['attachment'][] = curl_file_create($attachment);
        }

        // Send the email through Mailgun
        $result = $this->mailgun->messages()->send($this->domain, $params, $headers);

        return $result;
    }

}