<?php

namespace Silent\DailyPicsCoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PicsController extends Controller
{
    const PicsPerPage = 5;

    public function homeAction()
    {
        $imagesQuery = $this->getDoctrine()
            ->getManager()
            ->getRepository('SilentDailyPicsCoreBundle:Image')
            ->getBaseListForKnpPaginator($this->get('dailyPicsUtils')->getCurrentCachedTime());

        $images = $this->get('knp_paginator')->paginate(
            $imagesQuery,
            $this->get('request')->query->get('page', 1), self::PicsPerPage);

        return $this->render('SilentDailyPicsCoreBundle:Pages:home.html.twig',
            array('images' => $images));
    }

    public function showPicsAction($slug)
    {
        $imageR = $this->getDoctrine()
            ->getManager()
            ->getRepository('SilentDailyPicsCoreBundle:Image');
        $now = $this->get('dailyPicsUtils')->getCurrentCachedTime();

        $image = $imageR->getOneImage($slug, $now);
        $previousImage = $imageR->getPreviousImage($image ,$now);
        $netImage = $imageR->getNextImage($image ,$now);

        return $this->render('SilentDailyPicsCoreBundle:Pages:singlePics.html.twig',
            array('image' => $image,
                "previousImage" => $previousImage,
            "nextImage" => $netImage)
            );
    }
}
