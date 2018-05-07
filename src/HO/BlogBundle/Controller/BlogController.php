<?php

namespace HO\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use HO\BlogBundle\Entity\Article;
use HO\BlogBundle\Form\ArticleType;


class BlogController extends Controller
{
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getManager();
        $repoArticles = $em->getRepository('HOBlogBundle:Article');

        $articles = $repoArticles->findBy(array(), array('date' => 'desc'), null, null);

        return $this->render('HOBlogBundle:Blog:index.html.twig', array('articles' => $articles));
    }

    public function addAction(Request $request) {
        $article = new Article();
        $article->setDate(new \Datetime('now', new \DateTimeZone('Europe/Paris')));

        $form = $this->createForm(ArticleType::class, $article);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'New article has been added');

            return $this->redirectToRoute('ho_blog_view', array('id' => $article->getId()));
        }

        return $this->render('HOBlogBundle:Blog:add.html.twig', array('form' => $form->createView()));
    }

    public function viewAction($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('HOBlogBundle:Article')->find($id);

        if ($article == null)
            throw new NotFoundHttpException('Cet article n\'existe pas');

        return $this->render('HOBlogBundle:Blog:view.html.twig', array('article' => $article));
    }

    public function editAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('HOBlogBundle:Article')->find($id);

        if ($article == null) {
            throw new NotFoundHttpException("Cet article n'existe pas");
        }

        $form = $this->createForm(ArticleType::class, $article);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'Article has been edited');

            return $this->redirectToRoute('ho_blog_view', array('id' => $article->getId()));

        }

        return $this->render('HOBlogBundle:Blog:edit.html.twig', array('form' => $form->createView()));
    }

    public function deleteAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('HOBlogBundle:Article')->find($id);

        if ($article == null) {
            throw new NotFoundHttpException("Cet article n'existe pas");
        }

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($article);
            $em->flush();
            $request->getSession()->getFlashbag()->add('info', 'Article deleted');
            return $this->redirectToRoute('ho_blog_index');
        }

        return $this->render('HOBlogBundle:Blog:delete.html.twig', array('form' => $form->createView(), 'article' => $article));
    }
}
