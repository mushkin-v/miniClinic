<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * AppointmentTime
 *
 * @ORM\Table()
 * @ORM\Entity
 * @Gedmo\SoftDeleteable(fieldName="deletedAt", timeAware=false)
 */
class AppointmentTime
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
     * @ORM\OneToMany(targetEntity="Appointment", mappedBy="time")
     **/
    private $appointment;

    /**
     * @ORM\Column(name="from_time", type="time")
     */
    private $fromTime;

    /**
     * @ORM\Column(name="to_time", type="time")
     */
    private $toTime;

    /**
     * @ORM\OneToOne(targetEntity="Pacient", mappedBy="appointmentTime")
     **/
    private $pacient;

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
        $this->appointment = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fromTime
     *
     * @param \DateTime $fromTime
     * @return AppointmentTime
     */
    public function setFromTime($fromTime)
    {
        $this->fromTime = $fromTime;

        return $this;
    }

    /**
     * Get fromTime
     *
     * @return \DateTime 
     */
    public function getFromTime()
    {
        return $this->fromTime;
    }

    /**
     * Set toTime
     *
     * @param \DateTime $toTime
     * @return AppointmentTime
     */
    public function setToTime($toTime)
    {
        $this->toTime = $toTime;

        return $this;
    }

    /**
     * Get toTime
     *
     * @return \DateTime 
     */
    public function getToTime()
    {
        return $this->toTime;
    }

    /**
     * Add appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     * @return AppointmentTime
     */
    public function addAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment[] = $appointment;

        return $this;
    }

    /**
     * Remove appointment
     *
     * @param \AppBundle\Entity\Appointment $appointment
     */
    public function removeAppointment(\AppBundle\Entity\Appointment $appointment)
    {
        $this->appointment->removeElement($appointment);
    }

    /**
     * Get appointment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * Set pacient
     *
     * @param \AppBundle\Entity\Pacient $pacient
     * @return AppointmentTime
     */
    public function setPacient(\AppBundle\Entity\Pacient $pacient = null)
    {
        $this->pacient = $pacient;

        return $this;
    }

    /**
     * Get pacient
     *
     * @return \AppBundle\Entity\Pacient 
     */
    public function getPacient()
    {
        return $this->pacient;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return AppointmentTime
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
     * @return AppointmentTime
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