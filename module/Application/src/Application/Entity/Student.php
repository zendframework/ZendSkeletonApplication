<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Student.
 *
 * @ORM\Entity
 * @ORM\Table(name="students")
 */
class Student
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="major")
     */
    protected $major;

    /**
     * @param string $major
     */
    public function setMajor($major)
    {
        $this->major = $major;
    }

    /**
     * @return string
     */
    public function getMajor()
    {
        return $this->major;
    }
}