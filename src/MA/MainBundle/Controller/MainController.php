<?php

namespace MA\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        return $this->render('MAMainBundle:Main:index.html.twig');
    }
}
