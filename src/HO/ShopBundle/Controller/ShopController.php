<?php

namespace HO\ShopBundle\Controller;

use HO\ShopBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller
{
    public function listAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$productRepository = $em->getRepository('HOShopBundle:Product');
    	$products = $productRepository->findAll();


        return $this->render('HOShopBundle:Shop:list.html.twig', array('products' => $products));
    }
}
