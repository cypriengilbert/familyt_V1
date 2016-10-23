<?php


namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use UserBundle\Entity\Famille;


/**
 * @ORM\Entity
 */
class User extends BaseUser
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")

   */
  protected $id;


 	/**
     * @var string
     *
     * @ORM\Column(name="adresse1", type="string", nullable=true)
     */
    private $adresse1;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse2", type="string", nullable=true)
     */
    private $adresse2;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse3", type="string", nullable=true)
     */
    private $adresse3;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", nullable=true)
     */
    private $phone;

    /**
     * @var date
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="phonefixe", type="string",  nullable=true)
     */
    private $phonefixe;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",  nullable=true)
     */
    private $image;

    /**
   * @ORM\ManyToMany(targetEntity="UserBundle\Entity\Famille", cascade={"persist"})
   * @ORM\JoinTable(name="user_famille",
   * joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
   * inverseJoinColumns={@ORM\JoinColumn(name="famille_id", referencedColumnName="id")})
   */
  private $famille;




    /**
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return User
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set adresse2
     *
     * @param string $adresse2
     *
     * @return User
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

      public function __construct(){
        $this->famille = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get adresse2
     *
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phonefixe
     *
     * @param string $phonefixe
     *
     * @return User
     */
    public function setPhonefixe($phonefixe)
    {
        $this->phonefixe = $phonefixe;

        return $this;
    }

    /**
     * Get phonefixe
     *
     * @return string
     */
    public function getPhonefixe()
    {
        return $this->phonefixe;
    }

    /**
     * Set adresse3
     *
     * @param string $adresse3
     *
     * @return User
     */
    public function setAdresse3($adresse3)
    {
        $this->adresse3 = $adresse3;

        return $this;
    }

    /**
     * Get adresse3
     *
     * @return string
     */
    public function getAdresse3()
    {
        return $this->adresse3;
    }

    /**
     * Add famille
     *
     * @param \UserBundle\Entity\Famille $famille
     *
     * @return User
     */
    public function addFamille(\UserBundle\Entity\Famille $famille)
    {
        $this->famille[] = $famille;

        return $this;
    }

    /**
     * Remove famille
     *
     * @param \UserBundle\Entity\Famille $famille
     */
    public function removeFamille(\UserBundle\Entity\Famille $famille)
    {
        $this->famille->removeElement($famille);
    }

    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return User
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
}
