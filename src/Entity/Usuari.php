<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsuariRepository")
 */
class Usuari
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
    private $codialumne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cognoms;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nick;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Grup", mappedBy="idUsuari")
     */
    private $grups;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Opinio", mappedBy="idUsuari", cascade={"persist", "remove"})
     */
    private $opinio;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\partida", inversedBy="usuaris")
     */
    private $idPartida;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\temapartida", mappedBy="usuari")
     */
    private $idTemaPartida;

    public function __construct()
    {
        $this->grups = new ArrayCollection();
        $this->idPartida = new ArrayCollection();
        $this->idTemaPartida = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodialumne(): ?string
    {
        return $this->codialumne;
    }

    public function setCodialumne(string $codialumne): self
    {
        $this->codialumne = $codialumne;

        return $this;
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

    public function getCognoms(): ?string
    {
        return $this->cognoms;
    }

    public function setCognoms(string $cognoms): self
    {
        $this->cognoms = $cognoms;

        return $this;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(string $nick): self
    {
        $this->nick = $nick;

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
            $grup->addIdUsuari($this);
        }

        return $this;
    }

    public function removeGrup(Grup $grup): self
    {
        if ($this->grups->contains($grup)) {
            $this->grups->removeElement($grup);
            $grup->removeIdUsuari($this);
        }

        return $this;
    }

    public function getOpinio(): ?Opinio
    {
        return $this->opinio;
    }

    public function setOpinio(Opinio $opinio): self
    {
        $this->opinio = $opinio;

        // set the owning side of the relation if necessary
        if ($this !== $opinio->getIdUsuari()) {
            $opinio->setIdUsuari($this);
        }

        return $this;
    }

    /**
     * @return Collection|partida[]
     */
    public function getIdPartida(): Collection
    {
        return $this->idPartida;
    }

    public function addIdPartida(partida $idPartida): self
    {
        if (!$this->idPartida->contains($idPartida)) {
            $this->idPartida[] = $idPartida;
        }

        return $this;
    }

    public function removeIdPartida(partida $idPartida): self
    {
        if ($this->idPartida->contains($idPartida)) {
            $this->idPartida->removeElement($idPartida);
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
            $idTemaPartida->setUsuari($this);
        }

        return $this;
    }

    public function removeIdTemaPartida(temapartida $idTemaPartida): self
    {
        if ($this->idTemaPartida->contains($idTemaPartida)) {
            $this->idTemaPartida->removeElement($idTemaPartida);
            // set the owning side to null (unless already changed)
            if ($idTemaPartida->getUsuari() === $this) {
                $idTemaPartida->setUsuari(null);
            }
        }

        return $this;
    }
}
