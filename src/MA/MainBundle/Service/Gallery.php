<?php

namespace MA\MainBundle\Service;


use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use MA\MainBundle\Entity\Annonce;
use Sonata\CoreBundle\Model\ManagerInterface;


class Gallery
{
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }
    
    public function createGallery($annonce_id)
    {

        $gallery = array();
        $annonce = $this->em->getRepository('MAMainBundle:Annonce')->findOneBy(array('id' => $annonce_id));
       
        
        if($annonce->getImagePrincipale()!= null)
        {
            //$gallery['ImagePrincipale'] = $annonce->getImagePrincipale();
            array_push($gallery, $annonce->getImagePrincipale());
        }

        if($annonce->getImageBis()!= null)
        {
            //$gallery['ImageBis'] = $annonce->getImageBis();
            array_push($gallery, $annonce->getImageBis());
        }

        if($annonce->getImageTer()!= null)
        {
            //$gallery['ImageTer'] = $annonce->getImageTer();
            array_push($gallery, $annonce->getImageTer());
        }
        
        return $gallery;
    }
    
}