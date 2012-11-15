<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Major.
 *
 * @ORM\Entity
 * @ORM\Table(name="majors")
 */
class Major
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
     * @var Requirement[]
     *
     * @ORM\OneToMany(targetEntity="Requirement", mappedBy="requirements")
     */
    protected $requirements;

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

    /**
     * @param $requirements
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    }

    /**
     * @return Requirement[]
     */
    public function getRequirements()
    {
        return $this->requirements;
    }
}