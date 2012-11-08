<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * An Administrator.
 *
 * @ORM\Entity
 * @ORM\Table(name="administrators")
 */
class Administrator extends Professor
{
}