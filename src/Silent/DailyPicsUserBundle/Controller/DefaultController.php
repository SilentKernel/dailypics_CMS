<?php

namespace Silent\DailyPicsUserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SilentDailyPicsUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
