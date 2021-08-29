<?php

namespace App\Entity;

use App\Repository\EmpleadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmpleadoRepository::class)
 * @ORM\Table(name="empleados")
 */
class Empleado
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_empleado;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $f_nacimiento;

    /**
     * @ORM\Column(type="string", length=15, nullable=true)
     */
    private $sexo;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $cargo;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $salario;

    public function getIdEmpleado(): ?int
    {
        return $this->id_empleado;
    }

    public function setIdEmpleado(int $id_empleado): self
    {
        $this->id_empleado = $id_empleado;

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(?string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getFNacimiento(): ?string
    {
        return $this->f_nacimiento;
    }

    public function setFNacimiento(?string $f_nacimiento): self
    {
        $this->f_nacimiento = $f_nacimiento;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(?string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(?string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getSalario(): ?string
    {
        return $this->salario;
    }

    public function setSalario(?string $salario): self
    {
        $this->salario = $salario;

        return $this;
    }
}
