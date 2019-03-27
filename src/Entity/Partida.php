<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PartidaRepository")
 */
class Partida
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nivell", inversedBy="partidas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idNivell;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\TipusPartida", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idTipusPartida;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuari", mappedBy="idPartida")
     */
    private $usuaris;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TemaPartida", mappedBy="partida")
     */
    private $idTemaPartida;

    public function __construct()
    {
        $this->usuaris = new ArrayCollection();
        $this->idTemaPartida = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getIdNivell(): ?nivell
    {
        return $this->idNivell;
    }

    public function setIdNivell(?nivell $idNivell): self
    {
        $this->idNivell = $idNivell;

        return $this;
    }

    public function getIdTipusPartida(): ?tipuspartida
    {
        return $this->idTipusPartida;
    }

    public function setIdTipusPartida(tipuspartida $idTipusPartida): self
    {
        $this->idTipusPartida = $idTipusPartida;

        return $this;
    }

    /**
     * @return Collection|Usuari[]
     */
    public function getUsuaris(): Collection
    {
        return $this->usuaris;
    }

    public function addUsuari(Usuari $usuari): self
    {
        if (!$this->usuaris->contains($usuari)) {
            $this->usuaris[] = $usuari;
            $usuari->addIdPartida($this);
        }

        return $this;
    }

    public function removeUsuari(Usuari $usuari): self
    {
        if ($this->usuaris->contains($usuari)) {
            $this->usuaris->removeElement($usuari);
            $usuari->removeIdPartida($this);
        }

        return $this;
    }

    /**
     * @return Collection|temapartida[]
     */
    public function getIdTemaPartida(): Collection
    {
        return $this->idTemaPartida;
    }

    public function addIdTemaPartida(temapartida $idTemaPartida): self
    {
        if (!$this->idTemaPartida->contains($idTemaPartida)) {
            $this->idTemaPartida[] = $idTemaPartida;
            $idTemaPartida->setPartida($this);
        }

        return $this;
    }

    public function removeIdTemaPartida(temapartida $idTemaPartida): self
    {
        if ($this->idTemaPartida->contains($idTemaPartida)) {
            $this->idTemaPartida->removeElement($idTemaPartida);
            // set the owning side to null (unless already changed)
            if ($idTemaPartida->getPartida() === $this) {
                $idTemaPartida->setPartida(null);
            }
        }

        return $this;
    }
}
