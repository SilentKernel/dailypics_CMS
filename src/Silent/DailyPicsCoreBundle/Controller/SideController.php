<?php

namespace Silent\DailyPicsCoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SideController extends Controller
{
    public function categoryAction()
    {
        $categories = $this->getDoctrine()
            ->getManager()
            ->getRepository("SilentDailyPicsCoreBundle:Category")
            ->getCategoryForMenu($this->get('dailyPicsUtils')->getCurrentCachedTime());

        return $this->render('SilentDailyPicsCoreBundle:Side:category.html.twig',
            array('categories' => $categories));
    }

    public function randomAction()
    {
        $randImg = $this->get('dailyPicsUtils')->getRandomPics(12);
        return $this->render('SilentDailyPicsCoreBundle:Side:random.html.twig',
            array('randImg' => $randImg));
    }

}
