<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playgrounds
 *
 * @ORM\Table(name="playgrounds", indexes={@ORM\Index(name="plgs_idx", columns={"point"})})
 * @ORM\Entity(repositoryClass="App\Repository\PlaygroundsRepository")
 */
class Playgrounds
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="playgrounds_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $name;

    /**
     * @var geometry|null
     *
     * @ORM\Column(name="point", type="geometry", nullable=true)
     */
    private $point;
    
 public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point): self
    {
        $this->point = $point;

        return $this;
    }

}
