<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
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
     * @var integer
     *
     * @ORM\Column(name="card_number", type="integer")
     *
     * @Assert\Range(
     *      min = 1000,
     *      max = 9999,
     *      minMessage = "Your card number must be minimum {{ limit }} ",
     *      maxMessage = "Your card number must be maximum {{ limit }} "
     * )
     */
    private $card_number;

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
     * @param integer $cardNumber
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
}
