<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\OneToMany(targetEntity="AppointmentTime", mappedBy="appointment", cascade={"persist"})
     **/
    private $time;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="appointments")
     **/
    private $doctor;

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
        $this->date = new \DateTime('NOW');
        $this->time = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @param  \DateTime   $date
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
     * Set created
     *
     * @param  \DateTime   $created
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
     * @param  \DateTime   $deletedAt
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

    /**
     * Add time
     *
     * @param  \AppBundle\Entity\AppointmentTime $time
     * @return Appointment
     */
    public function addTime(\AppBundle\Entity\AppointmentTime $time)
    {
        $this->time[] = $time;

        $time->setAppointment($this);

        return $this;
    }

    /**
     * Remove time
     *
     * @param \AppBundle\Entity\AppointmentTime $time
     */
    public function removeTime(\AppBundle\Entity\AppointmentTime $time)
    {
        $this->time->removeElement($time);
    }

    /**
     * Get time
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set doctor
     *
     * @param  \AppBundle\Entity\Doctor $doctor
     * @return Appointment
     */
    public function setDoctor(\AppBundle\Entity\Doctor $doctor = null)
    {
        $this->doctor = $doctor;

        return $this;
    }

    /**
     * Get doctor
     *
     * @return \AppBundle\Entity\Doctor
     */
    public function getDoctor()
    {
        return $this->doctor;
    }
}
