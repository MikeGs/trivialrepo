<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TemaRepository")
 */
class Tema
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
     * @ORM\OneToMany(targetEntity="App\Entity\Pregunta", mappedBy="idTema")
     */
    private $preguntas;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nivell", inversedBy="temas")
     */
    private $idNivell;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TemaPartida", mappedBy="idTema")
     */
    private $temapartidas;

    public function __construct()
    {
        $this->preguntas = new ArrayCollection();
        $this->temapartidas = new ArrayCollection();
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
    public function getPreguntas(): Collection
    {
        return $this->preguntas;
    }

    public function addPregunta(Pregunta $pregunta): self
    {
        if (!$this->preguntas->contains($pregunta)) {
            $this->preguntas[] = $pregunta;
            $pregunta->setIdTema($this);
        }

        return $this;
    }

    public function removePregunta(Pregunta $pregunta): self
    {
        if ($this->preguntas->contains($pregunta)) {
            $this->preguntas->removeElement($pregunta);
            // set the owning side to null (unless already changed)
            if ($pregunta->getIdTema() === $this) {
                $pregunta->setIdTema(null);
            }
        }

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

    /**
     * @return Collection|Temapartida[]
     */
    public function getTemapartidas(): Collection
    {
        return $this->temapartidas;
    }

    public function addTemapartida(Temapartida $temapartida): self
    {
        if (!$this->temapartidas->contains($temapartida)) {
            $this->temapartidas[] = $temapartida;
            $temapartida->setIdTema($this);
        }

        return $this;
    }

    public function removeTemapartida(Temapartida $temapartida): self
    {
        if ($this->temapartidas->contains($temapartida)) {
            $this->temapartidas->removeElement($temapartida);
            // set the owning side to null (unless already changed)
            if ($temapartida->getIdTema() === $this) {
                $temapartida->setIdTema(null);
            }
        }

        return $this;
    }
}
