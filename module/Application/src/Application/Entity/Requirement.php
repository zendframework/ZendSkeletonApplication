<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Requirement.
 *
 * @ORM\Entity
 * @ORM\Table(name="requirements")
 */
class Requirement
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
     * @var Major
     *
     * @ORM\ManyToOne(targetEntity="Major", inversedBy="requirements")
     * @ORM\JoinColumn(name="major_id", referencedColumnName="id")
     */
    protected $major;

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
     * @param $major
     */
    public function setMajor($major)
    {
        $this->major = $major;
    }

    /**
     * @return Major
     */
    public function getMajor()
    {
        return $this->major;
    }
}