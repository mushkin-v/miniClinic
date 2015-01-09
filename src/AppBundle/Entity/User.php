<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 *  * @UniqueEntity("card_number")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     * @ORM\Column(name="is_doctor", type="boolean")
     */
    protected $isDoctor = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="card_number", type="integer", unique=true)
     *
     * @Assert\NotBlank()
     *
     * @Assert\Range(
     *      min = 0,
     *      max = 9999,
     *      minMessage = "Your card number must be minimum {{ limit }} ",
     *      maxMessage = "Your card number must be maximum {{ limit }} "
     * )
     */
    private $card_number = 0;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * @param  integer $cardNumber
     * @return User
     */
    public function setCardNumber($cardNumber)
    {
        $this->card_number = $cardNumber;

        return $this;
    }

    /**
     * Get card_number
     *
     * @return integer
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * Set isDoctor
     *
     * @param  boolean $isDoctor
     * @return User
     */
    public function setIsDoctor($isDoctor)
    {
        $this->isDoctor = $isDoctor;

        return $this;
    }

    /**
     * Get isDoctor
     *
     * @return boolean
     */
    public function getIsDoctor()
    {
        return $this->isDoctor;
    }
}
