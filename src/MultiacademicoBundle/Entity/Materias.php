<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Materias
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("none")
 * @UniqueEntity({"materia"}, message="Materia con este nombre ya existe")
 */
class Materias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id",length=10, type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="materia", type="string", length=40, nullable=false)
     * @Serializer\Groups({"list","detail","informejunta"})
     */
    private $materia;

    /**
     * @var string
     *
     * @ORM\Column(name="materiatipo", type="string", length=15, nullable=false)
     */
    private $materiatipo;
    
    /**
     * @var \AreaAcademica
     * @ORM\ManyToMany(targetEntity="AreaAcademica", mappedBy="materias", cascade={"persist"})
     */
    private $areas;

    /**
     * @var string
     *
     * @ORM\Column(name="materiaestado", type="string", length=8, nullable=false)
     * 
     */
    private $materiaestado='ACTIVA';

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     * @Serializer\Groups({"list","detail"})
     * 
     */
    private $prioridad = 20;
    
    /**
     * @var Distributivos
     *
     * @ORM\OneToMany(targetEntity="Distributivos", mappedBy="distributivocodmateria")
     * @Serializer\Groups({"informejunta"})
     */
    private $distributivos;
    
    
    /**
     * @var Calificaciones
     *
     * @ORM\OneToMany(targetEntity="Calificaciones", mappedBy="calificacioncodmateria")
     * @Serializer\Groups({"informejunta"})
     */
    private $calificaciones;


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

    /**
     * Get areas
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getAreas()
    {
        return $this->areas;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->areas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add area
     *
     * @param \MultiacademicoBundle\Entity\AreaAcademica $area
     *
     * @return Materias
     */
    public function addArea(\MultiacademicoBundle\Entity\AreaAcademica $area)
    {
        //$area->addMateria($this);
        if (!$this->areas->contains($area)) {
            //$this->areas[] = $area;
            $this->areas->add($area);
        }
       

        return $this;
    }

    /**
     * Remove area
     *
     * @param \MultiacademicoBundle\Entity\AreaAcademica $area
     */
    public function removeArea(\MultiacademicoBundle\Entity\AreaAcademica $area)
    {
        $this->areas->removeElement($area);
    }

    /**
     * Add distributivo
     *
     * @param \MultiacademicoBundle\Entity\Distributivos $distributivo
     *
     * @return Materias
     */
    public function addDistributivo(\MultiacademicoBundle\Entity\Distributivos $distributivo)
    {
        $this->distributivos[] = $distributivo;

        return $this;
    }

    /**
     * Remove distributivo
     *
     * @param \MultiacademicoBundle\Entity\Distributivos $distributivo
     */
    public function removeDistributivo(\MultiacademicoBundle\Entity\Distributivos $distributivo)
    {
        $this->distributivos->removeElement($distributivo);
    }

    /**
     * Get distributivos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDistributivos()
    {
        return $this->distributivos;
    }
}
