<?php 
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('BlogBundle:default:admin.html.twig');
    }
}