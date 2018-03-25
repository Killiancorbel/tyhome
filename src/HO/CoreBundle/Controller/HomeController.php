<?php

namespace HO\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use HO\CoreBundle\Entity\Content;
use HO\CoreBundle\Entity\Video;

class HomeController extends Controller
{
    public function homeAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$contents = $em->getRepository('HOCoreBundle:Content')->findBy(array('type' => 'homepage'));
    	$content = $contents[0]->getCode();
    	$videos = $em->getRepository('HOCoreBundle:Video')->findAll();

    	$video1 = $videos[0]->getSource();
    	$video2 = $videos[1]->getSource();
    	$video3 = $videos[2]->getSource();
        return $this->render('HOCoreBundle:Home:index.html.twig', array(
        	'content' => $content,
        	'video1' => $video1,
        	'video2' => $video2,
        	'video3' => $video3));
    }

    public function contactAction() {

    }
}
