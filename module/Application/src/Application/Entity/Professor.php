<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Professor.
 *
 * @ORM\Entity
 * @ORM\Table(name="professors")
 */
class Professor extends Person
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="office_location")
     */
    protected $officeLocation;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="office_hours")
     */
    protected $officeHours;

    /**
     * @param string $officeHours
     */
    public function setOfficeHours($officeHours)
    {
        $this->officeHours = $officeHours;
    }

    /**
     * @return string
     */
    public function getOfficeHours()
    {
        return $this->officeHours;
    }

    /**
     * @param string $officeLocation
     */
    public function setOfficeLocation($officeLocation)
    {
        $this->officeLocation = $officeLocation;
    }

    /**
     * @return string
     */
    public function getOfficeLocation()
    {
        return $this->officeLocation;
    }
}