<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A Section.
 *
 * @ORM\Entity
 * @ORM\Table(name="section")
 */
class Section
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
     * @ORM\Column(type="date", name="startDate")
     */
    protected $startDate;

    /**
     * @var string
     *
     * @ORM\Column(type="date", name="stopDate")
     */
    protected $stopDate;

    /**
     * @var string
     *
     * @ORM\Column(type="time", name="startTime")
     */
    protected $startTime;

    /**
     * @var string
     *
     * @ORM\Column(type="time", name="stopTime")
     */
    protected $stopTime;

    /**
     * @var string
     *
     * @ORM\Column(type="array", name="daysOfWeek")
     */
    protected $daysOfWeek;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", name="seats")
     */
    protected $seats;

    /**
     * @ORM\ManyToOne(targetEntity="Professor", inversedBy="sections")
     * @ORM\JoinColumn(name="professor_id", referencedColumnName="id")
     */
    protected $building;

    /**
     * @ORM\ManyToMany(targetEntity="Student", inversedBy="sections")
     * @ORM\JoinTable(name="students_sections")
     */
    protected $students;
}
