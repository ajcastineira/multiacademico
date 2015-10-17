<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursos
 *
 * @ORM\Table(name="cursos")
 * @ORM\Entity
 */
class Cursos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="cursoabreviatura", type="string", length=5, nullable=false)
     */
    private $cursoabreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="curso", type="string", length=30, nullable=false)
     */
    private $curso;

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
