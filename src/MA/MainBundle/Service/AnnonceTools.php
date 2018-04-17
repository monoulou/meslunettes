<?php

namespace MA\MainBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use MA\MainBundle\Entity\Annonce;
use MA\MainBundle\Entity\Places;
use MA\MainBundle\Form\AnnonceType;
use MA\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class AnnonceTools extends Controller
{

    private $fileUpload;

    private $em;


    public function __construct(FileUploader $fileUploader, ObjectManager $objectManager)
    {

        $this->fileUpload = $fileUploader;
        $this->em = $objectManager;
    }

    public function hydratePlace(Request $request, FormInterface $form, Annonce $annonce, User $user, Places $places )
    {
        /* **********************************************************************/
        /* *******Vérification si données non vides et upload de l'image*********/
        /* **********************************************************************/
        if (!empty($form->get('imagePrincipale')->getData()))
        {
            $imgPrincipale = $annonce->getImagePrincipale();
            $fileName1 = $this->fileUpload->upload($imgPrincipale, $user);
            $annonce->setImagePrincipale($fileName1);
        }

        if (!empty($form->get('imageBis')->getData()))
        {
            $imgBis = $annonce->getImageBis();
            $fileName2 = $this->fileUpload->upload($imgBis, $user);
            $annonce->setImageBis($fileName2);
        }

        if (!empty($form->get('imageTer')->getData()))
        {
            $imgTer = $annonce->getImageTer();
            $fileName3 = $this->fileUpload->upload($imgTer, $user);
            $annonce->setImageTer($fileName3);
        }

        /* **********************************************************************/
        /* ******* Set les attributs de l'entité Places *************************/
        /* **********************************************************************/
        $places->setAdress($form->get('place')->get('adress')->getData());
        $places->setStreetNumber($form->get('place')->get('street_number')->getData());
        $places->setRoute($form->get('place')->get('route')->getData());
        $places->setLocality($form->get('place')->get('locality')->getData());
        $places->setCountry($form->get('place')->get('country')->getData());
        $places->setAdministrativeAreaLevel1($form->get('place')->get('administrative_area_level_1')->getData());
        $places->setPostalCode($form->get('place')->get('postal_code')->getData());
        
    }
    
    public function mapToMarque(Request $request, FormInterface $form)
    {
        $idMarque = $form->get('marque')->getData()->getName()->getId();
        $marque = $this->em->getRepository('MAMainBundle:Marque')->findOneBy(array('id' => $idMarque));

        return $marque;
    }

}