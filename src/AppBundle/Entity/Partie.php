<?php

namespace AppBundle\Entity;

use AppBundle\Repository\PartieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * partie
 *
 * @ORM\Table(name="partie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\partieRepository")
 */
class Partie
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Perso",mappedBy="partie")
     */
    private $persos;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Message",mappedBy="partie", cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $messages;

    /**
     * Partie constructor
     */
    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->persos = new ArrayCollection();
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
     * @return partie
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
     * Add Message
     *
     * @param \AppBundle\Entity\Message $message
     *
     * @return Partie
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
     * Add Perso
     *
     * @param \AppBundle\Entity\Perso $perso
     *
     * @return Partie
     */
    public function addPerso(Perso $perso)
    {
        $this->persos[] = $perso;

        return $this;
    }

    /**
     * Remove Perso
     *
     * @param \AppBundle\Entity\Perso $perso
     */
    public function removePerso(Perso $perso)
    {
        $this->persos->removeElement($perso);
    }

    /**
     *
     * @return ArrayCollection/Perso[]
     */
    public function getPersos()
    {
        return $this->persos;
    }
}

