<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TipusPreguntaRepository")
 */
class TipusPregunta
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pregunta", mappedBy="Tipus")
     */
    private $Preguntes;

    public function __construct()
    {
        $this->Preguntes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|Pregunta[]
     */
    public function getPreguntes(): Collection
    {
        return $this->Preguntes;
    }

    public function addPregunta(Pregunta $pregunta): self
    {
        if (!$this->Preguntes->contains($pregunta)) {
            $this->Preguntes[] = $pregunta;
            $pregunta->setTipus($this);
        }

        return $this;
    }

    public function removePregunta(Pregunta $pregunta): self
    {
        if ($this->Preguntes->contains($pregunta)) {
            $this->Preguntes->removeElement($pregunta);
            // set the owning side to null (unless already changed)
            if ($pregunta->getTipus() === $this) {
                $pregunta->setTipus(null);
            }
        }

        return $this;
    }
}
