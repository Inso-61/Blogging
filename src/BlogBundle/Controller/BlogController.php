<?php 
namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BlogBundle\Entity\Blog;
use BlogBundle\Form\BlogType;

class BlogController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BlogBundle:Blog')->findAll();
        return $this->render('BlogBundle:Blog:show.html.twig', array(
            'blog' => $entities,
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BlogBundle:Blog')->find(1);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blog entity.');
        }
        return $this->render('BlogBundle:Blog:show.html.twig', array(
            'blog'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing Blog entity.
     *
     */
    public function editAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BlogBundle:Blog')->find(1);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blog entity.');
        }
        $editForm = $this->createEditForm($entity);
        return $this->render('BlogBundle:Blog:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Blog entity.
     */
    private function createEditForm(Blog $entity)
    {
        $form = $this->createForm(new BlogType(), $entity, array(
            'action' => $this->generateUrl('blog_update', array('id' => 1)),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        return $form;
    }
    /**
     * Edits an existing Blog entity.
     *
     */
    public function updateAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BlogBundle:Blog')->find(1);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blog entity.');
        }
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('blog_edit', array('id' => 1)));
        }
        return $this->render('BlogBundle:Blog:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }


}