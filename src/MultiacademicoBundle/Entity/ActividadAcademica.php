<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * ActividadAcademica
 *
 * @ORM\Table(name="actividad_academica")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\ActividadAcademicaRepository")
 * @ORM\EntityListeners({"MultiacademicoBundle\EventListener\ActividadAcademicaListener"}) 
 * @ORM\HasLifecycleCallbacks()
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
            
     /**
     * @var ActividadAcademicaDetalle
     *
     * @ORM\OneToMany(targetEntity="ActividadAcademicaDetalle", mappedBy="actividad")
     */
    private $detalle;
    
    public function __construct() {
        $this->fechaEntrega=new \DateTime();
        $this->fechaEnvio=new \DateTime();
        $this->detalle= new ArrayCollection();
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

    /**
     * Add detalle
     *
     * @param \MultiacademicoBundle\Entity\ActividadAcademicaDetalle $detalle
     *
     * @return ActividadAcademica
     */
    public function addDetalle(\MultiacademicoBundle\Entity\ActividadAcademicaDetalle $detalle)
    {
        $this->detalle[] = $detalle;

        return $this;
    }

    /**
     * Remove detalle
     *
     * @param \MultiacademicoBundle\Entity\ActividadAcademicaDetalle $detalle
     */
    public function removeDetalle(\MultiacademicoBundle\Entity\ActividadAcademicaDetalle $detalle)
    {
        $this->detalle->removeElement($detalle);
    }

    /**
     * Get detalle
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetalle()
    {
        return $this->detalle;
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
        return 'uploads/documents/actividades/enviadas';
    }
    
    /**
     * @Assert\File(maxSize="6000000",
                   mimeTypes = {"image/*",
                               "application/pdf", "application/x-pdf",
                               "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
                               "application/vnd.ms-excel" , "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                               "application/vnd.ms-powerpoint", "application/vnd.openxmlformats-officedocument.presentationml.presentation",
     *                         "application/x-rar-compressed", "application/octet-stream",
     *                         "application/zip"
                               },
                   mimeTypesMessage = "Por favor suba una imagen valida")
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
    
    public function __toString(){
       return $this->titulo;

    }
}