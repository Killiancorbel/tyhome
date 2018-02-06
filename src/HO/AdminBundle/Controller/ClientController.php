<?php

namespace HO\AdminBundle\Controller;

use HO\AdminBundle\Entity\Clients;
use HO\UserBundle\Entity\User;
use HO\AdminBundle\Form\ClientsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends Controller
{
    public function listAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$clientRepository = $em->getRepository('HOAdminBundle:Clients');
    	$clients = $clientRepository->findAll();


        return $this->render('HOAdminBundle:Client:list.html.twig', array('clients' => $clients));
    }

    public function addAction(Request $request)
    {
    	$client = new Clients();

    	$form = $this->createForm(ClientsType::class, $client);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            if ($form->get('admin')->getData() == true)
            {
                $client->getUser()->setRoles(array('ROLE_ADMIN'));
            }
            else
                $client->getUser()->setRoles(array('ROLE_USER'));
            $client->getUser()->setSalt('');

            $em = $this->getDoctrine()->getManager();
    		$em->persist($client);
    		$em->flush();
            $request->getSession()->getFlashBag()->add('info', 'The new client has been added.');
    		return $this->redirectToRoute('ho_admin_list');
    	}

    	return $this->render('HOAdminBundle:Client:add.html.twig', array(
    		'form' => $form->createView()));
    }
}
