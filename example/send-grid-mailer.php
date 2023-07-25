<?php
namespace Meherban\Interview;

// Include the SendGridMailer class and its dependencies

// Instantiate the SendGridMailer class
$mailer = new SendGridMailer('YOUR_SENDGRID_API_KEY');

// Example: Sending an email with localization settings
$to = 'recipient@example.com';
$subject = 'Test Email';
$body = 'This is the email body.';
$locale = 'fr'; // Set the desired localization code (e.g., 'fr' for French)

// Send the email
if ($mailer->sendEmail($to, $subject, $body, $locale)) {
    echo 'Email sent successfully.';
} else {
    echo 'Email could not be sent.';
}
