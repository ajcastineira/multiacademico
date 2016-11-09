<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * AreaAcademica
 *
 * @ORM\Table(name="area_academica")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Entity\AreaAcademicaRepository")
 * ORM\Cache(usage="READ_ONLY")
 * @Serializer\ExclusionPolicy("all")
 * @UniqueEntity({"nombre"}, message="El Area Academica ya existe")
 */
class AreaAcademica
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
     * @ORM\Column(name="nombre", type="string", length=80, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     * 
     */
    private $nombre;
    
     /**
     * @var \Docentes
     
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="director", referencedColumnName="id", nullable=true)
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $director;
    
     /**
     * @var \Docentes
     
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="subdirector", referencedColumnName="id", nullable=true)
     * })
     */
    private $subdirector;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=8, nullable=false)
     * 
     */
    private $estado='ACTIVA';
    

    /**
     * 
     * @ORM\ManyToMany(targetEntity="Materias", inversedBy="areas")
     * @ORM\JoinTable(name="area_academica_materias",
     *   joinColumns={
     *     @ORM\JoinColumn(name="area_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="materia_id", referencedColumnName="id")
     *   }
     * )
     * Serializer\Expose
     * Serializer\Groups({"detail"})
     * Serializer\Accessor(getter="getMatriculados")
     * Serializer\Type("ArrayCollection<MultiacademicoBundle\Entity\Materias>")
     */
    private $materias;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->materias= new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return AreaAcademica
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return AreaAcademica
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
     * Set director
     *
     * @param \MultiacademicoBundle\Entity\Docentes $director
     *
     * @return AreaAcademica
     */
    public function setDirector(\MultiacademicoBundle\Entity\Docentes $director = null)
    {
        $this->director = $director;

        return $this;
    }

    /**
     * Get director
     *
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * Set subdirector
     *
     * @param \MultiacademicoBundle\Entity\Docentes $subdirector
     *
     * @return AreaAcademica
     */
    public function setSubdirector(\MultiacademicoBundle\Entity\Docentes $subdirector = null)
    {
        $this->subdirector = $subdirector;

        return $this;
    }

    /**
     * Get subdirector
     *
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getSubdirector()
    {
        return $this->subdirector;
    }

    /**
     * Get materias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMaterias()
    {
        
        return $this->materias;
    }

    /**
     * Add materia
     *
     * @param \MultiacademicoBundle\Entity\Materias $materia
     *
     * @return AreaAcademica
     */
    public function addMateria(\MultiacademicoBundle\Entity\Materias $materia)
    {
        $materia->addArea($this);
        //$this->materias[] = $materia;
        if (!$this->materias->contains($materia)) {
            $this->materias->add($materia);
        }
        
        return $this;
    }

    /**
     * Remove materia
     *
     * @param \MultiacademicoBundle\Entity\Materias $materia
     */
    public function removeMateria(\MultiacademicoBundle\Entity\Materias $materia)
    {
        $this->materias->removeElement($materia);
    }
    
    public function __toString() {
        return $this->nombre;
    }
}
