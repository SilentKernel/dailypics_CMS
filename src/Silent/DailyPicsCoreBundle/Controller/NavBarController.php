<?php

namespace Silent\DailyPicsCoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavBarController extends Controller
{
    public function categoryAction()
    {
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository("SilentDailyPicsCoreBundle:Category")
            ->getCategoryForMenu($this->get('dailyPicsUtils')->getCurrentCachedTime());

        return $this->render('SilentDailyPicsCoreBundle:NavBar:category.html.twig',
            array('categories' => $categories));
    }

}
