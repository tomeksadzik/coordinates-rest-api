<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointRepository")
 */
class Point
{

    const TYPE_FIELD_NAME = 'type';
    const NAME_FIELD_NAME = 'name';
    const LAT_FIELD_NAME = 'lat';
    const LNG_FIELD_NAME = 'lng';
    CONST RELATED_POINTS_FIELD_NAME = 'relatedPoints';
    CONST ID_FIELD_NAME = 'id';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank(message = "Type is required")
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Type must contain at least 1 character",
     *      maxMessage = "Type can contain a maximum of 255 characters"
     * )
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank(message = "Name is required")
     * @Assert\Length(
     *      min = 1,
     *      max = 255,
     *      minMessage = "Name must contain at least 1 character",
     *      maxMessage = "Name can contain a maximum of 255 characters"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=6)
     * @Assert\Type("numeric")
     * @Assert\NotBlank(message = "Latitude is required")
     * @Assert\Range(
     *      min = -90,
     *      max = 90,
     *      minMessage = "Latitude may have a minimum of -90 degrees",
     *      maxMessage = "Latitude can be up to 90 degrees"
     * )
     */
    private $lat;

    /**
     * @ORM\Column(type="decimal", precision=8, scale=6)
     * @Assert\NotBlank(message = "Longitude is required")
     * @Assert\Range(
     *      min = -90,
     *      max = 90,
     *      minMessage = "Longitude may have a minimum of -90 degrees",
     *      maxMessage = "Longitude can be up to 90 degrees"
     * )
     */
    private $lng;

    /**
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Point", inversedBy="relatedPoints", cascade={"persist"})
     * @ORM\JoinTable(name="related_points",
     *      joinColumns={@ORM\JoinColumn(name="point_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="related_point_id", referencedColumnName="id")}
     *      )
     */
    private $relatedPoints;


    public function __construct()
    {
        $this->relatedPoints = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat($lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): float
    {
        return $this->lng;
    }

    public function setLng($lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * @return Collection|Point[]
     */
    public function getRelatedPoints(): Collection
    {
        return $this->relatedPoints;
    }

    public function addRelatedPoint(Point $relatedPoint): self
    {
        if (!$this->relatedPoints->contains($relatedPoint)) {
            $this->relatedPoints[] = $relatedPoint;
            $relatedPoint->addRelatedPoint($this);
        }

        return $this;
    }

    public function removeRelatedPoint(Point $relatedPoint): self
    {
        if ($this->relatedPoints->contains($relatedPoint)) {
            $this->relatedPoints->removeElement($relatedPoint);
            $relatedPoint->removeRelatedPoint($this);
        }

        return $this;
    }
}
