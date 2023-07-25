<?php
namespace Meherban\Interview;


// Usage example:
$mailgunApiKey = 'your_mailgun_api_key';
$mailgunDomain = 'your_mailgun_domain';
$locale = 'en'; // Change this to the desired locale (e.g., 'fr', 'es', etc.)

$mailgunEmailSender = new Mailgun($mailgunApiKey, $mailgunDomain, $locale);

$to = 'recipient@example.com'; // Replace with the recipient's email address
$cc = array('cc1@example.com', 'cc2@example.com'); // Replace with CC recipients' email addresses
$bcc = array('bcc1@example.com', 'bcc2@example.com'); // Replace with BCC recipients' email addresses
$senderEmail = 'sender@example.com';
$senderName = 'Your Name';
$subject = 'Your email subject';
$body = '<html><body><h1>Hello from Mailgun!</h1><p>This is the email content.</p></body></html>';

// Attachments (file paths)
$attachments = array('/path/to/file1.pdf', '/path/to/file2.jpg');

// Send the email with attachments
$mailgunEmailSender->sendEmail($to, $cc, $bcc, $subject, $body, $senderName, null, 'en', $attachments);