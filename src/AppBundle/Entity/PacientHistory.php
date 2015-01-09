<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
     * @ORM\ManyToOne(targetEntity="Pacient", inversedBy="history", cascade={"persist"})
     **/
    private $pacient;

    /**
     * @var string
     *
     * @ORM\Column(name="disease", type="text")
     */
    private $disease;

    /**
     * @ORM\ManyToOne(targetEntity="Doctor", inversedBy="pacients", cascade={"persist"})
     **/
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set disease
     *
     * @param  string         $disease
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
     * @param  string         $therapy
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
     * @param  \DateTime      $created
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
     * @param  \DateTime      $deletedAt
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
     * Set pacient
     *
     * @param  \AppBundle\Entity\Pacient $pacient
     * @return PacientHistory
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
     * Set doctors
     *
     * @param  \AppBundle\Entity\Doctor $doctors
     * @return PacientHistory
     */
    public function setDoctors(\AppBundle\Entity\Doctor $doctors = null)
    {
        $this->doctors = $doctors;

        return $this;
    }

    /**
     * Get doctors
     *
     * @return \AppBundle\Entity\Doctor
     */
    public function getDoctors()
    {
        return $this->doctors;
    }
}
