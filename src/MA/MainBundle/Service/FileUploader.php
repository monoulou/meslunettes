<?php

namespace MA\MainBundle\Service;

use MA\MainBundle\Entity\Annonce;
use MA\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    /*
     * Upload une image.
     */
    public function upload(UploadedFile $file, User $user)
    {
        
        $fileName = $user->getId().'_'.rand(1, 1000).'.'.$file->guessExtension();
        $file->move($this->getTargetDir(), $fileName);

        return $fileName;
    }
    
    /*
     * Effectue un upload des images si annonce editée.
     */
    public function editFiles(Annonce $annonce, User $user, FormInterface $editForm)
    {
        //Récupère l'image soumis au formulaire
        $imagePrincipale = $editForm->get('imagePrincipale')->getData();
        if (!empty($imagePrincipale))
        {
            //Effectue l'upload de l'image.
            $annonce->setImagePrincipale($this->upload($imagePrincipale, $user));
        }

        $imageBis = $editForm->get('imageBis')->getData();
        if (!empty($imageBis))
        {
            $annonce->setImageBis($this->upload($imageBis, $user));
        }

        $imageTer = $editForm->get('imageTer')->getData();
        if (!empty($imageTer))
        {
            $annonce->setImageTer($this->upload($imageTer, $user));
        }
    }
    
    /*
     * Supprime les images déjà liées à une Annonce
     * avant mise à jour.
     */
    public function deleteAllImages(Annonce $annonce)
    {
        $imagePrincipale = $annonce->getImagePrincipale();
        if (!empty($imagePrincipale))
        {
            $this->deleteOneImage($imagePrincipale);
        }
        
        $imageBis = $annonce->getImageBis();
        if (!empty($imageBis))
        {
            $this->deleteOneImage($imageBis);
        }
        
        $imageTer = $annonce->getImageTer();
        if (!empty($imageTer))
        {
            $this->deleteOneImage($imageTer);
        }
    }

    /*
     * Supprime l'image passée en paramètre
     */
    public function deleteOneImage($image)
    {
        $directory = scandir($this->getTargetDir());
        foreach ($directory as $index => $file)
        {
            if ($file != '.' && $file !='..')
            {
                if ($file == $image)
                {
                    unlink($this->getTargetDir().'/'.$file);
                }
            }
        }
    }

    public function getTargetDir()
    {
        return $this->targetDir;
    }
}