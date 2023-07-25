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

    public function sendEmail($to, $subject, $body, $senderEmail, $senderName) {
        // Set the locale in the email headers
        $headers = array(
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Mailgun-Variables' => json_encode(array('locale' => $this->locale))
        );

        $params = array(
            'from' => "$senderName <$senderEmail>",
            'to' => $to,
            'subject' => $subject,
            'html' => $body,
            'text' => strip_tags($body)
        );

        // Send the email through Mailgun
        $result = $this->mailgun->messages()->send($this->domain, $params, $headers);

        return $result->http_response_code === 200;
    }

}