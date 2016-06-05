<?php

namespace MultiacademicoBundle\Entity;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActividadAcademicaDetalle
 *
 * @ORM\Table(name="actividad_academica_detalle")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\ActividadAcademicaDetalleRepository")
 * @ORM\EntityListeners({"MultiacademicoBundle\EventListener\ActividadAcademicaDetalleListener"}) 
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
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion='';
    
    /**
     * @var text
     *
     * @ORM\Column(name="observacion", type="text", nullable=true)
     */
    private $observacion;

    /**
     * @var float
     *
     * @ORM\Column(name="calificacion", type="float", precision=10, scale=2, nullable=true)
     */
    private $calificacion=0.00;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="entregada", type="boolean")
     */
    private $entregada=false;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="fechaEntregada", type="datetime", nullable=true)
     */
    private $fechaEntregada;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="revisada", type="boolean")
     */
    private $revisada=false;
    
    /**
     * @var datetime
     *
     * @ORM\Column(name="fechaRevisada", type="datetime", nullable=true)
     */
    private $fechaRevisada;
    
    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=255, nullable=true)
     */
    private $archivo;
    
    /**
     * @var EstadoFacturaType
     *
     * @ORM\Column(name="estado", type="EstadoActividadAcademicaType", length=10, nullable=false,options={"default":"pendiente","comment":"Estado de Detalle de Actividad Academica"})
     * @DoctrineAssert\Enum(entity="MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType")     
     */
    private $estado=EstadoActividadAcademicaType::PENDIENTE;
    
    /**
     * @var Distributivos
     *
     * @ORM\ManyToOne(targetEntity="ActividadAcademica", inversedBy="detalle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="actividad", referencedColumnName="id", nullable=false)
     * })
     */
    private $actividad;

    public function __construct() {
        
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

    /**
     * Set actividad
     *
     * @param \MultiacademicoBundle\Entity\ActividadAcademica $actividad
     *
     * @return ActividadAcademicaDetalle
     */
    public function setActividad(\MultiacademicoBundle\Entity\ActividadAcademica $actividad)
    {
        $this->actividad = $actividad;

        return $this;
    }

    /**
     * Get actividad
     *
     * @return \MultiacademicoBundle\Entity\ActividadAcademica
     */
    public function getActividad()
    {
        return $this->actividad;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     *
     * @return ActividadAcademicaDetalle
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
    
     public function getAbsolutePath()
    {
        return null === $this->archivo
            ? null
            : $this->getUploadRootDir().'/'.$this->archivo;
    }
    /**
     * Serializer\VirtualProperty
     * Serializer\SerializedName("picture")
     * Serializer\Groups({"estadisticas","activities"})
     */
    public function getWebPath()
    {
        return null === $this->archivo
            //? null
            ? null
            : $this->getUploadDir().'/'.$this->archivo;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents/actividades/recibidas';
    }
    
    /**
     * @Assert\File(maxSize="6000000",
                   mimeTypes = {"image/*",
                               "application/pdf", "application/x-pdf",
                               "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                               "application/vnd.ms-excel" , "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                               "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                               "application/x-rar-compressed", "application/octet-stream",
                               "application/zip"
                               },
                   mimeTypesMessage = "Por favor suba un archivo valido o permitido")
     */
    private $file;

    private $temp;
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->archivo)) {
            // store the old name to delete after the update
            $this->temp = $this->archivo;
            $this->archivo= null;
        } else {
            $this->archivo = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->archivo = $filename.'.'.$this->getFile()->guessExtension();
        }
    }


    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->archivo);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            
            unlink($this->getUploadRootDir().'/'.$this->temp);
            
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }
 
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            try{
            unlink($file);
            }catch(\Exception $e)
            {}
        }
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return ActividadAcademicaDetalle
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
     * Set observacion
     *
     * @param string $observacion
     *
     * @return ActividadAcademicaDetalle
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }
}
