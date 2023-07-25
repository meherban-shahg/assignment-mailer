<?php
namespace Meherban\Interview;

$mailer = new Mailer('fr'); // Create a Mailer object with French localization
$mailer->setSMTP('smtp.example.com', 'your_smtp_username', 'your_smtp_password');
$mailer->setFrom('sender@example.com', 'Sender Name');
$mailer->addTo('recipient@example.com', 'Recipient Name');
$mailer->setSubject('Test Email'); // The subject will be automatically localized
$mailer->send(); // Send the email with localized content
