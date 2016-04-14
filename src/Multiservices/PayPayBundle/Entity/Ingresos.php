<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
/**
 * Ingresos
 *
 * @ORM\Table(name="ingresos", indexes={@ORM\Index(name="representante_id", columns={"representante_id"}), @ORM\Index(name="collectedby", columns={"collectedby"})})
 * @ORM\Entity(repositoryClass="Multiservices\PayPayBundle\Entity\IngresosRepository")
 */
class Ingresos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false,options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="collectedby", referencedColumnName="id")
     * })
     */
    private $collectedby;
    
    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modifiedby", referencedColumnName="id")
     * })
     */
    private $modifiedby;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    
    private $fecha;
    
    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="float", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Type(
     *     type="double",
     *     message="El valor {{ value }} no es valido {{ type }}."
     * )
     */
    private $monto;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="cambio", type="float", precision=10, scale=2, nullable=false)
     * 
     */
    private $cambio;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=256, nullable=true)
     */
    private $descripcion;

    /**
     * @var \Multiservices\PayPayBundle\Entity\FormasPagos
     *
     * @ORM\ManyToOne(targetEntity="\Multiservices\PayPayBundle\Entity\FormasPagos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="forma_pago_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $formaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=50, nullable=true)
     */
    private $referencia;

    /**
     * @var \MultiacademicoBundle\Entity\Representantes
     *
     * @ORM\ManyToOne(targetEntity="\MultiacademicoBundle\Entity\Representantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representante_id", referencedColumnName="id")
     * })
     */
    private $representante;
    
    
    /**
     * @var \Multiservices\PayPayBundle\Entity\Facturas
     *
     * @ORM\ManyToMany(targetEntity="\Multiservices\PayPayBundle\Entity\Facturas", inversedBy="abonos")
     * @ORM\JoinTable(name="facturas_ingresos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ingreso_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
     *   }
     * )
     */
    private $facturas;
    
    public function __construct() {       
       $this->fecha=New \DateTime();

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
     * Set collectedby
     *
     * @param \Multiservices\ArxisBundle\Entity\Usuario $collectedby
     * @return Ingresos
     */
    public function setCollectedby(\Multiservices\ArxisBundle\Entity\Usuario $collectedby = null)
    {
        $this->collectedby = $collectedby;

        return $this;
    }

    /**
     * Get collectedby
     *
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getCollectedby()
    {
        return $this->collectedby;
    }
    
    /**
     * Set modifiedby
     *
     * @param \Multiservices\ArxisBundle\Entity\Usuario $modifiedby
     * @return Ingresos
     */
    public function setModifiedby(\Multiservices\ArxisBundle\Entity\Usuario $modifiedby = null)
    {
        $this->modifiedby = $modifiedby;

        return $this;
    }

    /**
     * Get modifiedby
     *
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }
    /**
   
   /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Ingresos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }    

    /**
     * Set monto
     *
     * @param float $monto
     * @return Ingresos
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return float 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Ingresos
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
     * Set formaPago
     *
     * @param \Multiservices\PayPayBundle\Entity\FormasPagos $formaPago
     * @return Ingresos
     */
    public function setFormaPago(\Multiservices\PayPayBundle\Entity\FormasPagos $formaPago = null)
    {
        $this->formaPago= $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return \Multiservices\PayPayBundle\Entity\FormasPagos 
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Ingresos
     */
    public function setReferencia($referencia)
    {
    	$this->referencia = $referencia;
    
    	return $this;
    }
    
    /**
     * Get referencia
     *
     * @return string
     */
    public function getReferencia()
    {
    	return $this->referencia;
    } 
    
   
    

    /**
     * Set representante
     *
     * @param \MultiacademicoBundle\Entity\Representantes $representante
     *
     * @return Ingresos
     */
    public function setRepresentante(\MultiacademicoBundle\Entity\Representantes $representante = null)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get representante
     *
     * @return \MultiacademicoBundle\Entity\Representantes
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Add factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     *
     * @return Ingresos
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
     * Get factura
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacturas()
    {
        return $this->facturas;
    }
    
    public function registrarPagoEnFacturas()
    {
        $saldo=$this->getMonto();
        foreach ($this->getFacturas() as &$factura)
        {
            if ($saldo>=$factura->saldoAPagar())
            {
                $saldo=$saldo-$factura->saldoAPagar();
                $factura->setCobrado($factura->getCobrado()+$factura->saldoAPagar());
                $factura->setEstado(EstadoFacturaType::PAGADA);
                $factura->setPago(New \DateTime());
                
                
            }else
            {
                $factura->setCobrado($factura->getCobrado()+$saldo);
                //$factura->setEstado(EstadoFacturaType::NOPAGADA);
                $saldo=0;
            }
        }
        $this->setCambio($saldo);
    }

    /**
     * Set cambio
     *
     * @param float $cambio
     *
     * @return Ingresos
     */
    public function setCambio($cambio)
    {
        $this->cambio = $cambio;

        return $this;
    }

    /**
     * Get cambio
     *
     * @return float
     */
    public function getCambio()
    {
        return $this->cambio;
    }
}
