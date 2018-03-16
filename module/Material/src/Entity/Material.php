<?php

namespace Material\Entity;

use Application\Entity\EntityTimeTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="materials")
 */
class Material
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
     * @ORM\ManyToOne(targetEntity="Material\Entity\MaterialGroup", inversedBy="materials", cascade={"persist"})
     * @ORM\JoinColumn(name="material_group_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $materialGroup;

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
     * @return MaterialGroup
     */
    public function getMaterialGroup(): MaterialGroup
    {
        return $this->materialGroup;
    }

    /**
     * @param MaterialGroup $materialGroup
     */
    public function setMaterialGroup(MaterialGroup $materialGroup): void
    {
        $this->materialGroup = $materialGroup;
    }

}
