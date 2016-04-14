<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\Collection, Doctrine\Common\Collections\ArrayCollection;

/**
 * Representantes
 *
 * @ORM\Table(name="representantes",  indexes={@ORM\Index(name="representante", columns={"representante"})})
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\RepresentantesRepository")
 * @UniqueEntity({"cedula"}, message="Este numero de cedula ya existe en el sistema")
  * @Serializer\ExclusionPolicy("all")
 */
class Representantes
{
 /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="representante", type="string", length=50, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $representante;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=12, nullable=false)
     */
    private $cedula;


    /**
     * @var string
     *
     * @ORM\Column(name="domicilio", type="string", length=50, nullable=false)
     */
    private $domicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=20, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=5, nullable=false)
     */
    private $tipo;
    

    /**
     * @var float
     *
     * @ORM\Column(name="monto_mensual", type="float", precision=10, scale=0, nullable=false)
     */
    private $montoMensual;

  
    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status=true;

    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     *
     * @ORM\OneToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codusuario", referencedColumnName="id")
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"estadisticas"})
     */
    private $usuario;
    /**
     * 
     * @ORM\OneToMany(targetEntity="\Multiservices\PayPayBundle\Entity\Facturas", mappedBy="idcliente")
     */
    private $facturas;
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set representante
     *
     * @param string $representante
     *
     * @return Representantes
     */
    public function setRepresentante($representante)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get representante
     *
     * @return string
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Set montoMensual
     *
     * @param float $montoMensual
     *
     * @return Representantes
     */
    public function setMontoMensual($montoMensual)
    {
        $this->montoMensual = $montoMensual;

        return $this;
    }

    /**
     * Get montoMensual
     *
     * @return float
     */
    public function getMontoMensual()
    {
        return $this->montoMensual;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Representantes
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * 
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * 
     * @param \Multiservices\ArxisBundle\Entity\Usuario $usuario
     * @return \MultiacademicoBundle\Entity\Representantes
     */
    public function setUsuario(\Multiservices\ArxisBundle\Entity\Usuario $usuario) {
        $this->usuario = $usuario;
        return $this;
    }
    public function __toString() {
        return $this->representante;
    }

    /**
     * Set cedula
     *
     * @param string $cedula
     *
     * @return Representantes
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set domicilio
     *
     * @param string $domicilio
     *
     * @return Representantes
     */
    public function setDomicilio($domicilio)
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    /**
     * Get domicilio
     *
     * @return string
     */
    public function getDomicilio()
    {
        return $this->domicilio;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Representantes
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Representantes
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
     * Add factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     *
     * @return Representantes
     */
    public function addFactura(\Multiservices\PayPayBundle\Entity\Facturas $factura)
    {
        $this->facturas[] = $factura;

        return $this;
    }

    /**
     * Remove factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     */
    public function removeFactura(\Multiservices\PayPayBundle\Entity\Facturas $factura)
    {
        $this->facturas->removeElement($factura);
    }

    /**
     * Get facturas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacturas()
    {
        return $this->facturas;
    }
}
