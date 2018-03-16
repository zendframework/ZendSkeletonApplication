<?php

namespace Application\Entity;

/**
 * Trait EntityTimeTrait
 *
 * @package Application\Entity
 */
trait EntityTimeTrait
{
    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime", nullable=false);
     */
    protected $created;

    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime", nullable=true);
     */
    protected $modified;

    /**
     * @return void
     *
     * @ORM\PrePersist
     */
    public function setCreated() : void
    {
        $this->created = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getCreated() : ?\DateTime
    {
        return $this->created;
    }

    /**
     * @return void
     *
     * @ORM\PreUpdate
     */
    public function setModified() : void
    {
        $this->modified = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getModified() : ?\DateTime
    {
        return $this->modified;
    }

}
