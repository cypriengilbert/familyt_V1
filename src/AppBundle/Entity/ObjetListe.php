<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ObjetListe
 *
 * @ORM\Table(name="objet_liste")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ObjetListeRepository")
 */
class ObjetListe
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
     * @var int
     *
     * @ORM\Column(name="annee", type="integer")
     */
    private $annee;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=5000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=5000, nullable=true)
     */
    private $commentaire;

     /**
     * @var boolean
     *
     * @ORM\Column(name="pris", type="boolean")
     */
    private $pris;


  

  /**
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
   * @ORM\JoinColumn(nullable=false)
   */
  private $User;


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
     * Set annee
     *
     * @param integer $annee
     *
     * @return ObjetListe
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return int
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ObjetListe
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
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return ObjetListe
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return ObjetListe
     */
    public function setUser(\UserBundle\Entity\User $user)
    {
        $this->User = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->User;
    }

    /**
     * Set pris
     *
     * @param boolean $pris
     *
     * @return ObjetListe
     */
    public function setPris($pris)
    {
        $this->pris = $pris;

        return $this;
    }

    /**
     * Get pris
     *
     * @return boolean
     */
    public function getPris()
    {
        return $this->pris;
    }
}
