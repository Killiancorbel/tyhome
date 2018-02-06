<?php

namespace HO\MemberBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use HO\AdminBundle\Entity\Documentation;
use HO\AdminBundle\Entity\Software;

class MemberController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $docs = $em->getRepository('HOAdminBundle:Documentation')->findAll();
        $softs = $em->getRepository('HOAdminBundle:Software')->findAll();

        return $this->render('HOMemberBundle:Files:index.html.twig', array(
            'docs' => $docs,
            'softs' => $softs));
    }
}
