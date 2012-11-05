<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Person.
 * Please see: http://docs.doctrine-project.org/en/2.0.x/reference/inheritance-mapping.html
 *
 * @ORM\Entity
 * @ORM\InheritanceType("Joined")
 * @ORM\DiscriminatorColumn(name="role", type="string")
 * @ORM\DiscriminatorMap({"student" = "Student", "professor" = "Professor"})
 * @ORM\Table(name="people")
 */
class Person
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}