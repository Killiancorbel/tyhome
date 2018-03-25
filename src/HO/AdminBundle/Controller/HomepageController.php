<?php

namespace HO\AdminBundle\Controller;

use HO\CoreBundle\Entity\Content;
use HO\CoreBundle\Entity\Video;
use HO\CoreBundle\Form\ContentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HO\CoreBundle\Form\VideoType;


class HomepageController extends Controller
{
	public function homeAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$homepages = $em->getRepository('HOCoreBundle:Content')->findBy(array('type' => 'homepage'));
		$homepage = $homepages[0];

		$form = $this->createForm(ContentType::class, $homepage);
		if ($request->isMethod('POST') && ($form->handleRequest($request)->isValid())) {
			$em->flush();
			$request->getSession()->getFlashBag()->add('info', 'Bien modifié');
		}
		return $this->render('HOAdminBundle:Homepage:edit.html.twig', array(
			'form' => $form->createView()));
	}
}
