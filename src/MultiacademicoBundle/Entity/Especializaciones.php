<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Especializaciones
 *
 * @ORM\Table(name="especializaciones")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class Especializaciones
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
     * @ORM\Column(name="especializacion", type="string", length=50, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $especializacion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipotitulo", type="string", length=50, nullable=true)
     */
    private $tipotitulo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150, nullable=true)
     */
    private $titulo;
    
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
    
    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Especializaciones
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
     * Set tipotitulo
     *
     * @param string $tipotitulo
     *
     * @return Especializaciones
     */
    public function setTipotitulo($tipotitulo)
    {
        $this->tipotitulo = $tipotitulo;

        return $this;
    }

    /**
     * Get tipotitulo
     *
     * @return string
     */
    public function getTipotitulo()
    {
        return $this->tipotitulo;
    }
    
    public function __toString() {
        return $this->especializacion;
    }
}
