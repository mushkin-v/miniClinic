<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Appointment
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class Appointment
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
     * @ORM\ManyToOne(targetEntity="AppointmentTime", inversedBy="appointment")
     **/
    private $time;

    /**
     * @ORM\OneToMany(targetEntity="Doctor", mappedBy="appointments")
     **/
    private $doctors;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

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
     * @return Appointment
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
     * Set time
     *
     * @param \AppBundle\Entity\AppointmentTime $time
     * @return Appointment
     */
    public function setTime(\AppBundle\Entity\AppointmentTime $time = null)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \AppBundle\Entity\AppointmentTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Add doctors
     *
     * @param \AppBundle\Entity\Doctor $doctors
     * @return Appointment
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

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Appointment
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
     * @return Appointment
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
}
