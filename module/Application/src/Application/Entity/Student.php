<?php

namespace Application\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var ArrayCollection
     * 
     * @ORM\ManyToMany(targetEntity="Course", inversedBy="students")
     * @ORM\JoinTable(name="students_courses")
     */
    protected $courses;

    /**
     * @var ArrayCollection
     *
     * @ManyToMany(targetEntity="Course", inversedBy="students")
     * @JoinTable(name="students_courses")
     */
    protected $courses;

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
    
    /**
     * Adds a course to this student instance
     */
    public function addCourse($aCourse)
    {
        $this->courses->add($aCourse);
                
    }
    
    /**
     * Removes a course from this student instance.
     */
    public function removeCourse()
    {
        
    }
    
    /**
     * 
     * @param type $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }
    
    /**
     * 
     * @return ArrayCollection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    /**
     * Adds the passed $course to courses
     *
     * @param Course $course
     */
    public function addCourse(Course $course)
    {
        $this->getCourses()->add($course);
    }

    /**
     * Removes the passed course from courses
     *
     * @param Course $course
     */
    public function removeCourse(Course $course)
    {
        $this->getCourses()->removeElement($course);
    }

    /**
     * @param $courses
     */
    public function setCourses($courses)
    {
        $this->courses = $courses;
    }

    /**
     * @return ArrayCollection
     */
    public function getCourses()
    {
        return $this->courses;
    }
}