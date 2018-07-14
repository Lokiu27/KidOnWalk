<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PlanetOsmPoint
 *
 * @ORM\Table(name="planet_osm_point", indexes={@ORM\Index(name="planet_osm_point_index", columns={"way"})})
 * @ORM\Entity
 */
class PlanetOsmPoint
{
    /**
     * @var int
     *
     * @ORM\Column(name="osm_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="planet_osm_point_osm_id_seq", allocationSize=1, initialValue=1)
     */
    private $osmId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="leisure", type="text", nullable=true)
     */
    private $leisure;

    /**
     * @var geometry|null
     *
     * @ORM\Column(name="way", type="geometry", nullable=true)
     */
    public $way;

    public function getOsmId(): ?int
    {
        return $this->osmId;
    }

    public function getLeisure(): ?string
    {
        return $this->leisure;
    }

    public function setLeisure(?string $leisure): self
    {
        $this->leisure = $leisure;

        return $this;
    }

    public function getWay()
    {
        return $this->way;
    }

    public function setWay($way): self
    {
        $this->way = $way;

        return $this;
    }



}
