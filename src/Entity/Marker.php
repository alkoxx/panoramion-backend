<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateFileObjectAction;
use App\Repository\MarkerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Service\UploaderHelper;

/**
 * @ApiResource(
 *      attributes={"pagination_enabled"=false},
 *      itemOperations={"get", "put", "delete",
 *          "add_file"={
 *              "method"="POST",
 *              "path"="/markers/{id}/file",
 *              "deserialize"=false,
 *              "controller"=CreateFileObjectAction::class,
 *              "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             }
 *          }
 *    }
 * )
 * @ORM\Entity(repositoryClass=MarkerRepository::class)
 */
class Marker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lng;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="markers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    /**
     * @ORM\OneToMany(targetEntity=FileObject::class, mappedBy="marker", orphanRemoval=true)
     */
    private $fileObjects;

    public function __construct()
    {
        $this->fileObjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(string $lat): self
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLng(): ?string
    {
        return $this->lng;
    }

    public function setLng(string $lng): self
    {
        $this->lng = $lng;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
    
    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return Collection|FileObject[]
     */
    public function getFileObjects(): Collection
    {
        return $this->fileObjects;
    }

    public function addFileObject(FileObject $fileObject): self
    {
        if (!$this->fileObjects->contains($fileObject)) {
            $this->fileObjects[] = $fileObject;
            $fileObject->setMarker($this);
        }

        return $this;
    }

    public function removeFileObject(FileObject $fileObject): self
    {
        if ($this->fileObjects->removeElement($fileObject)) {
            // set the owning side to null (unless already changed)
            if ($fileObject->getMarker() === $this) {
                $fileObject->setMarker(null);
            }
        }

        return $this;
    }

}
