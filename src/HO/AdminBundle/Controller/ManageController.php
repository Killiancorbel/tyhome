<?php

namespace HO\AdminBundle\Controller;

use HO\ShopBundle\Entity\Product;
use HO\ShopBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ManageController extends Controller
{
    public function listProductAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$productRepository = $em->getRepository('HOShopBundle:Product');
    	$products = $productRepository->findAll();

        return $this->render('HOAdminBundle:Product:list.html.twig', array('products' => $products));
    }

    public function addProductAction(Request $request)
    {
    	$product = new Product();
    	$form = $this->createForm(ProductType::class, $product);

    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em = $this->getDoctrine()->getManager();
    		$em->persist($product);
    		$em->flush();
    		$request->getSession()->getFlashbag()->add('info', 'Produit bien enregistré');
    		return $this->redirectToRoute('ho_product_list');
    	}

    	return $this->render('HOAdminBundle:Product:add.html.twig', array('form' => $form->createView()));
    }

    public function editProductAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$product = $em->getRepository('HOShopBundle:Product')->find($id);

    	if ($product == null) {
    		throw new NotFoundHttpException('Ce produit n\'existe pas');
    	}

    	$form = $this->createForm(ProductType::class, $product);
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em->flush();
    		$request->getSession()->getFlashBag()->add('info', 'Produit bien modifié');
    		return $this->redirectToRoute('ho_product_list');
    	}

    	return $this->render('HOAdminBundle:Product:edit.html.twig', array(
    		'form' => $form->createView(),
    		'product' => $product));
    }

    public function deleteProductAction(Request $request, $id)
    {
    	$em = $this->getDoctrine()->getManager();
    	$product = $em->getRepository('HOShopBundle:Product')->find($id);

    	if ($product == null) {
    		throw new NotFoundHttpException('Produit non trouvé');
    	}

    	$form = $this->get('form.factory')->create();
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
    		$em->remove($product);
    		$em->flush();
    		$request->getSession()->getFlashbag()->add('info', 'Produit bien supprimé');
    		return $this->redirectToRoute('ho_product_list');
    	}

    	return $this->render('HOAdminBundle:Product:delete.html.twig', array('form' => $form->createView(), 'product' => $product));
    }
}
