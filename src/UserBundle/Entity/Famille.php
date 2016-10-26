<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Famille
 *
 * @ORM\Table(name="famille")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\FamilleRepository")
 */
class Famille
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
     * @var float
     *
     * @ORM\Column(name="coef", type="float")
     */
    private $coef;

     /**
     * @var float
     *
     * @ORM\Column(name="coefOetT", type="float")
     */
    private $coefOetT;

 /**
     * @var float
     *
     * @ORM\Column(name="coefRemb", type="float")
     */
    private $coefRemb;
    /**
     * @var float
     *
     * @ORM\Column(name="coef_2", type="float")
     */
    private $coef_2;

    /**
     * @var integer
     *
     * @ORM\Column(name="pater", type="integer")
     */
    private $pater;




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
     * @return Famille
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
     * Set membre
     *
     * @param \UserBundle\Entity\User $membre
     *
     * @return Famille
     */
    public function setMembre(\UserBundle\Entity\User $membre)
    {
        $this->membre = $membre;

        return $this;
    }

    /**
     * Get membre
     *
     * @return \UserBundle\Entity\User
     */
    public function getMembre()
    {
        return $this->membre;
    }

    /**
     * Set coef
     *
     * @param float $coef
     *
     * @return Famille
     */
    public function setCoef($coef)
    {
        $this->coef = $coef;

        return $this;
    }

    /**
     * Get coef
     *
     * @return float
     */
    public function getCoef()
    {
        return $this->coef;
    }

    /**
     * Set coefOetT
     *
     * @param float $coefOetT
     *
     * @return Famille
     */
    public function setCoefOetT($coefOetT)
    {
        $this->coefOetT = $coefOetT;

        return $this;
    }

    /**
     * Get coefOetT
     *
     * @return float
     */
    public function getCoefOetT()
    {
        return $this->coefOetT;
    }

    /**
     * Set coefRemb
     *
     * @param float $coefRemb
     *
     * @return Famille
     */
    public function setCoefRemb($coefRemb)
    {
        $this->coefRemb = $coefRemb;

        return $this;
    }

    /**
     * Get coefRemb
     *
     * @return float
     */
    public function getCoefRemb()
    {
        return $this->coefRemb;
    }

    /**
     * Set coef2
     *
     * @param float $coef2
     *
     * @return Famille
     */
    public function setCoef2($coef2)
    {
        $this->coef_2 = $coef2;

        return $this;
    }

    /**
     * Get coef2
     *
     * @return float
     */
    public function getCoef2()
    {
        return $this->coef_2;
    }



    /**
     * Set pater
     *
     * @param integer $pater
     *
     * @return Famille
     */
    public function setPater($pater)
    {
        $this->pater = $pater;

        return $this;
    }

    /**
     * Get pater
     *
     * @return integer
     */
    public function getPater()
    {
        return $this->pater;
    }
}
