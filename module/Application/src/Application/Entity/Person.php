<?php

namespace Application\Entity;

use ZfcUser\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Person.
 * Please see: http://docs.doctrine-project.org/en/2.0.x/reference/inheritance-mapping.html
 *
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="role", type="string")
 * @ORM\DiscriminatorMap({"student" = "Student", "professor" = "Professor", "administrator" = "Administrator"})
 * @ORM\Table(name="people")
 */
abstract class Person implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", name="id");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="username")
     */
    protected $username;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="password")
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="email")
     */
    protected $email;

    /**
     * @param int $id
     * @return \Application\Entity\Person|\ZfcUser\Entity\UserInterface
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     * @return \Application\Entity\Person
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        if (!$this->username) {
            // Can't be null - db constraint
            $this->username = '';
        }
        return $this->username;
    }

    /**
     * Set username.
     *
     * @param string $username
     * @return UserInterface
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email.
     *
     * @param string $email
     * @return UserInterface
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getName();
    }

    /**
     * Set displayName.
     *
     * @param string $displayName
     * @return UserInterface
     */
    public function setDisplayName($displayName)
    {
        $this->setName($displayName);
        return $this;
    }

    /**
     * Get password.
     *
     * @return string password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set password.
     *
     * @param string $password
     * @return UserInterface
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get state.
     *
     * @return int
     */
    public function getState()
    {
        // TODO: Implement getState() method.
    }

    /**
     * Set state.
     *
     * @param int $state
     * @return UserInterface
     */
    public function setState($state)
    {
        // TODO: Implement setState() method.
    }
}