<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NivellRepository")
 */
class Nivell
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
     * @ORM\OneToMany(targetEntity="App\Entity\Grup", mappedBy="idNivell")
     */
    private $grups;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tema", mappedBy="idNivell")
     */
    private $temas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partida", mappedBy="idNivell")
     */
    private $partidas;

    public function __construct()
    {
        $this->grups = new ArrayCollection();
        $this->temas = new ArrayCollection();
        $this->partidas = new ArrayCollection();
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
     * @return Collection|Grup[]
     */
    public function getGrups(): Collection
    {
        return $this->grups;
    }

    public function addGrup(Grup $grup): self
    {
        if (!$this->grups->contains($grup)) {
            $this->grups[] = $grup;
            $grup->setIdNivell($this);
        }

        return $this;
    }

    public function removeGrup(Grup $grup): self
    {
        if ($this->grups->contains($grup)) {
            $this->grups->removeElement($grup);
            // set the owning side to null (unless already changed)
            if ($grup->getIdNivell() === $this) {
                $grup->setIdNivell(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tema[]
     */
    public function getTemas(): Collection
    {
        return $this->temas;
    }

    public function addTema(Tema $tema): self
    {
        if (!$this->temas->contains($tema)) {
            $this->temas[] = $tema;
            $tema->setIdNivell($this);
        }

        return $this;
    }

    public function removeTema(Tema $tema): self
    {
        if ($this->temas->contains($tema)) {
            $this->temas->removeElement($tema);
            // set the owning side to null (unless already changed)
            if ($tema->getIdNivell() === $this) {
                $tema->setIdNivell(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Partida[]
     */
    public function getPartidas(): Collection
    {
        return $this->partidas;
    }

    public function addPartida(Partida $partida): self
    {
        if (!$this->partidas->contains($partida)) {
            $this->partidas[] = $partida;
            $partida->setIdNivell($this);
        }

        return $this;
    }

    public function removePartida(Partida $partida): self
    {
        if ($this->partidas->contains($partida)) {
            $this->partidas->removeElement($partida);
            // set the owning side to null (unless already changed)
            if ($partida->getIdNivell() === $this) {
                $partida->setIdNivell(null);
            }
        }

        return $this;
    }
}
