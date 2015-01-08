<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pacient
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Pacient
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AppointmentTime", inversedBy="pacient")
    **/
    private $appointmentTime;

    /**
     * @ORM\OneToMany(targetEntity="PacientHistory", mappedBy="pacient")
     **/
    private $history;

    /**
     * @var string
     *
     * @ORM\Column(name="card_number", type="string", length=255)
     */
    private $card_number;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 200,
     *      minMessage = "Wrong age, minimum {{ limit }} years",
     *      maxMessage = "Wrong age, maximum {{ limit }} years"
     * )
     */
    private $age;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="adress", type="string", length=255)
     */
    private $adress;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="deletedAt", type="datetime", nullable=true)
     */
    private $deletedAt;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set card_number
     *
     * @param string $cardNumber
     * @return Pacient
     */
    public function setCardNumber($cardNumber)
    {
        $this->card_number = $cardNumber;

        return $this;
    }

    /**
     * Get card_number
     *
     * @return string 
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Pacient
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Pacient
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Pacient
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set age
     *
     * @param integer $age
     * @return Pacient
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return integer 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Pacient
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Pacient
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Pacient
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
     * Set created
     *
     * @param \DateTime $created
     * @return Pacient
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return Pacient
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime 
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\user $user
     * @return Pacient
     */
    public function setUser(\AppBundle\Entity\user $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\user 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set appointmentTime
     *
     * @param \AppBundle\Entity\AppointmentTime $appointmentTime
     * @return Pacient
     */
    public function setAppointmentTime(\AppBundle\Entity\AppointmentTime $appointmentTime = null)
    {
        $this->appointmentTime = $appointmentTime;

        return $this;
    }

    /**
     * Get appointmentTime
     *
     * @return \AppBundle\Entity\AppointmentTime 
     */
    public function getAppointmentTime()
    {
        return $this->appointmentTime;
    }

    /**
     * Set history
     *
     * @param \AppBundle\Entity\PacientHistory $history
     * @return Pacient
     */
    public function setHistory(\AppBundle\Entity\PacientHistory $history = null)
    {
        $this->history = $history;

        return $this;
    }

    /**
     * Get history
     *
     * @return \AppBundle\Entity\PacientHistory 
     */
    public function getHistory()
    {
        return $this->history;
    }

    public function __toString()
    {
        return $this->getName().' '.$this->getLastname().' '.$this->getSurname();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->history = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add history
     *
     * @param \AppBundle\Entity\PacientHistory $history
     * @return Pacient
     */
    public function addHistory(\AppBundle\Entity\PacientHistory $history)
    {
        $this->history[] = $history;

        return $this;
    }

    /**
     * Remove history
     *
     * @param \AppBundle\Entity\PacientHistory $history
     */
    public function removeHistory(\AppBundle\Entity\PacientHistory $history)
    {
        $this->history->removeElement($history);
    }
}
