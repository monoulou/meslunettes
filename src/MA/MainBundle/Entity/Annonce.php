<?php

namespace MA\MainBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * Annonce
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 * @ORM\Table(name="annonce")
 * @ORM\Entity(repositoryClass="MA\MainBundle\Repository\AnnonceRepository")
 */
class Annonce
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

    /**
     * @var string
     *
     * @ORM\Column(name="modele", type="string", length=255)
     */
    private $modele;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="imagePrincipale", type="string", length=255)
     */
    private $imagePrincipale;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imageBis", type="string", length=255, nullable=true)
     */
    private $imageBis;
    

    /**
     * @var string
     *
     * @ORM\Column(name="imageTer", type="string", length=255, nullable=true)
     */
    private $imageTer;

    /**
     * @ORM\ManyToOne(targetEntity="MA\UserBundle\Entity\User", inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Une annonce pour une adresse.
     * @ORM\OneToOne(targetEntity="Places", mappedBy="annonce", cascade={"persist"})
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     */
    private $place;

    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;


    public function __construct() {
        $this->dateCreation = new \DateTime;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set modele
     *
     * @param string $modele
     *
     * @return Annonce
     */
    public function setModele($modele)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return string
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Annonce
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return Annonce
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Annonce
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Annonce
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Annonce
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Annonce
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Annonce
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }
    

    /**
     * Set imagePrincipale
     *
     * @param string $imagePrincipale
     *
     * @return Annonce
     */
    public function setImagePrincipale($imagePrincipale)
    {
        $this->imagePrincipale = $imagePrincipale;

        return $this;
    }

    /**
     * Get imagePrincipale
     *
     * @return string
     */
    public function getImagePrincipale()
    {
        return $this->imagePrincipale;
    }

    /**
     * Set imageBis
     *
     * @param string $imageBis
     *
     * @return Annonce
     */
    public function setImageBis($imageBis)
    {
        $this->imageBis = $imageBis;

        return $this;
    }

    /**
     * Get imageBis
     *
     * @return string
     */
    public function getImageBis()
    {
        return $this->imageBis;
    }

    /**
     * Set imageTer
     *
     * @param string $imageTer
     *
     * @return Annonce
     */
    public function setImageTer($imageTer)
    {
        $this->imageTer = $imageTer;

        return $this;
    }

    /**
     * Get imageTer
     *
     * @return string
     */
    public function getImageTer()
    {
        return $this->imageTer;
    }

    /**
     * Set user
     *
     * @param \MA\UserBundle\Entity\User $user
     *
     * @return Annonce
     */
    public function setUser(\MA\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \MA\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set place
     *
     * @param \MA\MainBundle\Entity\Places $place
     *
     * @return Annonce
     */
    public function setPlace(\MA\MainBundle\Entity\Places $place = null)
    {
        $this->place = $place;

        return $this;
    }
    
    /**
     * Get place
     *
     * @return \MA\MainBundle\Entity\Places
     */
    public function getPlace()
    {
        return $this->place;
    }
    

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Annonce
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }
}
