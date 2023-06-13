<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class MailerService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($params)
    {
        $email = (new Email())
            ->from('alexsmtptravaille@gmail.com')
            //->to($params['to'])
            ->to('alex.errecade@hotmail.com')
            ->cc('alex.errecade@hotmail.com')
            ->subject($params['subject'])
            ->text($params['text'])
            ->html($params['html']);


        $this->mailer->send($email);
        return true;
    }
}
