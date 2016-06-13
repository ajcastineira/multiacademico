<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Aula
 *
 * @ORM\Table(name="aulas")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Entity\AulaRepository")
 * @Serializer\ExclusionPolicy("all")
 * @UniqueEntity({"curso","especializacion","paralelo","seccion","periodo"}, message="El Aula con esta combinacion ya existe")
 */
class Aula
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
     * @var \Cursos
     * 
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codcurso", referencedColumnName="id", nullable=false)
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     * @Serializer\Type("MultiacademicoBundle\Entity\Cursos")
     */
    private $curso;

    /**
     * @var \Especializaciones
     * 
     * @ORM\ManyToOne(targetEntity="Especializaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codespecializacion", referencedColumnName="id", nullable=false)
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $especializacion;
    
    
    /**
     * @var string
     * 
     * @ORM\Column(name="paralelo", type="string", length=1, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $paralelo;

    /**
     * @var string
     * 
     * @ORM\Column(name="seccion", type="string", length=20, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $seccion;
    
      /**
     * @var \Periodos
     * 
     * @ORM\ManyToOne(targetEntity="Periodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codperiodo", referencedColumnName="id", nullable=false)
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $periodo;
    
     /**
     * @var \Docentes
     
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="coddocentetutor", referencedColumnName="id", nullable=true)
     * })
     */
    private $tutor;
    
     /**
     * @var \Docentes
     
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inspector_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $inspector;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=8, nullable=false)
     * 
     */
    private $estado;
    
    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=50, nullable=true)
     * 
     */
    private $alias;

    /**
     * @ORM\OneToMany(targetEntity="Matriculas", mappedBy="aula")
     * @Serializer\Expose
     * @Serializer\Groups({"detail"})
     * @Serializer\Accessor(getter="getMatriculados")
     * @Serializer\Type("ArrayCollection<MultiacademicoBundle\Entity\Matriculas>")
     */
    private $matriculados;
    
    /**
     * @ORM\OneToMany(targetEntity="Distributivos", mappedBy="aula")
     * @Serializer\Expose
     * @Serializer\Accessor(getter="getDistributivos")
     * @Serializer\Groups({"detail"})
     
     * @Serializer\Type("ArrayCollection<MultiacademicoBundle\Entity\Distributivos>")
     */
    private $distributivos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->matriculados = new \Doctrine\Common\Collections\ArrayCollection();
        $this->distributivos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set paralelo
     *
     * @param string $paralelo
     *
     * @return Aula
     */
    public function setParalelo($paralelo)
    {
        $this->paralelo = $paralelo;

        return $this;
    }

    /**
     * Get paralelo
     *
     * @return string
     */
    public function getParalelo()
    {
        return $this->paralelo;
    }

    /**
     * Set seccion
     *
     * @param string $seccion
     *
     * @return Aula
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return string
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Aula
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
     * Set curso
     *
     * @param \MultiacademicoBundle\Entity\Cursos $curso
     *
     * @return Aula
     */
    public function setCurso(\MultiacademicoBundle\Entity\Cursos $curso)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \MultiacademicoBundle\Entity\Cursos
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set especializacion
     *
     * @param \MultiacademicoBundle\Entity\Especializaciones $especializacion
     *
     * @return Aula
     */
    public function setEspecializacion(\MultiacademicoBundle\Entity\Especializaciones $especializacion)
    {
        $this->especializacion = $especializacion;

        return $this;
    }

    /**
     * Get especializacion
     *
     * @return \MultiacademicoBundle\Entity\Especializaciones
     */
    public function getEspecializacion()
    {
        return $this->especializacion;
    }

    /**
     * Set periodo
     *
     * @param \MultiacademicoBundle\Entity\Periodos $periodo
     *
     * @return Aula
     */
    public function setPeriodo(\MultiacademicoBundle\Entity\Periodos $periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return \MultiacademicoBundle\Entity\Periodos
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }
    /**
     * 
     * @param \MultiacademicoBundle\Entity\Docentes $tutor
     * @return \MultiacademicoBundle\Entity\Aula
     */
    public function setTutor(\MultiacademicoBundle\Entity\Docentes $tutor) {
        $this->tutor = $tutor;
        return $this;
    }

     /**
    
      * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getTutor()
    {
        return $this->tutor;
    }
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("tutor")
     * @Serializer\Groups({"list"})
     * @return string
     */
    public function getTutorName()
    {
        if (isset($this->tutor))
        {return $this->tutor->getDocente();}
        else
        {return "No se ha asignado";}
    }

    /**
     * Add matriculado
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $matriculado
     *
     * @return Aula
     */
    public function addMatriculado(\MultiacademicoBundle\Entity\Matriculas $matriculado)
    {
        $this->matriculados[] = $matriculado;

        return $this;
    }

    /**
     * Remove matriculado
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $matriculado
     */
    public function removeMatriculado(\MultiacademicoBundle\Entity\Matriculas $matriculado)
    {
        $this->matriculados->removeElement($matriculado);
    }

    /**
     * Get matriculados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMatriculados()
    {
        $iterator = $this->matriculados->getIterator();
        $iterator->uasort(function ($a, $b) {
            return ($a->getMatriculacodestudiante()->getEstudiante() < $b->getMatriculacodestudiante()->getEstudiante()) ? -1 : 1;
        });
        $this->matriculados = new ArrayCollection(iterator_to_array($iterator,false));
        
        return $this->matriculados;
    }
    
    /**
     * Add distributivo
     *
     * @param \MultiacademicoBundle\Entity\Distributivos $distributivo
     *
     * @return Aula
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
        
       $this->distributivos= $this->distributivos->filter(
               function($entry)  {
                if ($entry->getDistributivocodmateria()->getMateria()!= 'Tutor/a'&&$entry->getDistributivocodmateria()->getMateria()!= 'Inspector/a')
                return array($entry);
                }
               );
        return $this->distributivos;
    }
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("aula")
    
     * @Serializer\Groups({"list","detail"})
     * @return string
     */
    public function getAulaName()
    {
        if ($this->alias!="")
        {return $this->curso." ".$this->paralelo." ".$this->especializacion." ".$this->seccion." \"".$this->alias."\"";}
        else
        {return $this->curso." ".$this->paralelo." ".$this->especializacion." ".$this->seccion;}
    }
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("totalalumnos")
    
     * @Serializer\Groups({"list"})
     * @return string
     */
    public function getTotalAlumnosAula()
    {
        return count($this->matriculados);
    }
    
    public function __toString()
    {
        return $this->getAulaName();
    }
    
    


    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Aula
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set inspector
     *
     * @param \MultiacademicoBundle\Entity\Docentes $inspector
     *
     * @return Aula
     */
    public function setInspector(\MultiacademicoBundle\Entity\Docentes $inspector = null)
    {
        $this->inspector = $inspector;

        return $this;
    }

    /**
     * Get inspector
     *
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getInspector()
    {
        return $this->inspector;
    }
}
