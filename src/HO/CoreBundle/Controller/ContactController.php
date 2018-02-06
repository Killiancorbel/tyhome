<?php

namespace HO\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class ContactController extends Controller
{
    public function indexAction(Request $request)
    {
    	$defaultData = null;
  	    $form = $this->createFormBuilder($defaultData)
        	->add('name', TextType::class)
        	->add('email', EmailType::class)
        	->add('message', TextareaType::class)
        	->add('send', SubmitType::class, array('attr' => array('class' => 'btn btn-success')))
        	->getForm();

        $form->handleRequest($request);
    	if ($form->isSubmitted() && $form->isValid())
    	{
            $name = $form->get('name')->getData();
            $message = $form->get('message')->getData();
            $email = $form->get('email')->getData();

            $core = \Swift_Message::newInstance()
                ->setSubject('[TyHome.co] New message from ' . $name)
                ->setFrom('tyhomeVR@gmail.com')
                ->setTo('killian.corbel@gmail.com')
                ->setBody($this->renderView('HOCoreBundle:Contact:email.txt.twig', array('message' => $message)));
            $this->get('mailer')->send($core);

    		$request->getSession()->getFlashBag()->add('info', 'Your request has been sent, we\'ll look after it and get back to you as soon as possible');
            return $this->redirectToRoute('ho_core_homepage');
    	}

        return $this->render('HOCoreBundle:Contact:index.html.twig', array(
        	'form' => $form->createView()));
    }
}
