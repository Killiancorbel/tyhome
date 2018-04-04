<?php

namespace HO\MemberBundle\Controller;

use HO\MemberBundle\Entity\PremiumFile;
use HO\MemberBundle\Form\PremiumFileType;
use HO\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function uploadAction(Request $request) {
        if (!$this->get('security.authorization_checker')->isGranted('ROLE_PREMIUM')) {
            return $this->redirectToRoute('ho_core_homepage');
        }
        $em = $this->getDoctrine()->getManager();
        $premiumFile = new PremiumFile();
        $premiumFile->setUser($this->getUser());
        $form = $this->createForm(PremiumFileType::class, $premiumFile);
        $files = $em->getRepository(PremiumFile::class)->findBy(array('user' => $this->getUser()));
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($premiumFile);
            $em->flush();
        }
        return $this->render('HOMemberBundle:Files:upload.html.twig', array(
            'form' => $form->createView(),
            'files' =>  $files
        ));
    }

    public function createPremiumAction() {
        $user = new User();
        $user->setSalt("");
        $user->setPassword("azerty");
        $user->setUsername("thekten@gmail.com");
        $user->setRoles(array("ROLE_PREMIUM"));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
    }
}
