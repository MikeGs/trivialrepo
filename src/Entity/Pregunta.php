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
    private $preguntaCat;

        /**
     * @ORM\Column(type="text")
     */
    private $preguntaEs;

        /**
     * @ORM\Column(type="text")
     */
    private $preguntaEn;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaCorrectaCat;

        /**
     * @ORM\Column(type="text")
     */
    private $respostaCorrectaEs;

        /**
     * @ORM\Column(type="text")
     */
    private $respostaCorrectaEn;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta1Cat;

        /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta1Es;

        /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta1En;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta2Cat;

        /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta2Es;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta2En;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta3Cat;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta3Es;

    /**
     * @ORM\Column(type="text")
     */
    private $respostaIncorrecta3En;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Grup", inversedBy="preguntas")
     */
    private $idGrup;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dificultat", inversedBy="preguntas")
     */
    private $idDificultat;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tema", inversedBy="preguntas")
     */
    private $idTema;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PreguntaPartida", mappedBy="idPregunta")
     */
    private $preguntapartidas;

    /**
     * @ORM\Column(type="boolean")
     */
    private $activa;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TipusPregunta", inversedBy="Preguntes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Tipus;

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

    public function getRespostaCorrectaCat(): ?string
    {
        return $this->respostaCorrectaCat;
    }

    public function getRespostaCorrectaEs(): ?string
    {
        return $this->respostaCorrectaEs;
    }

    public function getRespostaCorrectaEn(): ?string
    {
        return $this->respostaCorrectaEn;
    }

    public function setRespostaCorrectaCat(string $respostaCorrectaCat): self
    {
        $this->respostaCorrectaCat = $respostaCorrectaCat;

        return $this;
    }

    public function setRespostaCorrectaEs(string $respostaCorrectaEs): self
    {
        $this->respostaCorrectaEs = $respostaCorrectaEs;

        return $this;
    }

    public function setRespostaCorrectaEn(string $respostaCorrectaEn): self
    {
        $this->respostaCorrectaEn = $respostaCorrectaEn;

        return $this;
    }

    public function getRespostaIncorrecta1Cat(): ?string
    {
        return $this->respostaIncorrecta1Cat;
    }

    public function getRespostaIncorrecta1Es(): ?string
    {
        return $this->respostaIncorrecta1Es;
    }

    public function getRespostaIncorrecta1En(): ?string
    {
        return $this->respostaIncorrecta1En;
    }

    public function setRespostaIncorrecta1Cat(string $respostaIncorrecta1Cat): self
    {
        $this->respostaIncorrecta1Cat = $respostaIncorrecta1Cat;

        return $this;
    }

    public function setRespostaIncorrecta1Es(string $respostaIncorrecta1Es): self
    {
        $this->respostaIncorrecta1Es = $respostaIncorrecta1Es;

        return $this;
    }

    public function setRespostaIncorrecta1En(string $respostaIncorrecta1En): self
    {
        $this->respostaIncorrecta1En = $respostaIncorrecta1En;

        return $this;
    }

    public function getRespostaIncorrecta2Cat(): ?string
    {
        return $this->respostaIncorrecta2Cat;
    }

    public function getRespostaIncorrecta2Es(): ?string
    {
        return $this->respostaIncorrecta2Es;
    }

    public function getRespostaIncorrecta2En(): ?string
    {
        return $this->respostaIncorrecta2En;
    }

    public function setRespostaIncorrecta2Cat(string $respostaIncorrecta2Cat): self
    {
        $this->respostaIncorrecta2Cat = $respostaIncorrecta2Cat;

        return $this;
    }

    public function setRespostaIncorrecta2Es(string $respostaIncorrecta2Es): self
    {
        $this->respostaIncorrecta2Es = $respostaIncorrecta2Es;

        return $this;
    }

    public function setRespostaIncorrecta2En(string $respostaIncorrecta2En): self
    {
        $this->respostaIncorrecta2Es = $respostaIncorrecta2En;

        return $this;
    }

    public function getRespostaIncorrecta3Cat(): ?string
    {
        return $this->respostaIncorrecta3Cat;
    }

    public function getRespostaIncorrecta3Es(): ?string
    {
        return $this->respostaIncorrecta3Es;
    }

    public function getRespostaIncorrecta3En(): ?string
    {
        return $this->respostaIncorrecta3En;
    }

    public function setRespostaIncorrecta3Cat(string $respostaIncorrecta3Cat): self
    {
        $this->respostaIncorrecta3Cat = $respostaIncorrecta3Cat;

        return $this;
    }

    public function setRespostaIncorrecta3Es(string $respostaIncorrecta3Es): self
    {
        $this->respostaIncorrecta3Es = $respostaIncorrecta3Es;

        return $this;
    }

    public function setRespostaIncorrecta3En(string $respostaIncorrecta3En): self
    {
        $this->respostaIncorrecta3En = $respostaIncorrecta3En;

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

    public function getTipus(): ?TipusPregunta
    {
        return $this->Tipus;
    }

    public function setTipus(?TipusPregunta $Tipus): self
    {
        $this->Tipus = $Tipus;

        return $this;
    }
}
