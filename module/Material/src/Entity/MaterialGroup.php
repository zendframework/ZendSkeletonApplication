<?php

namespace Material\Entity;

use Application\Entity\EntityTimeTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="material_groups")
 */
class MaterialGroup
{

    use EntityTimeTrait;

    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=64, nullable=TRUE)
     */
    protected $name;

    /**
     * @var \Material\Entity\MaterialGroup
     *
     * @ORM\ManyToOne(targetEntity="Material\Entity\MaterialGroup", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @var \Material\Entity\MaterialGroup[]|\Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Material\Entity\MaterialGroup", mappedBy="parent", cascade={"persist", "remove"})
     */
    protected $children;

    /**
     * @var \Material\Entity\Material[]|\Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Material\Entity\Material", mappedBy="materialGroup", cascade={"persist", "remove"})
     */
    protected $materials;

    /**
     * MaterialGroup constructor.
     */
    public function __construct()
    {
        $this->children  = new ArrayCollection();
        $this->materials = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return MaterialGroup|null
     */
    public function getParent(): ?MaterialGroup
    {
        return $this->parent;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|MaterialGroup[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param null|MaterialGroup $parent
     */
    public function setParent(?MaterialGroup $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return \Doctrine\Common\Collections\ArrayCollection|Material[]
     */
    public function getMaterials()
    {
        return $this->materials;
    }

}
