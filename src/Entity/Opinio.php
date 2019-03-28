<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OpinioRepository")
 */
class Opinio
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $contingut;

    /**
     * @ORM\Column(type="integer")
     */
    private $puntuacio;

    /**
     * @ORM\Column(type="datetime")
     */
    private $data;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Usuari", inversedBy="opinio", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUsuari;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContingut(): ?string
    {
        return $this->contingut;
    }

    public function setContingut(string $contingut): self
    {
        $this->contingut = $contingut;

        return $this;
    }

    public function getPuntuacio(): ?int
    {
        return $this->puntuacio;
    }

    public function setPuntuacio(int $puntuacio): self
    {
        $this->puntuacio = $puntuacio;

        return $this;
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

    public function getIdUsuari(): ?usuari
    {
        return $this->idUsuari;
    }

    public function setIdUsuari(usuari $idUsuari): self
    {
        $this->idUsuari = $idUsuari;

        return $this;
    }
}
