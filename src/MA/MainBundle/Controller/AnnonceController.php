<?php

namespace MA\MainBundle\Controller;

use MA\MainBundle\Entity\Annonce;
use MA\MainBundle\Entity\Marque;
use MA\MainBundle\Entity\Places;
use MA\MainBundle\Service\AnnonceTools;
use MA\MainBundle\Service\FileUploader;
use MA\MainBundle\Service\Gallery;
use MA\MainBundle\Service\SendEmail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Annonce controller.
 *
 */
class AnnonceController extends Controller
{
    /**
     * Lists all annonce entities.
     *
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('MAMainBundle:Annonce')->findBy(array('user' => $user));
        
        return $this->render('MAMainBundle:Accueil:index.html.twig', array(
            'annonces' => $annonces,
        ));

    }

    /**
     * Creates a new annonce entity.
     *
     */
    public function newAction(Request $request, FileUploader $fileUploader, AnnonceTools $annonceTools)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        //dump($user->getAnnonces()->toArray());die();

        $annonce = new Annonce();
        $place = new Places();


        $form = $this->createForm('MA\MainBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            //dump($form->get('marque')->getData()->getName());die();
            //$marque = $annonceTools->mapToMarque($request, $form, $annonce);
            /*************** Upload images et set entité Places ********************/
            $annonceTools->hydratePlace($request, $form, $annonce, $user, $place);
            
            $annonce->setUser($user);
            $annonce->setPlace($place);
            $annonce->setMarque($form->get('marque')->getData()->getName());

            //$annonce->setMarque($marque);
            //$annonce->setMarque($marque);
            $place->setAnnonce($annonce);

            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->persist($place);
            //$em->persist($marque);
            $em->flush();


            return $this->redirectToRoute('annonce_show', array('id' => $annonce->getId()));
        }
        return $this->render('MAMainBundle:Annonce:new.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a annonce entity.
     *
     */
    public function showAction(Annonce $annonce, Gallery $gallery, Request $request, SendEmail $sendEmail)
    {
        $deleteForm = $this->createDeleteForm($annonce);
        $contactForm = $this->createForm('MA\MainBundle\Form\ContactType');

        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository('MAMainBundle:Marque')->findBy(array('id' => $annonce->getMarque()));
        $images = $gallery->createGallery($annonce->getId());

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            
            /******************************************************/
            /* ************** Contacter vendeur ***************** */
            /******************************************************/
            $sendEmail->contactSeller($contactForm, $annonce);
            $this->addFlash(
                'notice',
                'Votre message a été envoyé!'
            );

            return $this->redirectToRoute('annonce_show', array('id' => $annonce->getId()));
        }

        return $this->render('MAMainBundle:Annonce:show.html.twig', array(
            'marque' => $marque,
            'annonce' => $annonce,
            'images' => $images,
            'delete_form' => $deleteForm->createView(),
            'contact_form' => $contactForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     */
    public function editAction(Request $request, Annonce $annonce, Gallery $gallery, FileUploader $fileUploader, AnnonceTools $annonceTools)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $fileUploader->deleteAllImages($annonce);
        $deleteForm = $this->createDeleteForm($annonce);
        $editForm = $this->createForm('MA\MainBundle\Form\AnnonceType', $annonce);

        //dump($annonce);die();
        //$em = $this->getDoctrine()->getManager();
        //$marque = $em->getRepository('MAMainBundle:Marque')->findOneBy(array('id' => $annonce->getMarque()->getId()));
        //$id = $marque->getId();
        //$name = $marque->getName();

        
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {


            //$marque = $annonceTools->mapToMarque($request, $editForm, $annonce);
            //$em->getRepository('MAMainBundle:Marque')->updateMarque($id, $name);


            $fileUploader->editFiles($annonce, $user, $editForm);
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush();

            return $this->redirectToRoute('annonce_show', array('id' => $annonce->getId()));
        }


        return $this->render('MAMainBundle:Annonce:edit.html.twig', array(
            'annonce' => $annonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce entity.
     *
     */
    public function deleteAction(Request $request, Annonce $annonce, FileUploader $fileUploader)
    {
        $form = $this->createDeleteForm($annonce);
        $form->handleRequest($request);
        $fileUploader->deleteAllImages($annonce);
        
        //if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush();
        //}

        return $this->redirectToRoute('ma_user_accueil');
    }

    /**
     * Creates a form to delete a annonce entity.
     *
     * @param Annonce $annonce The annonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce $annonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annonce_delete', array('id' => $annonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
