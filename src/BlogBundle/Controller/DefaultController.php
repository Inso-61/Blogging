<?php

namespace BlogBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entities_article = $em->getRepository('BlogBundle:Article')->findAll();
        $entities_categorie = $em->getRepository('BlogBundle:Category')->findAll();
        $entities_blog = $em->getRepository('BlogBundle:Blog')->findAll();

        return $this->render('BlogBundle:default:index.html.twig', array('article' => $entities_article, 'categorie' => $entities_categorie, 'blog' => $entities_blog));
    }

    public function adminAction() {
        return $this->render('BlogBundle:default:admin.html.twig');
    }
}
