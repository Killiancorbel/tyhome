<?php

namespace HO\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HOMemberBundle:Default:index.html.twig');
    }
}
