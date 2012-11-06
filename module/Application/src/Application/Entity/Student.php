<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Student.
 *
 * @ORM\Entity
 * @ORM\Table(name="students")
 */
class Student extends Person
{
    /**
     * @ORM\ManyToOne(targetEntity="Major")
     * @ORM\JoinColumn(name="major", referencedColumnName="id")
     */
    protected $major;

    /**
     * @param Major $major
     */
    public function setMajor(Major $major)
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