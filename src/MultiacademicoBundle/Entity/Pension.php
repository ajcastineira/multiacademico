<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Multiservices\PayPayBundle\Entity\Facturas;

/**
 * Pension
 *
 * @ORM\Table(name="pensiones")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Entity\PensionRepository")
 * Serializer\ExclusionPolicy("all")
 */
class Pension
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * Serializer\Expose
     * Serializer\Groups({"list","detail"})
     */
    private $id;
    
    /**
     * @var \MultiacademicoBundle\Entity\Estudiantes
     *
     * @ORM\ManyToOne(targetEntity="Estudiantes", inversedBy="pensiones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estudiante", referencedColumnName="id",nullable=false)
     * })
     * @Serializer\Expose
     * Serializer\Groups({"list","detail","estadisticas"})
     * Serializer\Type("MultiacademicoBundle\Entity\Estudiantes")
   
     */
    private $estudiante;
    
    /**
     * @var \Multiservices\PayPayBundle\Entity\Facturas
     *
     * @ORM\OneToOne(targetEntity="\Multiservices\PayPayBundle\Entity\Facturas", inversedBy="pension")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="factura_id", referencedColumnName="id")
     * })
     * Serializer\Expose
     * Serializer\Groups({"estadisticas"})
     */
    private $factura;

    
    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", nullable=true)
     */
    private $info;
    
    
    public function __toString() {
        return $this->info;
    }

    /**
     * Set estudiante
     *
     * @param \MultiacademicoBundle\Entity\Estudiantes $estudiante
     *
     * @return Pension
     */
    public function setEstudiante(\MultiacademicoBundle\Entity\Estudiantes $estudiante)
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * Get estudiante
     *
     * @return \MultiacademicoBundle\Entity\Estudiantes
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set factura
     *
     * @param \Multiservices\PayPayBundle\Entity\Facturas $factura
     *
     * @return Pension
     */
    public function setFactura(\Multiservices\PayPayBundle\Entity\Facturas $factura)
    {
        $this->factura = $factura;

        return $this;
    }

    /**
     * Get factura
     *
     * @return \Multiservices\PayPayBundle\Entity\Facturas
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return Pension
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
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
}
