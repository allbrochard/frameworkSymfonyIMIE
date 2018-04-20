<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * class
 *
 * @ORM\Table(name="class")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\classRepository")
 */
class Classe
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
     * @var int
     *
     * @ORM\Column(name="vie", type="integer")
     */
    private $vie;

    /**
     * @var int
     *
     * @ORM\Column(name="degat", type="integer")
     */
    private $degat;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Perso",mappedBy="classe",cascade={"remove"})
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $persos;


    /**
     * Classe constructor
     */
    public function __construct()
    {
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
     * @return Classe
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
     * Set vie
     *
     * @param integer $vie
     *
     * @return Classe
     */
    public function setVie($vie)
    {
        $this->vie = $vie;

        return $this;
    }

    /**
     * Get vie
     *
     * @return int
     */
    public function getVie()
    {
        return $this->vie;
    }

    /**
     * Set degat
     *
     * @param integer $degat
     *
     * @return Classe
     */
    public function setDegat($degat)
    {
        $this->degat = $degat;

        return $this;
    }

    /**
     * Get degat
     *
     * @return int
     */
    public function getDegat()
    {
        return $this->degat;
    }

    /**
     * Add Perso
     *
     * @param \AppBundle\Entity\Perso $perso
     *
     * @return Classe
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

