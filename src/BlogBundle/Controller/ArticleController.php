<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Comments;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BlogBundle\Entity\Article;
use BlogBundle\Form\Type\ArticleType;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller
{
    /**
     * Lists all Article entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BlogBundle:Article')->findAll();

        return $this->render('BlogBundle:Article:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function articleAction($id){

        $comment = new Comments();
        // On génère le formulaire
        $formBuilder = $this->get('form.factory')->createBuilder('form', $comment);
        $formBuilder
            ->add('objet', 'text')
            ->add('commentaire', 'textarea')
            ->add('article', 'hidden')
            ->add('envoyer', 'submit')
            ->add('user', 'hidden')
            ->add('date', 'hidden');

        $form = $formBuilder->getForm();
        $request = $this->get('request');

        // On vérifie qu'elle est de type POST
        if ($request->getMethod() == 'POST') {
            // On fait le lien Requête <-> Formulaire
            // À partir de maintenant, les variables contiennent les valeurs entrées dans le formulaire par le visiteur
            $form->bind($request);

            // On vérifie que les valeurs entrées sont correctes
            if ($form->isValid()) {
                // On enregistre notre objet dans la base de données
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();

            }
        }
        // On récupère les données de l'article et les commentaires
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository('BlogBundle:Article')->findAll($id);
        $entities_comments = $em->getRepository('BlogBundle:Comments')->findAll($id);

        // si on est au moins utilisateur
        if (false === $this->get('security.context')->isGranted('ROLE_USER')) {
            // si y'a pas d'utilisateur c'est null
            $user = null;
        } else {
            // sinon on récupère le nom d'utilisateur
            $user = $this->container->get('security.context')->getToken()->getUser()->getUsername();
        }


        // On retourne les données sur la vue
        return $this->render('BlogBundle:Article:article.html.twig', array(
            'entities' => $entities,
            'comments' => $entities_comments,
            'id' => $id,
            'form' => $form->createView(),
            'user' => $user,
            'date' => date("Y-m-d H:i:s"),
        ));

    }
    /**
     * Creates a new Article entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Article();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setDate(new \DateTime('now'));
            $entity->setAuthor($this->getUser()->getUsername());

            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('article_show', array('id' => $entity->getId())));
        }

        return $this->render('BlogBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Article entity.
     *
     * @param Article $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('article_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Création', 'attr' => array(
            'class' => 'btn btn-success') ));

        return $form;
    }

    /**
     * Displays a form to create a new Article entity.
     *
     */
    public function newAction()
    {
        $entity = new Article();
        $form   = $this->createCreateForm($entity);

        return $this->render('BlogBundle:Article:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Article entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BlogBundle:Article:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Article entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BlogBundle:Article')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BlogBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Article entity.
    *
    * @param Article $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Article $entity)
    {
        $form = $this->createForm(new ArticleType(), $entity, array(
            'action' => $this->generateUrl('article_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        //$form->add('date', 'date', array('label' => 'Date de mise en ligne', 'attr' => array('class' => '')) );
        $form->add('submit', 'submit', array('label' => 'Mettre à jour', 'attr' => array(
            'class' => 'btn btn-success') ));

        return $form;
    }
    /**
     * Edits an existing Article entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('BlogBundle:Article')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Article entity.');
        }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $entity->setDate(new \DateTime('now'));
            $entity->setAuthor($this->getUser()->getUsername());
            $em->flush();
            return $this->redirect($this->generateUrl('article_edit', array('id' => $id)));
        }
        return $this->render('BlogBundle:Article:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Article entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BlogBundle:Article')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Article entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('article'));
    }

    /**
     * Creates a form to delete a Article entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('article_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('Supprimer', 'submit' ,array(
                'attr' => array(
                    'class' => 'btn btn-danger'
                )
            ))
            ->getForm()
        ;
    }
}
