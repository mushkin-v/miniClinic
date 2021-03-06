<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Doctor
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Doctor
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
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="doctor")
     **/
    private $appointments;

    /**
     * @ORM\OneToMany(targetEntity="PacientHistory", mappedBy="doctors")
     **/
    private $pacients;

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
     * @var integer
     *
     * @ORM\Column(name="age", type="integer")
     * @Assert\Range(
     *      min = 0,
     *      max = 200,
     *      minMessage = "Minimum {{ limit }}",
     *      maxMessage = "Maximum {{ limit }}"
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
     * @var string
     *
     * @ORM\Column(name="job_title", type="text")
     */
    private $job_title;

    /**
     * @var string
     *
     * @ORM\Column(name="other_info", type="text", nullable=true)
     */
    private $other_info;

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
     * @ORM\OneToOne(targetEntity="user")
     */
    private $user;

    public function __toString()
    {
        return $this->getName().' '.$this->getLastname().' '.$this->getSurname();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->appointments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->pacients = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @param  string $cardNumber
     * @return Doctor
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
     * @param  string $name
     * @return Doctor
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
     * @param  string $lastname
     * @return Doctor
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
     * @param  string $surname
     * @return Doctor
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
     * @param  integer $age
     * @return Doctor
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
     * @param  string $adress
     * @return Doctor
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
     * @param  string $phone
     * @return Doctor
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
     * @param  string $email
     * @return Doctor
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
     * Set job_title
     *
     * @param  string $jobTitle
     * @return Doctor
     */
    public function setJobTitle($jobTitle)
    {
        $this->job_title = $jobTitle;

        return $this;
    }

    /**
     * Get job_title
     *
     * @return string
     */
    public function getJobTitle()
    {
        return $this->job_title;
    }

    /**
     * Set other_info
     *
     * @param  string $otherInfo
     * @return Doctor
     */
    public function setOtherInfo($otherInfo)
    {
        $this->other_info = $otherInfo;

        return $this;
    }

    /**
     * Get other_info
     *
     * @return string
     */
    public function getOtherInfo()
    {
        return $this->other_info;
    }

    /**
     * Set created
     *
     * @param  \DateTime $created
     * @return Doctor
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
     * @param  \DateTime $deletedAt
     * @return Doctor
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
     * Add appointments
     *
     * @param  \AppBundle\Entity\Appointment $appointments
     * @return Doctor
     */
    public function addAppointment(\AppBundle\Entity\Appointment $appointments)
    {
        $this->appointments[] = $appointments;

        return $this;
    }

    /**
     * Remove appointments
     *
     * @param \AppBundle\Entity\Appointment $appointments
     */
    public function removeAppointment(\AppBundle\Entity\Appointment $appointments)
    {
        $this->appointments->removeElement($appointments);
    }

    /**
     * Get appointments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAppointments()
    {
        return $this->appointments;
    }

    /**
     * Add pacients
     *
     * @param  \AppBundle\Entity\PacientHistory $pacients
     * @return Doctor
     */
    public function addPacient(\AppBundle\Entity\PacientHistory $pacients)
    {
        $this->pacients[] = $pacients;

        return $this;
    }

    /**
     * Remove pacients
     *
     * @param \AppBundle\Entity\PacientHistory $pacients
     */
    public function removePacient(\AppBundle\Entity\PacientHistory $pacients)
    {
        $this->pacients->removeElement($pacients);
    }

    /**
     * Get pacients
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPacients()
    {
        return $this->pacients;
    }

    /**
     * Set user
     *
     * @param  \AppBundle\Entity\user $user
     * @return Doctor
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
}
