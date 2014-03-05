<?php
namespace CASEBase\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfcUser\Entity\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User implements UserInterface
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;

    /**
     *
     * @var string @ORM\Column(type="string", unique=true, nullable=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", unique=true, nullable=false)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $display_name;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(type="smallint", options={"default" = 0})
     */
    protected $state = 0;
	/**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }

	/**
     * @param number $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

	/**
     * @return the $username
     */
    public function getUsername()
    {
        return $this->username;
    }

	/**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

	/**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
     * @param field_type $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

	/**
     * @return the $display_name
     */
    public function getDisplayName()
    {
        return $this->display_name;
    }

	/**
     * @param field_type $display_name
     */
    public function setDisplayName($display_name)
    {
        $this->display_name = $display_name;
    }

	/**
     * @return the $password
     */
    public function getPassword()
    {
        return $this->password;
    }

	/**
     * @param field_type $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

	/**
     * @return the $state
     */
    public function getState()
    {
        return $this->state;
    }

	/**
     * @param field_type $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }


    
    
}