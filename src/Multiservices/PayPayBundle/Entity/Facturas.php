<?php

namespace Multiservices\PayPayBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Fresh\DoctrineEnumBundle\Validator\Constraints as DoctrineAssert;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;

/**
 * Facturas
 *
 * @ORM\Table(name="facturas")
 * @ORM\Entity
 */
class Facturas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false,options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="legal", type="integer", nullable=false)
     */
    private $legal=0;

    /**
     * @var \MultiacademicoBundle\Entity\Representantes
     *
     * @ORM\ManyToOne(targetEntity="\MultiacademicoBundle\Entity\Representantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idcliente", referencedColumnName="id")
     * })
     */
    private $idcliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="emitido", type="datetime", nullable=false)
     */
    private $emitido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vencimiento", type="datetime", nullable=false)
     */
    private $vencimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pago", type="datetime", nullable=true)
     */
    private $pago;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $total;

    /**
     * @var string
     *
     * @ORM\Column(name="forma", type="string", length=50, nullable=false,options={"default":"-------"})
     */
    private $forma = '-------';

    /**
     * @var EstadoFacturaType
     *
     * @ORM\Column(name="estado", type="EstadoFacturaType", length=10, nullable=false,options={"default":"No pagado"})
     * @DoctrineAssert\Enum(entity="Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType")     
     */
    private $estado = 'No pagado';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false,options={"default":"1"})
     */
    private $tipo = '1';

    /**
     * @var integer
     *
     * ORM\Column(name="nodo", type="integer", nullable=false)
     */
    private $nodo;

    /**
     * @var string
     *
     * @ORM\Column(name="cobrado", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $cobrado=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="statevencido", type="integer", nullable=false)
     */
    private $statevencido=0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="credito", type="datetime", nullable=false)
     */
    private $credito;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="iva_igv", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $iva_igv;
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="sub_total", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $sub_total;
    
     /**
     * @ORM\OneToMany(targetEntity="\Multiservices\PayPayBundle\Entity\Facturaitems", mappedBy="idfactura", cascade={"persist"})
     */
    private $items;
    
     /**
     * @ORM\OneToOne(targetEntity="MultiacademicoBundle\Entity\Pension", mappedBy="factura")
     */
    private $pension;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->emitido= new \DateTime();
        $this->vencimiento= new \DateTime();
        $this->pago= new \DateTime();
        $this->credito= new \DateTime();
        
        
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
     * Set legal
     *
     * @param integer $legal
     *
     * @return Facturas
     */
    public function setLegal($legal)
    {
        $this->legal = $legal;

        return $this;
    }

    /**
     * Get legal
     *
     * @return integer
     */
    public function getLegal()
    {
        return $this->legal;
    }

    /**
     * Set idcliente
     *
     * @param integer $idcliente
     *
     * @return Facturas
     */
    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;

        return $this;
    }

    /**
     * Get idcliente
     *
     * @return integer
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set emitido
     *
     * @param \DateTime $emitido
     *
     * @return Facturas
     */
    public function setEmitido($emitido)
    {
        $this->emitido = $emitido;

        return $this;
    }

    /**
     * Get emitido
     *
     * @return \DateTime
     */
    public function getEmitido()
    {
        return $this->emitido;
    }

    /**
     * Set vencimiento
     *
     * @param \DateTime $vencimiento
     *
     * @return Facturas
     */
    public function setVencimiento($vencimiento)
    {
        $this->vencimiento = $vencimiento;

        return $this;
    }

    /**
     * Get vencimiento
     *
     * @return \DateTime
     */
    public function getVencimiento()
    {
        return $this->vencimiento;
    }

    /**
     * Set pago
     *
     * @param \DateTime $pago
     *
     * @return Facturas
     */
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
    }

    /**
     * Get pago
     *
     * @return \DateTime
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set total
     *
     * @param string $total
     *
     * @return Facturas
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set forma
     *
     * @param string $forma
     *
     * @return Facturas
     */
    public function setForma($forma)
    {
        $this->forma = $forma;

        return $this;
    }

    /**
     * Get forma
     *
     * @return string
     */
    public function getForma()
    {
        return $this->forma;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Facturas
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Facturas
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set nodo
     *
     * @param integer $nodo
     *
     * @return Facturas
     */
    public function setNodo($nodo)
    {
        $this->nodo = $nodo;

        return $this;
    }

    /**
     * Get nodo
     *
     * @return integer
     */
    public function getNodo()
    {
        return $this->nodo;
    }

    /**
     * Set cobrado
     *
     * @param string $cobrado
     *
     * @return Facturas
     */
    public function setCobrado($cobrado)
    {
        $this->cobrado = $cobrado;

        return $this;
    }

    /**
     * Get cobrado
     *
     * @return string
     */
    public function getCobrado()
    {
        return $this->cobrado;
    }

    /**
     * Set statevencido
     *
     * @param integer $statevencido
     *
     * @return Facturas
     */
    public function setStatevencido($statevencido)
    {
        $this->statevencido = $statevencido;

        return $this;
    }

    /**
     * Get statevencido
     *
     * @return integer
     */
    public function getStatevencido()
    {
        return $this->statevencido;
    }

    /**
     * Set credito
     *
     * @param \DateTime $credito
     *
     * @return Facturas
     */
    public function setCredito($credito)
    {
        $this->credito = $credito;

        return $this;
    }

    /**
     * Get credito
     *
     * @return \DateTime
     */
    public function getCredito()
    {
        return $this->credito;
    }

    /**
     * Set iva_igv
     *
     * @param string $ivaIgv
     * @return Facturas
     */
    public function setIvaIgv($ivaIgv)
    {
        $this->iva_igv = $ivaIgv;

        return $this;
    }

    /**
     * Get iva_igv
     *
     * @return string 
     */
    public function getIvaIgv()
    {
        return $this->iva_igv;
    }

    /**
     * Set sub_total
     *
     * @param string $subTotal
     * @return Facturas
     */
    public function setSubTotal($subTotal)
    {
        $this->sub_total = $subTotal;

        return $this;
    }

    /**
     * Get sub_total
     *
     * @return string 
     */
    public function getSubTotal()
    {
        return $this->sub_total;
    }
    /**
     * Add items
     *
     * @param \Multiservices\PayPayBundle\Entity\FacturaItems $items
     * @return Facturas
     */
    public function addItem(\Multiservices\PayPayBundle\Entity\FacturaItems $items)
    {
        $items->setIdfactura($this);
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \Multiservices\PayPayBundle\Entity\FacturaItems $items
     */
    public function removeItem(\Multiservices\PayPayBundle\Entity\FacturaItems $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
    
    public function calcularFactura() {
        $sum=0;
        $iva=0; //Por concepto de Educacion no se cobra iva
        foreach ($this->items as $item)
        {
            //$item = new Facturaitems();
            $sum+=($item->getPunitario()*$item->getCantidad());
            //$iva=$item->getIdproducto()->getImpuesto();
        }
        $this->sub_total=$sum;
        $this->iva_igv=$this->sub_total*($iva/100);
        $this->total=$this->sub_total+$this->iva_igv;
        return true;
    }

    /**
     * Set pension
     *
     * @param \MultiacademicoBundle\Entity\Pension $pension
     *
     * @return Facturas
     */
    public function setPension(\MultiacademicoBundle\Entity\Pension $pension = null)
    {
        $this->pension = $pension;

        return $this;
    }

    /**
     * Get pension
     *
     * @return \MultiacademicoBundle\Entity\Pension
     */
    public function getPension()
    {
        return $this->pension;
    }
}
