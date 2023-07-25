<?php
namespace Meherbanshah\Mailer;

interface MailerInterface
{
    public function setSubject($str);
    public function setTo($array);
    public function setFrom($array);
    public function setHtml($bool);
    public function setBody($body);
}