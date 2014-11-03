<?php

namespace Silent\DailyPicsCoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoryController extends Controller
{
    const PicsPerPage = 5;

    public function showCategoryAction($slug)
    {
        $category = $this->getDoctrine()
            ->getManager()->getRepository("SilentDailyPicsCoreBundle:Category")
            ->getCategoryBySlug($slug, $this->get('dailyPicsUtils')->getCurrentCachedTime());

        $images = $this->get('knp_paginator')->paginate(
            $category->getImages(),
            $this->get('request')->query->get('page', 1), self::PicsPerPage);


        return $this->render('SilentDailyPicsCoreBundle:Pages:category.html.twig',
            array('images' => $images,
                  'category' => $category));
    }

}
