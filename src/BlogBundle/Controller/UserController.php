<?php 
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{

    //Récuperer les infos d'un profil
    public function profileAction($id)
    {
        return $this->render('BlogBundle:User:profile.html.twig', array('id' => $id));
    }

}
