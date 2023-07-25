<?php
namespace Meherban\Interview;


// Usage example:
$mailgunApiKey = 'your_mailgun_api_key';
$mailgunDomain = 'your_mailgun_domain';
$locale = 'en'; // Change this to the desired locale (e.g., 'fr', 'es', etc.)

$mailer = new Mailgun($mailgunApiKey, $mailgunDomain, $locale);

$to = 'recipient@example.com';
$subject = 'Localized Email Test';
$body = '<p>Hello, {{name}}!</p>';
$senderEmail = 'sender@example.com';
$senderName = 'Your Name';

$mailer->sendEmail($to, $subject, $body, $senderEmail, $senderName);