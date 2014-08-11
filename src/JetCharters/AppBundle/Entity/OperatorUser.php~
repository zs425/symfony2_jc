<?php

namespace JetCharters\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;

use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Entity
* @ORM\HasLifecycleCallbacks()
* @ORM\Table(name="operator_users")
* @UniqueEntity(fields = "username", targetClass = "JetCharters\AppBundle\Entity\User", message="fos_user.username.already_used")
* @UniqueEntity(fields = "email", targetClass = "JetCharters\AppBundle\Entity\User", message="fos_user.email.already_used")
*/

class OperatorUser extends User
{

    /**
* @ORM\ManyToOne(targetEntity="Operator", inversedBy="users")
*/
    protected $operator;

    /**
* @var string
*
* @ORM\Column(name="position", type="string", length=255, nullable=true)
*/
    protected $position;

    /**
* @ORM\PrePersist
*/
    public function setRoleValue()
    {
        $this->addRole('ROLE_OPERATOR');
    }
    /**
* @var integer
*/
    protected $id;

    /**
* @var string
* @Assert\NotBlank(message="Please, enter your first name.", groups={"registration"})
*/
    protected $firstName;

    /**
* @var string
* @Assert\NotBlank(message="Please, enter your last name.", groups={"registration"})
*/
    protected $lastName;

    /**
* @var string
* @Assert\NotBlank(message="Please, enter your street address.", groups={"registration"})
*/
    protected $address1;

    /**
* @var string
*/
    protected $address2;

    /**
* @var string
* @Assert\NotBlank(message="Please, enter your city.", groups={"registration"})
*/
    protected $city;

    /**
* @var string
* @Assert\NotBlank(message="Please, enter your state.", groups={"registration"})
*/
    protected $state;

    /**
* @var string
* @Assert\NotBlank(message="Please, select your country.", groups={"registration"})
*/
    protected $country;

    /**
* @var string
* @Assert\NotBlank(message="Zip Code is invalid.", groups={"registration"})
*/
    protected $zip;

    /**
* @var string
* @Assert\NotBlank(message="Phone number is invalid.", groups={"registration"})
*/
    protected $phone;


    /**
* Set position
*
* @param string $position
* @return OperatorUser
*/
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
* Get position
*
* @return string
*/
    public function getPosition()
    {
        return $this->position;
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
* Set firstName
*
* @param string $firstName
* @return OperatorUser
*/
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
* Get firstName
*
* @return string
*/
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
* Set lastName
*
* @param string $lastName
* @return OperatorUser
*/
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
* Get lastName
*
* @return string
*/
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
* Set address1
*
* @param string $address1
* @return OperatorUser
*/
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
* Get address1
*
* @return string
*/
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
* Set address2
*
* @param string $address2
* @return OperatorUser
*/
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
* Get address2
*
* @return string
*/
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
* Set city
*
* @param string $city
* @return OperatorUser
*/
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
* Get city
*
* @return string
*/
    public function getCity()
    {
        return $this->city;
    }

    /**
* Set state
*
* @param string $state
* @return OperatorUser
*/
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
* Get state
*
* @return string
*/
    public function getState()
    {
        return $this->state;
    }

    /**
* Set country
*
* @param string $country
* @return OperatorUser
*/
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
* Get country
*
* @return string
*/
    public function getCountry()
    {
        return $this->country;
    }

    /**
* Set zip
*
* @param string $zip
* @return OperatorUser
*/
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
* Get zip
*
* @return string
*/
    public function getZip()
    {
        return $this->zip;
    }

    /**
* Set phone
*
* @param string $phone
* @return OperatorUser
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
* Set operator
*
* @param \JetCharters\AppBundle\Entity\Operator $operator
* @return OperatorUser
*/
    public function setOperator(\JetCharters\AppBundle\Entity\Operator $operator = null)
    {
        $this->operator = $operator;

        return $this;
    }

    /**
* Get operator
*
* @return \JetCharters\AppBundle\Entity\Operator
*/
    public function getOperator()
    {
        return $this->operator;
    }
}
