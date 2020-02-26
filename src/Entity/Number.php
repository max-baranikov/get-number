<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Number
 *
 * @ORM\Table(name="number")
 * @ORM\Entity
 */
class Number
{
    /**
     * @var int
     *
     * @ORM\Column(name="number_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $numberId;

    public function getNumberId(): ?int
    {
        return $this->numberId;
    }


}
