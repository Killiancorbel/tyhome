<?php

namespace HO\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HO\AdminBundle\Entity\Software;
use HO\AdminBundle\Entity\Documentation;
use HO\AdminBundle\Form\DocumentationType;
use HO\AdminBundle\Form\SoftwareType;

class MemberController extends Controller
{
    public function listAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$docs = $em->getRepository('HOAdminBundle:Documentation')->findAll();
    	$softs = $em->getRepository('HOAdminBundle:Software')->findAll();

    	return $this->render('HOAdminBundle:Member:list.html.twig', array(
    		'softs' => $softs,
    		'docs' => $docs));
    }

    public function addDocAction(Request $request)
    {
    	$doc = new Documentation();
    	$form = $this->createForm(DocumentationType::class, $doc);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($doc);
    		$em->flush();
    		$request->getSession()->getFlashBag()->add('info', 'Documentation bien ajoutée');
    		return $this->redirectToRoute('ho_files_list');
    	}

    	return $this->render('HOAdminBundle:Member:addDoc.html.twig', array(
    		'form' => $form->createView()));
    }

    public function editDocAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$doc = $em->getRepository('HOAdminBundle:Documentation')->find($id);

    	if ($doc == null) {
    		throw new NotFoundHttpException('Ce document n\'existe pas');
    	}

    	$form = $this->createForm(DocumentationType::class, $doc);
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em->flush();
    		$request->getSession()->getFlashBag()->add('info', 'Document bien modifié');
    		return $this->redirectToRoute('ho_files_list');
    	}

    	return $this->render('HOAdminBundle:Member:editDoc.html.twig', array(
    		'form' => $form->createView()));
    }

    public function deleteDocAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$doc = $em->getRepository('HOAdminBundle:Documentation')->find($id);
    	if ($doc == null)
    		throw new NotFoundHttpException('Ce document n\'existe pas');
    	$form = $this->get('form.factory')->create();
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em->remove($doc);
    		$em->flush();
    		$request->getSession()->getFlashbag()->add('info', 'Document bien supprimé');
    		return $this->redirectToRoute('ho_files_list');
    	}

    	return $this->render('HOAdminBundle:Member:deleteDoc.html.twig', array(
    		'form' => $form->createView(),
    		'doc' => $doc));
    }

    public function addSoftAction(Request $request)
    {
    	$soft = new Software();
    	$form = $this->createForm(SoftwareType::class, $soft);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($soft);
    		$em->flush();
    		$request->getSession()->getFlashBag()->add('info', 'Software bien ajoutée');
    		return $this->redirectToRoute('ho_files_list');
    	}

    	return $this->render('HOAdminBundle:Member:addSoft.html.twig', array(
    		'form' => $form->createView()));
    }

    public function editSoftAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$soft = $em->getRepository('HOAdminBundle:Software')->find($id);
    	if ($soft == null)
    		throw new NotFoundHttpException('Ce soft n\'existe pas');
    	$form = $this->createForm(SoftwareType::class, $soft);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    	{
    		$em->flush();
    		$request->getSession()->getFlashBag()->add('info', 'Software bien modifié');
    		return $this->redirectToRoute('ho_files_list');
    	}
    	return $this->render('HOAdminBundle:Member:editSoft.html.twig', array(
    		'form' => $form->createView()));
    }

    public function deleteSoftAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$soft = $em->getRepository('HOAdminBundle:Software')->find($id);
    	if ($soft == null)
    		throw new NotFoundHttpException('Ce soft n\'existe pas');
    	$form = $this->get('form.factory')->create();
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em->remove($soft);
    		$em->flush();
    		$request->getSession()->getFlashbag()->add('info', 'Software bien supprimé');
    		return $this->redirectToRoute('ho_files_list');
    	}

    	return $this->render('HOAdminBundle:Member:deleteSoft.html.twig', array(
    		'form' => $form->createView(),
    		'soft' => $soft));
    }
}
