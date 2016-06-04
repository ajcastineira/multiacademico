<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;

/**
 * ActividadAcademica
 *
 * @ORM\Table(name="actividad_academica")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\ActividadAcademicaRepository")
 * @ORM\EntityListeners({"MultiacademicoBundle\EventListener\ActividadAcademicaListener"}) 
 */
class ActividadAcademica
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
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var Distributivos
     *
     * @ORM\ManyToOne(targetEntity="Distributivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivo", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;
    
    /**
     * @var EstadoFacturaType
     *
     * @ORM\Column(name="estado", type="EstadoActividadAcademicaType", length=10, nullable=false,options={"default":"pendiente","comment":"Estado de Actividad Academica"})
     * @DoctrineAssert\Enum(entity="MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType")     
     */
    private $estado=EstadoActividadAcademicaType::PENDIENTE;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEnvio", type="datetime")
     */
    private $fechaEnvio;

    /**
     * @var string
     *
     * @ORM\Column(name="fechaEntrega", type="datetime")
     */
    private $fechaEntrega;

     /**
     * @var Docentes
     *
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sendBy", referencedColumnName="id", nullable=false)
     * })
     */
    private $sendBy;
    
    public function __construct() {
        $this->fechaEntrega=new \DateTime();
        $this->fechaEnvio=new \DateTime();
    }

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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return ActividadAcademica
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return ActividadAcademica
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return ActividadAcademica
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
     * Set archivo
     *
     * @param string $archivo
     *
     * @return ActividadAcademica
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set fechaEnvio
     *
     * @param \DateTime $fechaEnvio
     *
     * @return ActividadAcademica
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fechaEnvio = $fechaEnvio;

        return $this;
    }

    /**
     * Get fechaEnvio
     *
     * @return \DateTime
     */
    public function getFechaEnvio()
    {
        return $this->fechaEnvio;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return ActividadAcademica
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set distributivo
     *
     * @param \MultiacademicoBundle\Entity\Distributivos $distributivo
     *
     * @return ActividadAcademica
     */
    public function setDistributivo(\MultiacademicoBundle\Entity\Distributivos $distributivo)
    {
        $this->distributivo = $distributivo;

        return $this;
    }

    /**
     * Get distributivo
     *
     * @return \MultiacademicoBundle\Entity\Distributivos
     */
    public function getDistributivo()
    {
        return $this->distributivo;
    }

    /**
     * Set sendBy
     *
     * @param \MultiacademicoBundle\Entity\Docentes $sendBy
     *
     * @return ActividadAcademica
     */
    public function setSendBy(\MultiacademicoBundle\Entity\Docentes $sendBy)
    {
        $this->sendBy = $sendBy;

        return $this;
    }

    /**
     * Get sendBy
     *
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getSendBy()
    {
        return $this->sendBy;
    }

    /**
     * Set estado
     *
     * @param EstadoActividadAcademicaType $estado
     *
     * @return ActividadAcademica
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return EstadoActividadAcademicaType
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
