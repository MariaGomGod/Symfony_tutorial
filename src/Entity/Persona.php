<?php

namespace App\Entity;

use App\Repository\PersonaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonaRepository::class)
 * @ORM\Table(name="personas")
 */
class Persona
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_persona;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rubia;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $alta;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $gafas;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $activo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPersona(): ?int
    {
        return $this->id_persona;
    }

    public function setIdPersona(int $id_persona): self
    {
        $this->id_persona = $id_persona;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getRubia(): ?bool
    {
        return $this->rubia;
    }

    public function setRubia(?bool $rubia): self
    {
        $this->rubia = $rubia;

        return $this;
    }

    public function getAlta(): ?bool
    {
        return $this->alta;
    }

    public function setAlta(?bool $alta): self
    {
        $this->alta = $alta;

        return $this;
    }

    public function getGafas(): ?bool
    {
        return $this->gafas;
    }

    public function setGafas(?bool $gafas): self
    {
        $this->gafas = $gafas;

        return $this;
    }

    public function getActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): self
    {
        $this->activo = $activo;

        return $this;
    }
}
