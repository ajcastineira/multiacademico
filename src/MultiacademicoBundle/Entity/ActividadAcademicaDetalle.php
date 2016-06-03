<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActividadAcademicaDetalle
 *
 * @ORM\Table(name="actividad_academica_detalle")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\ActividadAcademicaDetalleRepository")
 */
class ActividadAcademicaDetalle
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Matriculas
     *
     * @ORM\ManyToOne(targetEntity="Matriculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matricula", referencedColumnName="id", nullable=false)
     * })
     */
    private $matricula;

    /**
     * @var float
     *
     * @ORM\Column(name="calificacion", type="float", precision=10, scale=2)
     */
    private $calificacion;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="entregada", type="boolean")
     */
    private $entregada;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="fechaEntregada", type="datetime")
     */
    private $fechaEntregada;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="revisada", type="boolean")
     */
    private $revisada;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="fechaRevisada", type="datetime")
     */
    private $fechaRevisada;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="boolean")
     */
    private $estado;


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
     * Set calificacion
     *
     * @param float $calificacion
     *
     * @return ActividadAcademicaDetalle
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return float
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set entregada
     *
     * @param boolean $entregada
     *
     * @return ActividadAcademicaDetalle
     */
    public function setEntregada($entregada)
    {
        $this->entregada = $entregada;

        return $this;
    }

    /**
     * Get entregada
     *
     * @return boolean
     */
    public function getEntregada()
    {
        return $this->entregada;
    }

    /**
     * Set fechaEntregada
     *
     * @param \DateTime $fechaEntregada
     *
     * @return ActividadAcademicaDetalle
     */
    public function setFechaEntregada($fechaEntregada)
    {
        $this->fechaEntregada = $fechaEntregada;

        return $this;
    }

    /**
     * Get fechaEntregada
     *
     * @return \DateTime
     */
    public function getFechaEntregada()
    {
        return $this->fechaEntregada;
    }

    /**
     * Set revisada
     *
     * @param boolean $revisada
     *
     * @return ActividadAcademicaDetalle
     */
    public function setRevisada($revisada)
    {
        $this->revisada = $revisada;

        return $this;
    }

    /**
     * Get revisada
     *
     * @return boolean
     */
    public function getRevisada()
    {
        return $this->revisada;
    }

    /**
     * Set fechaRevisada
     *
     * @param \DateTime $fechaRevisada
     *
     * @return ActividadAcademicaDetalle
     */
    public function setFechaRevisada($fechaRevisada)
    {
        $this->fechaRevisada = $fechaRevisada;

        return $this;
    }

    /**
     * Get fechaRevisada
     *
     * @return \DateTime
     */
    public function getFechaRevisada()
    {
        return $this->fechaRevisada;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return ActividadAcademicaDetalle
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set matricula
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $matricula
     *
     * @return ActividadAcademicaDetalle
     */
    public function setMatricula(\MultiacademicoBundle\Entity\Matriculas $matricula)
    {
        $this->matricula = $matricula;

        return $this;
    }

    /**
     * Get matricula
     *
     * @return \MultiacademicoBundle\Entity\Matriculas
     */
    public function getMatricula()
    {
        return $this->matricula;
    }
}
