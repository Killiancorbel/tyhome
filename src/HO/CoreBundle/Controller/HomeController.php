<?php

namespace HO\CoreBundle\Controller;

use HO\CoreBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function contactAction(Request $request) {
        $data = $request->request->all();
        $name = $data['name'];
        $email = $data['email'];
        $message = $data['message'];

        mail('killian.corbel@gmail.com', 'Message de ' . $name . ' - ' . $email, $message);

        $messageEnt = new Message();
        $messageEnt->setName($name);
        $messageEnt->setEmail($email);
        $messageEnt->setMessage($message);
        $em = $this->getDoctrine()->getManager();
        $em->persist($messageEnt);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', 'Votre mail a bien été envoyé, nous reviendrons vers vous le plus vite possible');
        return $this->redirectToRoute('ho_core_homepage');

    }
}
