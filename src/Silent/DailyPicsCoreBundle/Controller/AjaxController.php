<?php

namespace Silent\DailyPicsCoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AjaxController extends Controller
{
    public function moreInfoAjaxAction(Request $request)
    {
        if($request->isXmlHttpRequest()) {
            return $this->render('::cookieMoreInfo.html.twig');
        } else {
            return $this->redirect($this->generateUrl('silent_daily_pics_core_home'));
        }
    }
}
