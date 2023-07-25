<?php
namespace Meherban\Interview;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer{
    private PHPMailer $mailer;
    private string $language;

    public function __construct(string $language = 'en')
    {
        $this->mailer = new PHPMailer(true);
        $this->language = $language;
    }

    public function setSMTP(string $host, string $username, string $password, int $port = 587, string $smtpSecure = 'tls'): void
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $host;
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $username;
        $this->mailer->Password = $password;
        $this->mailer->SMTPSecure = $smtpSecure;
        $this->mailer->Port = $port;
    }

    public function setFrom(string $email, string $name): void
    {
        $this->mailer->setFrom($email, $name);
    }

    public function addTo(string $email, string $name): void
    {
        $this->mailer->addAddress($email, $name);
    }

    public function addReplyTo(string $email, string $name): void
    {
        $this->mailer->addReplyTo($email, $name);
    }

    public function addCC(string $email, string $name): void
    {
        $this->mailer->addCC($email, $name);
    }

    public function addBCC(string $email, string $name): void
    {
        $this->mailer->addBCC($email, $name);
    }

    public function setSubject(string $subject): void
    {
        $this->mailer->Subject = $subject;
    }

    public function setHTMLBody(string $htmlBody): void
    {
        $this->mailer->isHTML(true);
        $this->mailer->Body = $htmlBody;
    }

    public function setPlainTextBody(string $plainTextBody): void
    {
        $this->mailer->isHTML(false);
        $this->mailer->Body = $plainTextBody;
    }

    public function addAttachment(string $filePath, string $fileName = ''): void
    {
        $this->mailer->addAttachment($filePath, $fileName);
    }

    public function send(): bool
    {
        try {
            $this->loadLocalizedContent();
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            // Handle the exception or log the error
            return false;
        }
    }

    private function loadLocalizedContent(): void
    {
        // Load email templates and other content in the chosen language
        // Replace this with your localization logic based on $this->language
        $localizedSubject = $this->getLocalizedSubject();
        $localizedHTMLBody = $this->getLocalizedHTMLBody();
        $localizedPlainTextBody = $this->getLocalizedPlainTextBody();

        if (!empty($localizedSubject)) {
            $this->mailer->Subject = $localizedSubject;
        }

        if (!empty($localizedHTMLBody)) {
            $this->mailer->Body = $localizedHTMLBody;
            $this->mailer->isHTML(true);
        }

        if (!empty($localizedPlainTextBody)) {
            $this->mailer->AltBody = $localizedPlainTextBody;
            $this->mailer->isHTML(false);
        }
    }

    private function getLocalizedSubject(): string
    {
        // Replace this with your logic to get the localized subject based on $this->language
        // For example, use an array of language => subject mappings
        $subjectTranslations = [
            'en' => 'English Subject',
            'fr' => 'French Subject',
            'es' => 'Spanish Subject',
            // Add more translations as needed
        ];

        return $subjectTranslations[$this->language] ?? '';
    }

    private function getLocalizedHTMLBody(): string
    {
        // Replace this with your logic to get the localized HTML body based on $this->language
        // For example, use an array of language => HTML body mappings
        $htmlBodyTranslations = [
            'en' => '<p>English HTML Body</p>',
            'fr' => '<p>French HTML Body</p>',
            'es' => '<p>Spanish HTML Body</p>',
            // Add more translations as needed
        ];

        return $htmlBodyTranslations[$this->language] ?? '';
    }

    private function getLocalizedPlainTextBody(): string
    {
        // Replace this with your logic to get the localized plain text body based on $this->language
        // For example, use an array of language => plain text body mappings
        $plainTextBodyTranslations = [
            'en' => 'English Plain Text Body',
            'fr' => 'French Plain Text Body',
            'es' => 'Spanish Plain Text Body',
            // Add more translations as needed
        ];

        return $plainTextBodyTranslations[$this->language] ?? '';
    }
}