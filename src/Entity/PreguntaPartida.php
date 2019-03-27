<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PreguntaPartidaRepository")
 */
class PreguntaPartida
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $resposta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TemaPartida", inversedBy="preguntapartidas")
     */
    private $idTemaPartida;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pregunta", inversedBy="preguntapartidas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPregunta;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResposta(): ?bool
    {
        return $this->resposta;
    }

    public function setResposta(bool $resposta): self
    {
        $this->resposta = $resposta;

        return $this;
    }

    public function getIdTemaPartida(): ?temapartida
    {
        return $this->idTemaPartida;
    }

    public function setIdTemaPartida(?temapartida $idTemaPartida): self
    {
        $this->idTemaPartida = $idTemaPartida;

        return $this;
    }

    public function getIdPregunta(): ?pregunta
    {
        return $this->idPregunta;
    }

    public function setIdPregunta(?pregunta $idPregunta): self
    {
        $this->idPregunta = $idPregunta;

        return $this;
    }
}
