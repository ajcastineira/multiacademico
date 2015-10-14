<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matriculas
 *
 * @ORM\Table(name="matriculas", indexes={@ORM\Index(name="FK_matriculas", columns={"matriculacodperiodo"}), @ORM\Index(name="matriculacodestudiante", columns={"matriculacodestudiante"}), @ORM\Index(name="matriculacodespecializacion", columns={"matriculacodespecializacion"}), @ORM\Index(name="matriculacodcurso", columns={"matriculacodcurso"}), @ORM\Index(name="matriculausuario", columns={"matriculausuario"})})
 * @ORM\Entity
 */
class Matriculas
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
     * @ORM\Column(name="matriculaseccion", type="string", length=15, nullable=false)
     */
    private $matriculaseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaparalelo", type="string", length=1, nullable=false)
     */
    private $matriculaparalelo;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculafecha", type="datetime", length=10, nullable=false)
     */
    private $matriculafecha;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaclave", type="string", length=4, nullable=false)
     */
    private $matriculaclave;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculatipo", type="string", length=14, nullable=false)
     */
    private $matriculatipo;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaobservacion", type="string", length=250, nullable=false)
     */
    private $matriculaobservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaestado", type="string", length=14, nullable=false)
     */
    private $matriculaestado;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q1_laborada", type="string", length=2, nullable=true)
     */
    private $matriculaQ1Laborada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q1_jutificada", type="string", length=2, nullable=true)
     */
    private $matriculaQ1Jutificada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q1_injustificada", type="string", length=2, nullable=true)
     */
    private $matriculaQ1Injustificada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q2_laborada", type="string", length=2, nullable=true)
     */
    private $matriculaQ2Laborada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q2_jutificada", type="string", length=2, nullable=true)
     */
    private $matriculaQ2Jutificada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q2_injustificada", type="string", length=2, nullable=true)
     */
    private $matriculaQ2Injustificada;

    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matriculausuario", referencedColumnName="id",nullable=false)
     * })
     */
    private $matriculausuario;

    /**
     * @var \Estudiantes
     *
     * @ORM\ManyToOne(targetEntity="Estudiantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matriculacodestudiante", referencedColumnName="id",nullable=false)
     * })
     */
    private $matriculacodestudiante;

    /**
     * @var \Especializaciones
     *
     * @ORM\ManyToOne(targetEntity="Especializaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matriculacodespecializacion", referencedColumnName="id",nullable=false)
     * })
     */
    private $matriculacodespecializacion;

    /**
     * @var \Cursos
     *
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matriculacodcurso", referencedColumnName="id",nullable=false)
     * })
     */
    private $matriculacodcurso;

    /**
     * @var \Periodos
     *
     * @ORM\ManyToOne(targetEntity="Periodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matriculacodperiodo", referencedColumnName="id",nullable=false)
     * })
     */
    private $matriculacodperiodo;



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
     * Set matriculaseccion
     *
     * @param string $matriculaseccion
     *
     * @return Matriculas
     */
    public function setMatriculaseccion($matriculaseccion)
    {
        $this->matriculaseccion = $matriculaseccion;

        return $this;
    }

    /**
     * Get matriculaseccion
     *
     * @return string
     */
    public function getMatriculaseccion()
    {
        return $this->matriculaseccion;
    }

    /**
     * Set matriculaparalelo
     *
     * @param string $matriculaparalelo
     *
     * @return Matriculas
     */
    public function setMatriculaparalelo($matriculaparalelo)
    {
        $this->matriculaparalelo = $matriculaparalelo;

        return $this;
    }

    /**
     * Get matriculaparalelo
     *
     * @return string
     */
    public function getMatriculaparalelo()
    {
        return $this->matriculaparalelo;
    }

    /**
     * Set matriculafecha
     *
     * @param string $matriculafecha
     *
     * @return Matriculas
     */
    public function setMatriculafecha($matriculafecha)
    {
        $this->matriculafecha = $matriculafecha;

        return $this;
    }

    /**
     * Get matriculafecha
     *
     * @return string
     */
    public function getMatriculafecha()
    {
        return $this->matriculafecha;
    }

    /**
     * Set matriculaclave
     *
     * @param string $matriculaclave
     *
     * @return Matriculas
     */
    public function setMatriculaclave($matriculaclave)
    {
        $this->matriculaclave = $matriculaclave;

        return $this;
    }

    /**
     * Get matriculaclave
     *
     * @return string
     */
    public function getMatriculaclave()
    {
        return $this->matriculaclave;
    }

    /**
     * Set matriculatipo
     *
     * @param string $matriculatipo
     *
     * @return Matriculas
     */
    public function setMatriculatipo($matriculatipo)
    {
        $this->matriculatipo = $matriculatipo;

        return $this;
    }

    /**
     * Get matriculatipo
     *
     * @return string
     */
    public function getMatriculatipo()
    {
        return $this->matriculatipo;
    }

    /**
     * Set matriculaobservacion
     *
     * @param string $matriculaobservacion
     *
     * @return Matriculas
     */
    public function setMatriculaobservacion($matriculaobservacion)
    {
        $this->matriculaobservacion = $matriculaobservacion;

        return $this;
    }

    /**
     * Get matriculaobservacion
     *
     * @return string
     */
    public function getMatriculaobservacion()
    {
        return $this->matriculaobservacion;
    }

    /**
     * Set matriculaestado
     *
     * @param string $matriculaestado
     *
     * @return Matriculas
     */
    public function setMatriculaestado($matriculaestado)
    {
        $this->matriculaestado = $matriculaestado;

        return $this;
    }

    /**
     * Get matriculaestado
     *
     * @return string
     */
    public function getMatriculaestado()
    {
        return $this->matriculaestado;
    }

    /**
     * Set matriculaQ1Laborada
     *
     * @param string $matriculaQ1Laborada
     *
     * @return Matriculas
     */
    public function setMatriculaQ1Laborada($matriculaQ1Laborada)
    {
        $this->matriculaQ1Laborada = $matriculaQ1Laborada;

        return $this;
    }

    /**
     * Get matriculaQ1Laborada
     *
     * @return string
     */
    public function getMatriculaQ1Laborada()
    {
        return $this->matriculaQ1Laborada;
    }

    /**
     * Set matriculaQ1Jutificada
     *
     * @param string $matriculaQ1Jutificada
     *
     * @return Matriculas
     */
    public function setMatriculaQ1Jutificada($matriculaQ1Jutificada)
    {
        $this->matriculaQ1Jutificada = $matriculaQ1Jutificada;

        return $this;
    }

    /**
     * Get matriculaQ1Jutificada
     *
     * @return string
     */
    public function getMatriculaQ1Jutificada()
    {
        return $this->matriculaQ1Jutificada;
    }

    /**
     * Set matriculaQ1Injustificada
     *
     * @param string $matriculaQ1Injustificada
     *
     * @return Matriculas
     */
    public function setMatriculaQ1Injustificada($matriculaQ1Injustificada)
    {
        $this->matriculaQ1Injustificada = $matriculaQ1Injustificada;

        return $this;
    }

    /**
     * Get matriculaQ1Injustificada
     *
     * @return string
     */
    public function getMatriculaQ1Injustificada()
    {
        return $this->matriculaQ1Injustificada;
    }

    /**
     * Set matriculaQ2Laborada
     *
     * @param string $matriculaQ2Laborada
     *
     * @return Matriculas
     */
    public function setMatriculaQ2Laborada($matriculaQ2Laborada)
    {
        $this->matriculaQ2Laborada = $matriculaQ2Laborada;

        return $this;
    }

    /**
     * Get matriculaQ2Laborada
     *
     * @return string
     */
    public function getMatriculaQ2Laborada()
    {
        return $this->matriculaQ2Laborada;
    }

    /**
     * Set matriculaQ2Jutificada
     *
     * @param string $matriculaQ2Jutificada
     *
     * @return Matriculas
     */
    public function setMatriculaQ2Jutificada($matriculaQ2Jutificada)
    {
        $this->matriculaQ2Jutificada = $matriculaQ2Jutificada;

        return $this;
    }

    /**
     * Get matriculaQ2Jutificada
     *
     * @return string
     */
    public function getMatriculaQ2Jutificada()
    {
        return $this->matriculaQ2Jutificada;
    }

    /**
     * Set matriculaQ2Injustificada
     *
     * @param string $matriculaQ2Injustificada
     *
     * @return Matriculas
     */
    public function setMatriculaQ2Injustificada($matriculaQ2Injustificada)
    {
        $this->matriculaQ2Injustificada = $matriculaQ2Injustificada;

        return $this;
    }

    /**
     * Get matriculaQ2Injustificada
     *
     * @return string
     */
    public function getMatriculaQ2Injustificada()
    {
        return $this->matriculaQ2Injustificada;
    }

    /**
     * Set matriculausuario
     *
     * @param \Multiservices\ArxisBundle\Entity\Usuario $matriculausuario
     *
     * @return Matriculas
     */
    public function setMatriculausuario(\Multiservices\ArxisBundle\Entity\Usuario $matriculausuario = null)
    {
        $this->matriculausuario = $matriculausuario;

        return $this;
    }

    /**
     * Get matriculausuario
     *
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getMatriculausuario()
    {
        return $this->matriculausuario;
    }

    /**
     * Set matriculacodestudiante
     *
     * @param \MultiacademicoBundle\Entity\Estudiantes $matriculacodestudiante
     *
     * @return Matriculas
     */
    public function setMatriculacodestudiante(\MultiacademicoBundle\Entity\Estudiantes $matriculacodestudiante = null)
    {
        $this->matriculacodestudiante = $matriculacodestudiante;

        return $this;
    }

    /**
     * Get matriculacodestudiante
     *
     * @return \MultiacademicoBundle\Entity\Estudiantes
     */
    public function getMatriculacodestudiante()
    {
        return $this->matriculacodestudiante;
    }

    /**
     * Set matriculacodespecializacion
     *
     * @param \MultiacademicoBundle\Entity\Especializaciones $matriculacodespecializacion
     *
     * @return Matriculas
     */
    public function setMatriculacodespecializacion(\MultiacademicoBundle\Entity\Especializaciones $matriculacodespecializacion = null)
    {
        $this->matriculacodespecializacion = $matriculacodespecializacion;

        return $this;
    }

    /**
     * Get matriculacodespecializacion
     *
     * @return \MultiacademicoBundle\Entity\Especializaciones
     */
    public function getMatriculacodespecializacion()
    {
        return $this->matriculacodespecializacion;
    }

    /**
     * Set matriculacodcurso
     *
     * @param \MultiacademicoBundle\Entity\Cursos $matriculacodcurso
     *
     * @return Matriculas
     */
    public function setMatriculacodcurso(\MultiacademicoBundle\Entity\Cursos $matriculacodcurso = null)
    {
        $this->matriculacodcurso = $matriculacodcurso;

        return $this;
    }

    /**
     * Get matriculacodcurso
     *
     * @return \MultiacademicoBundle\Entity\Cursos
     */
    public function getMatriculacodcurso()
    {
        return $this->matriculacodcurso;
    }

    /**
     * Set matriculacodperiodo
     *
     * @param \MultiacademicoBundle\Entity\Periodos $matriculacodperiodo
     *
     * @return Matriculas
     */
    public function setMatriculacodperiodo(\MultiacademicoBundle\Entity\Periodos $matriculacodperiodo = null)
    {
        $this->matriculacodperiodo = $matriculacodperiodo;

        return $this;
    }

    /**
     * Get matriculacodperiodo
     *
     * @return \MultiacademicoBundle\Entity\Periodos
     */
    public function getMatriculacodperiodo()
    {
        return $this->matriculacodperiodo;
    }
}
