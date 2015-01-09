<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\ManyToOne(targetEntity="Appointment", inversedBy="time")
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
     * @ORM\ManyToOne(targetEntity="Pacient", inversedBy="appointmentTime")
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
     * @param  \DateTime       $fromTime
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
     * @param  \DateTime       $toTime
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
     * Set created
     *
     * @param  \DateTime       $created
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
     * @param  \DateTime       $deletedAt
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

    /**
     * Set appointment
     *
     * @param  \AppBundle\Entity\Appointment $appointment
     * @return AppointmentTime
     */
    public function setAppointment(\AppBundle\Entity\Appointment $appointment = null)
    {
        $this->appointment = $appointment;

        return $this;
    }

    /**
     * Get appointment
     *
     * @return \AppBundle\Entity\Appointment
     */
    public function getAppointment()
    {
        return $this->appointment;
    }

    /**
     * Set pacient
     *
     * @param  \AppBundle\Entity\Pacient $pacient
     * @return AppointmentTime
     */
    public function setPacient(\AppBundle\Entity\Pacient $pacient = null)
    {
        $this->pacient = $pacient;

        return $this;
    }

    /**
     * remove pacient
     *
     * @return AppointmentTime
     */
    public function removePacient()
    {
        $this->pacient = null;

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
}
