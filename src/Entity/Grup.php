<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GrupRepository")
 */
class Grup
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
     * @ORM\Column(type="string", length=255)
     */
    private $codi;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datainici;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datafinal;

    /**
     * @ORM\Column(type="boolean")
     */
    private $finalitzat;

    /**
     * @ORM\Column(type="float")
     */
    private $tempsresposta;

    /**
     * @ORM\Column(type="integer")
     */
    private $idAdministrador;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Nivell", inversedBy="grups")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idNivell;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Usuari", inversedBy="grups")
     */
    private $idUsuari;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pregunta", mappedBy="idGrup")
     */
    private $preguntas;

    /**
     * @ORM\Column(type="float")
     */
    private $puntuacio_facil;

    /**
     * @ORM\Column(type="float")
     */
    private $puntuacio_mitja;

    /**
     * @ORM\Column(type="float")
     */
    private $puntuacio_dificil;

    public function __construct()
    {
        $this->idUsuari = new ArrayCollection();
        $this->preguntas = new ArrayCollection();
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

    public function getCodi(): ?string
    {
        return $this->codi;
    }

    public function setCodi(string $codi): self
    {
        $this->codi = $codi;

        return $this;
    }

    public function getDatainici(): ?\DateTimeInterface
    {
        return $this->datainici;
    }

    public function setDatainici(\DateTimeInterface $datainici): self
    {
        $this->datainici = $datainici;

        return $this;
    }

    public function getDatafinal(): ?\DateTimeInterface
    {
        return $this->datafinal;
    }

    public function setDatafinal(\DateTimeInterface $datafinal): self
    {
        $this->datafinal = $datafinal;

        return $this;
    }

    public function getFinalitzat(): ?bool
    {
        return $this->finalitzat;
    }

    public function setFinalitzat(bool $finalitzat): self
    {
        $this->finalitzat = $finalitzat;

        return $this;
    }

    public function getTempsresposta(): ?float
    {
        return $this->tempsresposta;
    }

    public function setTempsresposta(float $tempsresposta): self
    {
        $this->tempsresposta = $tempsresposta;

        return $this;
    }

    public function getIdAdministrador(): ?int
    {
        return $this->idAdministrador;
    }

    public function setIdAdministrador(int $idAdministrador): self
    {
        $this->idAdministrador = $idAdministrador;

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
     * @return Collection|usuari[]
     */
    public function getIdUsuari(): Collection
    {
        return $this->idUsuari;
    }

    public function addIdUsuari(usuari $idUsuari): self
    {
        if (!$this->idUsuari->contains($idUsuari)) {
            $this->idUsuari[] = $idUsuari;
        }

        return $this;
    }

    public function removeIdUsuari(usuari $idUsuari): self
    {
        if ($this->idUsuari->contains($idUsuari)) {
            $this->idUsuari->removeElement($idUsuari);
        }

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
            $pregunta->setIdGrup($this);
        }

        return $this;
    }

    public function removePregunta(Pregunta $pregunta): self
    {
        if ($this->preguntas->contains($pregunta)) {
            $this->preguntas->removeElement($pregunta);
            // set the owning side to null (unless already changed)
            if ($pregunta->getIdGrup() === $this) {
                $pregunta->setIdGrup(null);
            }
        }

        return $this;
    }

    public function getPuntuacioFacil(): ?float
    {
        return $this->puntuacio_facil;
    }

    public function setPuntuacioFacil(float $puntuacio_facil): self
    {
        $this->puntuacio_facil = $puntuacio_facil;

        return $this;
    }

    public function getPuntuacioMitja(): ?float
    {
        return $this->puntuacio_mitja;
    }

    public function setPuntuacioMitja(float $puntuacio_mitja): self
    {
        $this->puntuacio_mitja = $puntuacio_mitja;

        return $this;
    }

    public function getPuntuacioDificil(): ?float
    {
        return $this->puntuacio_dificil;
    }

    public function setPuntuacioDificil(float $puntuacio_dificil): self
    {
        $this->puntuacio_dificil = $puntuacio_dificil;

        return $this;
    }
}
