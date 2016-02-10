<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pensiones
 *
 * @ORM\Table(name="pensiones")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\PensionesRepository")
 */
class Pensiones
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
     * @ORM\Column(name="fecha_pago", type="string", length=255)
     */
    private $fechaPago;

    /**
     * @var string
     *
     * @ORM\Column(name="monto", type="string", length=255)
     */
    private $monto;

    /**
     * @var int
     *
     * @ORM\Column(name="estudiante_id", type="integer")
     */
    private $estudianteId;


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
     * Set fechaPago
     *
     * @param string $fechaPago
     *
     * @return Pensiones
     */
    public function setFechaPago($fechaPago)
    {
        $this->fechaPago = $fechaPago;

        return $this;
    }

    /**
     * Get fechaPago
     *
     * @return string
     */
    public function getFechaPago()
    {
        return $this->fechaPago;
    }

    /**
     * Set monto
     *
     * @param string $monto
     *
     * @return Pensiones
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return string
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set estudianteId
     *
     * @param integer $estudianteId
     *
     * @return Pensiones
     */
    public function setEstudianteId($estudianteId)
    {
        $this->estudianteId = $estudianteId;

        return $this;
    }

    /**
     * Get estudianteId
     *
     * @return int
     */
    public function getEstudianteId()
    {
        return $this->estudianteId;
    }
}

