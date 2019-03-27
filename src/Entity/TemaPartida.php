<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemaPartidaRepository")
 */
class TemaPartida
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
     * @ORM\Column(type="float")
     */
    private $puntuacio;

    /**
     * @ORM\Column(type="integer")
     */
    private $encerts;

    /**
     * @ORM\Column(type="integer")
     */
    private $errors;

    /**
     * @ORM\Column(type="integer")
     */
    private $formatges;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Usuari", inversedBy="idTemaPartida")
     */
    private $usuari;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Partida", inversedBy="idTemaPartida")
     */
    private $partida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tema", inversedBy="temapartidas")
     */
    private $idTema;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Preguntapartida", mappedBy="idTemaPartida")
     */
    private $preguntapartidas;

    public function __construct()
    {
        $this->preguntapartidas = new ArrayCollection();
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

    public function getPuntuacio(): ?float
    {
        return $this->puntuacio;
    }

    public function setPuntuacio(float $puntuacio): self
    {
        $this->puntuacio = $puntuacio;

        return $this;
    }

    public function getEncerts(): ?int
    {
        return $this->encerts;
    }

    public function setEncerts(int $encerts): self
    {
        $this->encerts = $encerts;

        return $this;
    }

    public function getErrors(): ?int
    {
        return $this->errors;
    }

    public function setErrors(int $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function getFormatges(): ?int
    {
        return $this->formatges;
    }

    public function setFormatges(int $formatges): self
    {
        $this->formatges = $formatges;

        return $this;
    }

    public function getUsuari(): ?Usuari
    {
        return $this->usuari;
    }

    public function setUsuari(?Usuari $usuari): self
    {
        $this->usuari = $usuari;

        return $this;
    }

    public function getPartida(): ?Partida
    {
        return $this->partida;
    }

    public function setPartida(?Partida $partida): self
    {
        $this->partida = $partida;

        return $this;
    }

    public function getIdTema(): ?tema
    {
        return $this->idTema;
    }

    public function setIdTema(?tema $idTema): self
    {
        $this->idTema = $idTema;

        return $this;
    }

    /**
     * @return Collection|Preguntapartida[]
     */
    public function getPreguntapartidas(): Collection
    {
        return $this->preguntapartidas;
    }

    public function addPreguntapartida(Preguntapartida $preguntapartida): self
    {
        if (!$this->preguntapartidas->contains($preguntapartida)) {
            $this->preguntapartidas[] = $preguntapartida;
            $preguntapartida->setIdTemaPartida($this);
        }

        return $this;
    }

    public function removePreguntapartida(Preguntapartida $preguntapartida): self
    {
        if ($this->preguntapartidas->contains($preguntapartida)) {
            $this->preguntapartidas->removeElement($preguntapartida);
            // set the owning side to null (unless already changed)
            if ($preguntapartida->getIdTemaPartida() === $this) {
                $preguntapartida->setIdTemaPartida(null);
            }
        }

        return $this;
    }
}
