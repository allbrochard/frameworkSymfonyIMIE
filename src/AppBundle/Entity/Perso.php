<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * perso
 *
 * @ORM\Table(name="perso")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\persoRepository")
 */
class Perso
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="persos")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe",inversedBy="persos")
     */
    private $classe;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message",mappedBy="perso",cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $messages;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Classe",inversedBy="persos")
     */
    private $partie;

    /**
     * Perso constructor
     */
    public function __construct()
    {
        $this->messages = new ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return perso
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return perso
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param Classe $classe
     *
     * @return perso
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get user
     *
     * @return Classe
     */
    public function getclasse()
    {
        return $this->classe;
    }

    /**
     * Set partie
     *
     * @param Partie $partie
     *
     * @return perso
     */
    public function setpartie($partie)
    {
        $this->partie = $partie;

        return $this;
    }

    /**
     * Get partie
     *
     * @return Partie
     */
    public function getpartie()
    {
        return $this->partie;
    }

    /**
     * Add Message
     *
     * @param \AppBundle\Entity\Message $message
     *
     * @return Perso
     */
    public function addMessage(Message $message)
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * Remove Message
     *
     * @param \AppBundle\Entity\Message $message
     */
    public function removeMessage(Message $message)
    {
        $this->messages->removeElement($message);
    }

    /**
     *
     * @return ArrayCollection/Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

}

