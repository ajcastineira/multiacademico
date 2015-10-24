<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Materias
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("none")
 */
class Materias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id",length=10, type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"list","detail"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="materia", type="string", length=40, nullable=false)
     * @Serializer\Groups({"list","detail"})
     */
    private $materia;

    /**
     * @var string
     *
     * @ORM\Column(name="materiatipo", type="string", length=15, nullable=false)
     */
    private $materiatipo;

    /**
     * @var string
     *
     * @ORM\Column(name="materiaestado", type="string", length=8, nullable=false)
     */
    private $materiaestado;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad = '20';



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
     * Set materia
     *
     * @param string $materia
     *
     * @return Materias
     */
    public function setMateria($materia)
    {
        $this->materia = $materia;

        return $this;
    }

    /**
     * Get materia
     *
     * @return string
     */
    public function getMateria()
    {
        return $this->materia;
    }

    /**
     * Set materiatipo
     *
     * @param string $materiatipo
     *
     * @return Materias
     */
    public function setMateriatipo($materiatipo)
    {
        $this->materiatipo = $materiatipo;

        return $this;
    }

    /**
     * Get materiatipo
     *
     * @return string
     */
    public function getMateriatipo()
    {
        return $this->materiatipo;
    }

    /**
     * Set materiaestado
     *
     * @param string $materiaestado
     *
     * @return Materias
     */
    public function setMateriaestado($materiaestado)
    {
        $this->materiaestado = $materiaestado;

        return $this;
    }

    /**
     * Get materiaestado
     *
     * @return string
     */
    public function getMateriaestado()
    {
        return $this->materiaestado;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     *
     * @return Materias
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return integer
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }
    
    public function __toString() {
        return $this->materia;
    }
}
