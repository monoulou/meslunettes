<?php

namespace MA\MainBundle\Service;



use MA\MainBundle\Entity\Annonce;
use Symfony\Component\Form\FormInterface;

class SendEmail
{
    private $emailer;

    private $templating;

    
    /*private $mailerUser;*/

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig)
    {
        $this->emailer = $mailer;
        $this->templating = $twig;

        
        /*$this->mailerUser = $mailerUser;*/
    }

    public function contactSeller(FormInterface $contactForm, Annonce $annonce)
    {

        $destination = $annonce->getEmail();
        $msg = $contactForm->get('message')->getData();
        $sender = $contactForm->get('emailAdress')->getData();
        //$image = (new \Swift_Message())->embed(\Swift_Image::fromPath('/web/images/header_meslunettes.com.png'));
        $message = (new \Swift_Message());
        
        //$img = $message->embed(\Swift_Image::fromPath('/web/images/header.png'));
        
        $message
            ->setFrom($sender)
            ->setTo($destination)
            ->setSubject('Mes Lunettes.com')
            ->setBody(
                $this->templating->render(
                    'Emails/contact_vendeur.html.twig',
                    array
                    ('msg' => $msg, 'sender' => $sender)
                ),
                'text/html'
            )
        ;

        $this->emailer->send($message);
      
    }

/*    public function getMailerUser()
    {
        return $this->mailerUser;
    }*/
}