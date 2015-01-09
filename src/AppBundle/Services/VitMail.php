<?php
namespace AppBundle\Services;

class VitMail
{
    protected $mailer;

    public function __construct($mailer)
    {
        $this->mailer = $mailer;
    }

    public function Send($subj, $from, $to, $letter)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subj)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($letter)
        ;

        $this->mailer->send($message);
    }
}
