<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distributivos
 *
 * @ORM\Table(name="distributivos", indexes={@ORM\Index(name="FK_asignaturasprofesores", columns={"distributivocodperiodo"}), @ORM\Index(name="distributivocoddocente", columns={"distributivocoddocente"}), @ORM\Index(name="distributivocodmateria", columns={"distributivocodmateria"}), @ORM\Index(name="distributivocodcurso", columns={"distributivocodcurso"}), @ORM\Index(name="distributivocodespecializacion", columns={"distributivocodespecializacion"})})
 * @ORM\Entity
 */
class Distributivos
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
     * @ORM\Column(name="distributivoparalelo", type="string", length=1, nullable=false)
     */
    private $distributivoparalelo;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivoseccion", type="string", length=20, nullable=false)
     */
    private $distributivoseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivohora", type="string", length=10, nullable=false)
     */
    private $distributivohora;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivofecha", type="string", length=10, nullable=false)
     */
    private $distributivofecha;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivoestado", type="string", length=8, nullable=false)
     */
    private $distributivoestado;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivogrado", type="string", length=2, nullable=true)
     */
    private $distributivogrado;

    /**
     * @var \Periodos
     *
     * @ORM\ManyToOne(targetEntity="Periodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodperiodo", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodperiodo;

    /**
     * @var \Docentes
     *
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocoddocente", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocoddocente;

    /**
     * @var \Materias
     *
     * @ORM\ManyToOne(targetEntity="Materias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodmateria", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodmateria;

    /**
     * @var \Cursos
     *
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodcurso", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodcurso;

    /**
     * @var \Especializaciones
     *
     * @ORM\ManyToOne(targetEntity="Especializaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodespecializacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodespecializacion;



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
     * Set distributivoparalelo
     *
     * @param string $distributivoparalelo
     *
     * @return Distributivos
     */
    public function setDistributivoparalelo($distributivoparalelo)
    {
        $this->distributivoparalelo = $distributivoparalelo;

        return $this;
    }

    /**
     * Get distributivoparalelo
     *
     * @return string
     */
    public function getDistributivoparalelo()
    {
        return $this->distributivoparalelo;
    }

    /**
     * Set distributivoseccion
     *
     * @param string $distributivoseccion
     *
     * @return Distributivos
     */
    public function setDistributivoseccion($distributivoseccion)
    {
        $this->distributivoseccion = $distributivoseccion;

        return $this;
    }

    /**
     * Get distributivoseccion
     *
     * @return string
     */
    public function getDistributivoseccion()
    {
        return $this->distributivoseccion;
    }

    /**
     * Set distributivohora
     *
     * @param string $distributivohora
     *
     * @return Distributivos
     */
    public function setDistributivohora($distributivohora)
    {
        $this->distributivohora = $distributivohora;

        return $this;
    }

    /**
     * Get distributivohora
     *
     * @return string
     */
    public function getDistributivohora()
    {
        return $this->distributivohora;
    }

    /**
     * Set distributivofecha
     *
     * @param string $distributivofecha
     *
     * @return Distributivos
     */
    public function setDistributivofecha($distributivofecha)
    {
        $this->distributivofecha = $distributivofecha;

        return $this;
    }

    /**
     * Get distributivofecha
     *
     * @return string
     */
    public function getDistributivofecha()
    {
        return $this->distributivofecha;
    }

    /**
     * Set distributivoestado
     *
     * @param string $distributivoestado
     *
     * @return Distributivos
     */
    public function setDistributivoestado($distributivoestado)
    {
        $this->distributivoestado = $distributivoestado;

        return $this;
    }

    /**
     * Get distributivoestado
     *
     * @return string
     */
    public function getDistributivoestado()
    {
        return $this->distributivoestado;
    }

    /**
     * Set distributivogrado
     *
     * @param string $distributivogrado
     *
     * @return Distributivos
     */
    public function setDistributivogrado($distributivogrado)
    {
        $this->distributivogrado = $distributivogrado;

        return $this;
    }

    /**
     * Get distributivogrado
     *
     * @return string
     */
    public function getDistributivogrado()
    {
        return $this->distributivogrado;
    }

    /**
     * Set distributivocodperiodo
     *
     * @param \MultiacademicoBundle\Entity\Periodos $distributivocodperiodo
     *
     * @return Distributivos
     */
    public function setDistributivocodperiodo(\MultiacademicoBundle\Entity\Periodos $distributivocodperiodo)
    {
        $this->distributivocodperiodo = $distributivocodperiodo;

        return $this;
    }

    /**
     * Get distributivocodperiodo
     *
     * @return \MultiacademicoBundle\Entity\Periodos
     */
    public function getDistributivocodperiodo()
    {
        return $this->distributivocodperiodo;
    }

    /**
     * Set distributivocoddocente
     *
     * @param \MultiacademicoBundle\Entity\Docentes $distributivocoddocente
     *
     * @return Distributivos
     */
    public function setDistributivocoddocente(\MultiacademicoBundle\Entity\Docentes $distributivocoddocente)
    {
        $this->distributivocoddocente = $distributivocoddocente;

        return $this;
    }

    /**
     * Get distributivocoddocente
     *
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getDistributivocoddocente()
    {
        return $this->distributivocoddocente;
    }

    /**
     * Set distributivocodmateria
     *
     * @param \MultiacademicoBundle\Entity\Materias $distributivocodmateria
     *
     * @return Distributivos
     */
    public function setDistributivocodmateria(\MultiacademicoBundle\Entity\Materias $distributivocodmateria)
    {
        $this->distributivocodmateria = $distributivocodmateria;

        return $this;
    }

    /**
     * Get distributivocodmateria
     *
     * @return \MultiacademicoBundle\Entity\Materias
     */
    public function getDistributivocodmateria()
    {
        return $this->distributivocodmateria;
    }

    /**
     * Set distributivocodcurso
     *
     * @param \MultiacademicoBundle\Entity\Cursos $distributivocodcurso
     *
     * @return Distributivos
     */
    public function setDistributivocodcurso(\MultiacademicoBundle\Entity\Cursos $distributivocodcurso)
    {
        $this->distributivocodcurso = $distributivocodcurso;

        return $this;
    }

    /**
     * Get distributivocodcurso
     *
     * @return \MultiacademicoBundle\Entity\Cursos
     */
    public function getDistributivocodcurso()
    {
        return $this->distributivocodcurso;
    }

    /**
     * Set distributivocodespecializacion
     *
     * @param \MultiacademicoBundle\Entity\Especializaciones $distributivocodespecializacion
     *
     * @return Distributivos
     */
    public function setDistributivocodespecializacion(\MultiacademicoBundle\Entity\Especializaciones $distributivocodespecializacion)
    {
        $this->distributivocodespecializacion = $distributivocodespecializacion;

        return $this;
    }

    /**
     * Get distributivocodespecializacion
     *
     * @return \MultiacademicoBundle\Entity\Especializaciones
     */
    public function getDistributivocodespecializacion()
    {
        return $this->distributivocodespecializacion;
    }
}
