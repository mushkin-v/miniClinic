<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PacientHistory
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class PacientHistory
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
     * @ORM\OneToMany(targetEntity="Pacient", mappedBy="history")
     **/
    private $pacient;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="disease", type="text")
     */
    private $disease;

    /**
     * @ORM\ManyToMany(targetEntity="Doctor", mappedBy="pacients")
     *
     */
    private $doctors;

    /**
     * @var string
     *
     * @ORM\Column(name="therapy", type="text")
     */
    private $therapy;

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
     * Constructor
     */
    public function __construct()
    {
        $this->pacient = new \Doctrine\Common\Collections\ArrayCollection();
        $this->doctors = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set date
     *
     * @param \DateTime $date
     * @return PacientHistory
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
     * Set disease
     *
     * @param string $disease
     * @return PacientHistory
     */
    public function setDisease($disease)
    {
        $this->disease = $disease;

        return $this;
    }

    /**
     * Get disease
     *
     * @return string 
     */
    public function getDisease()
    {
        return $this->disease;
    }

    /**
     * Set therapy
     *
     * @param string $therapy
     * @return PacientHistory
     */
    public function setTherapy($therapy)
    {
        $this->therapy = $therapy;

        return $this;
    }

    /**
     * Get therapy
     *
     * @return string 
     */
    public function getTherapy()
    {
        return $this->therapy;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return PacientHistory
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
     * @return PacientHistory
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
     * Add pacient
     *
     * @param \AppBundle\Entity\Pacient $pacient
     * @return PacientHistory
     */
    public function addPacient(\AppBundle\Entity\Pacient $pacient)
    {
        $this->pacient[] = $pacient;

        return $this;
    }

    /**
     * Remove pacient
     *
     * @param \AppBundle\Entity\Pacient $pacient
     */
    public function removePacient(\AppBundle\Entity\Pacient $pacient)
    {
        $this->pacient->removeElement($pacient);
    }

    /**
     * Get pacient
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPacient()
    {
        return $this->pacient;
    }

    /**
     * Add doctors
     *
     * @param \AppBundle\Entity\Doctor $doctors
     * @return PacientHistory
     */
    public function addDoctor(\AppBundle\Entity\Doctor $doctors)
    {
        $this->doctors[] = $doctors;

        return $this;
    }

    /**
     * Remove doctors
     *
     * @param \AppBundle\Entity\Doctor $doctors
     */
    public function removeDoctor(\AppBundle\Entity\Doctor $doctors)
    {
        $this->doctors->removeElement($doctors);
    }

    /**
     * Get doctors
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDoctors()
    {
        return $this->doctors;
    }
}
