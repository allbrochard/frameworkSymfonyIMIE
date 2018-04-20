<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\messageRepository")
 */
class Message
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
     * @ORM\Column(name="texte", type="string", length=255)
     */
    private $texte;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Perso",inversedBy="messages")
     */
    private $perso;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Partie",inversedBy="messages")
     */
    private $partie;

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
     * Set texte
     *
     * @param string $texte
     *
     * @return message
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return message
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set perso
     *
     * @param Perso $perso
     *
     * @return message
     */
    public function setPerso($perso)
    {
        $this->perso = $perso;

        return $this;
    }

    /**
     * Get perso
     *
     * @return Perso
     */
    public function getPerso()
    {
        return $this->perso;
    }

    /**
     * Set partie
     *
     * @param Partie $partie
     *
     * @return message
     */
    public function setPartie($partie)
    {
        $this->partie = $partie;

        return $this;
    }

    /**
     * Get partie
     *
     * @return Partie
     */
    public function getPartie()
    {
        return $this->partie;
    }
}

