<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreguntaRepository")
 */
class Pregunta
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
    private $text;

    /**
     * @ORM\Column(type="text")
     */
    private $resposta_correcta;

    /**
     * @ORM\Column(type="text")
     */
    private $resposta_incorrecta1;

    /**
     * @ORM\Column(type="text")
     */
    private $resposta_incorrecta2;

    /**
     * @ORM\Column(type="text")
     */
    private $resposta_incorrecta3;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\grup", inversedBy="preguntas")
     */
    private $idGrup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\dificultat", inversedBy="preguntas")
     */
    private $idDificultat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\tema", inversedBy="preguntas")
     */
    private $idTema;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Preguntapartida", mappedBy="idPregunta")
     */
    private $preguntapartidas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activa;

    public function __construct()
    {
        $this->preguntapartidas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getRespostaCorrecta(): ?string
    {
        return $this->resposta_correcta;
    }

    public function setRespostaCorrecta(string $resposta_correcta): self
    {
        $this->resposta_correcta = $resposta_correcta;

        return $this;
    }

    public function getRespostaIncorrecta1(): ?string
    {
        return $this->resposta_incorrecta1;
    }

    public function setRespostaIncorrecta1(string $resposta_incorrecta1): self
    {
        $this->resposta_incorrecta1 = $resposta_incorrecta1;

        return $this;
    }

    public function getRespostaIncorrecta2(): ?string
    {
        return $this->resposta_incorrecta2;
    }

    public function setRespostaIncorrecta2(string $resposta_incorrecta2): self
    {
        $this->resposta_incorrecta2 = $resposta_incorrecta2;

        return $this;
    }

    public function getRespostaIncorrecta3(): ?string
    {
        return $this->resposta_incorrecta3;
    }

    public function setRespostaIncorrecta3(string $resposta_incorrecta3): self
    {
        $this->resposta_incorrecta3 = $resposta_incorrecta3;

        return $this;
    }

    public function getIdGrup(): ?grup
    {
        return $this->idGrup;
    }

    public function setIdGrup(?grup $idGrup): self
    {
        $this->idGrup = $idGrup;

        return $this;
    }

    public function getIdDificultat(): ?dificultat
    {
        return $this->idDificultat;
    }

    public function setIdDificultat(?dificultat $idDificultat): self
    {
        $this->idDificultat = $idDificultat;

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
            $preguntapartida->setIdPregunta($this);
        }

        return $this;
    }

    public function removePreguntapartida(Preguntapartida $preguntapartida): self
    {
        if ($this->preguntapartidas->contains($preguntapartida)) {
            $this->preguntapartidas->removeElement($preguntapartida);
            // set the owning side to null (unless already changed)
            if ($preguntapartida->getIdPregunta() === $this) {
                $preguntapartida->setIdPregunta(null);
            }
        }

        return $this;
    }

    public function getActiva(): ?bool
    {
        return $this->activa;
    }

    public function setActiva(bool $activa): self
    {
        $this->activa = $activa;

        return $this;
    }
}
