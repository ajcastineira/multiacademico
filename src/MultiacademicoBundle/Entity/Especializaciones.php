<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especializaciones
 *
 * @ORM\Table(name="especializaciones")
 * @ORM\Entity
 */
class Especializaciones
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
     * @ORM\Column(name="especializacion", type="string", length=50, nullable=false)
     */
    private $especializacion;

    /**
     * @var string
     *
     * @ORM\Column(name="especializacionestado", type="string", length=8, nullable=false)
     */
    private $especializacionestado;



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
     * Set especializacion
     *
     * @param string $especializacion
     *
     * @return Especializaciones
     */
    public function setEspecializacion($especializacion)
    {
        $this->especializacion = $especializacion;

        return $this;
    }

    /**
     * Get especializacion
     *
     * @return string
     */
    public function getEspecializacion()
    {
        return $this->especializacion;
    }

    /**
     * Set especializacionestado
     *
     * @param string $especializacionestado
     *
     * @return Especializaciones
     */
    public function setEspecializacionestado($especializacionestado)
    {
        $this->especializacionestado = $especializacionestado;

        return $this;
    }

    /**
     * Get especializacionestado
     *
     * @return string
     */
    public function getEspecializacionestado()
    {
        return $this->especializacionestado;
    }
    public function __toString() {
        return $this->especializacion;
    }
}
