<?php
namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/mailer", name="mailer_")
 */

class MailerController extends AbstractController
{
    /**
     * send maile
     * 
     * @Route("/send" , name="send")
     */    
    public function sendEmail(MailerInterface $mailer,Request $request,MailerService $MailerService)
    {
        error_log('je suis controller mailer');
        $params = $request->getContent();
        $MailerService->sendEmail($params);
    }
}