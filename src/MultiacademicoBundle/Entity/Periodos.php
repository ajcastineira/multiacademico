<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Periodos
 *
 * @ORM\Table(name="periodos")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("all")
 */
class Periodos
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
     * @ORM\Column(name="periodo", type="string", length=15, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $periodo;

    /**
     * @var string
     *
     * @ORM\Column(name="periodoestado", type="string", length=8, nullable=false)
     */
    private $periodoestado;



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
     * Set periodo
     *
     * @param string $periodo
     *
     * @return Periodos
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return string
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set periodoestado
     *
     * @param string $periodoestado
     *
     * @return Periodos
     */
    public function setPeriodoestado($periodoestado)
    {
        $this->periodoestado = $periodoestado;

        return $this;
    }

    /**
     * Get periodoestado
     *
     * @return string
     */
    public function getPeriodoestado()
    {
        return $this->periodoestado;
    }
    
    public function __toString() {
        return $this->periodo;
    }
}
