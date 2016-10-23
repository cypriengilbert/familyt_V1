<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Depense
 *
 * @ORM\Table(name="depense")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepenseRepository")
 */
class Depense
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
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Famille")
   * @ORM\JoinColumn(nullable=false)
   */
  private $pour;

   /**
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Famille")
   * @ORM\JoinColumn(nullable=false)
   */
  private $par;


   /**
   * @ORM\ManyToOne(targetEntity="UserBundle\Entity\Famille")
   * @ORM\JoinColumn(nullable=true)
   */
  private $concerne;


   /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

     /**
     * @var datetime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;


     /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;

     /**
     * @var string
     *
     * @ORM\Column(name="type", type="string")
     */
    private $type;

    




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
     * Set par
     *
     * @param string $par
     *
     * @return Depense
     */
    public function setPar($par)
    {
        $this->par = $par;

        return $this;
    }

    /**
     * Get par
     *
     * @return string
     */
    public function getPar()
    {
        return $this->par;
    }

    /**
     * Set pour
     *
     * @param string $pour
     *
     * @return Depense
     */
    public function setPour($pour)
    {
        $this->pour = $pour;

        return $this;
    }

    /**
     * Get pour
     *
     * @return string
     */
    public function getPour()
    {
        return $this->pour;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Depense
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
     * Set montant
     *
     * @param float $montant
     *
     * @return Depense
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Depense
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
     * Set type
     *
     * @param string $type
     *
     * @return Depense
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set concerne
     *
     * @param \UserBundle\Entity\Famille $concerne
     *
     * @return Depense
     */
    public function setConcerne(\UserBundle\Entity\Famille $concerne = null)
    {
        $this->concerne = $concerne;

        return $this;
    }

    /**
     * Get concerne
     *
     * @return \UserBundle\Entity\Famille
     */
    public function getConcerne()
    {
        return $this->concerne;
    }
}
