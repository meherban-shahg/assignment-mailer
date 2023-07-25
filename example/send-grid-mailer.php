<?php
namespace Meherban\Interview;

// Example usage
$apiKey = "YOUR_SENDGRID_API_KEY";
$mailer = new SendGridMailer($apiKey);

// Example email body with localization (English and Spanish)
// $body = [
//     'en' => [
//         'text' => 'This is the plain text content in English.',
//         'html' => '<p>This is the <b>HTML</b> content in English.</p>',
//     ],
//     'es' => [
//         'text' => 'Este es el contenido de texto en Español.',
//         'html' => '<p>Este es el contenido <b>HTML</b> en Español.</p>',
//     ],
// ];

// Example recipients and attachments

$to = 'recipient@example.com'; // Replace with the recipient's email address
$cc = array('cc1@example.com', 'cc2@example.com'); // Replace with CC recipients' email addresses
$bcc = array('bcc1@example.com', 'bcc2@example.com'); // Replace with BCC recipients' email addresses
$senderEmail = 'sender@example.com';
$senderName = 'Your Name';
$subject = 'Your email subject';
$body = '<html><body><h1>Hello from Mailgun!</h1><p>This is the email content.</p></body></html>';
$attachments = array('/path/to/file1.pdf', '/path/to/file2.jpg');




// Send the email
$success = $mailer->sendMail($to, $cc, $bcc, $subject, $body, $senderName, $attachments);

if ($success) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}