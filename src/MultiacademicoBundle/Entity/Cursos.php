<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Cursos
 *
 * @ORM\Table(name="cursos")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class Cursos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cursoabreviatura", type="string", length=5, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"informejunta"})
     */
    private $cursoabreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="curso", type="string", length=30, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $curso;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=10, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $tipo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="integer", length=2, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $nivel;
    
    /**
     * @var string
     *
     * @ORM\Column(name="grado", type="integer", length=2, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $grado;

    /**
     * @var string
     *
     * @ORM\Column(name="cursoestado", type="string", length=8, nullable=false)
     */
    private $cursoestado;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cursoabreviatura
     *
     * @param string $cursoabreviatura
     *
     * @return Cursos
     */
    public function setCursoabreviatura($cursoabreviatura)
    {
        $this->cursoabreviatura = $cursoabreviatura;

        return $this;
    }

    /**
     * Get cursoabreviatura
     *
     * @return string
     */
    public function getCursoabreviatura()
    {
        return $this->cursoabreviatura;
    }

    /**
     * Set curso
     *
     * @param string $curso
     *
     * @return Cursos
     */
    public function setCurso($curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return string
     */
    public function getCurso()
    {
        return $this->curso;
    }
    
    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Cursos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
    
    /**
     * Set nivel
     *
     * @param string $nivel
     *
     * @return Cursos
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string
     */
    public function getNivel()
    {
        return $this->nivel;
    }
    
     /**
     * Set grado
     *
     * @param string $grado
     *
     * @return Cursos
     */
    public function setGrado($grado)
    {
        $this->grado = $grado;

        return $this;
    }

    /**
     * Get grado
     *
     * @return string
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * Set cursoestado
     *
     * @param string $cursoestado
     *
     * @return Cursos
     */
    public function setCursoestado($cursoestado)
    {
        $this->cursoestado = $cursoestado;

        return $this;
    }

    /**
     * Get cursoestado
     *
     * @return string
     */
    public function getCursoestado()
    {
        return $this->cursoestado;
    }
    
    public function __toString() {
        return $this->curso;
    }
}
