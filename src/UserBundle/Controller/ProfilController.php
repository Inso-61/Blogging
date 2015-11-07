<?php 
namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    public function indexAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('UserBundle:User')->findAll();

        return $this->render('UserBundle:Profile:profil.html.twig', array(
            'user' => $user, 'author' => $id,
        ));

    }
}
