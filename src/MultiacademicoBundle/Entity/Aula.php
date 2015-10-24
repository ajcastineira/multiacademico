<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Distributivos
 *
 * @ORM\Table(name="aulas")
 * @ORM\Entity()
 * @Serializer\ExclusionPolicy("all")
 */
class Aula
{
    
  
    /**
     * @var \Cursos
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codcurso", referencedColumnName="id", nullable=false)
     * })
     */
    private $curso;

    /**
     * @var \Especializaciones
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Especializaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codespecializacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $especializacion;
    
    
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="paralelo", type="string", length=1, nullable=false)
     */
    private $paralelo;

    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="seccion", type="string", length=20, nullable=false)
     */
    private $seccion;
    
      /**
     * @var \Periodos
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Periodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codperiodo", referencedColumnName="id", nullable=false)
     * })
     */
    private $periodo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=8, nullable=false)
     * 
     */
    private $estado;

    /**
     * * @ORM\OneToMany(targetEntity="Matriculas", mappedBy="aula")
     */
    private $matriculados;
    
    /**
     * * @ORM\OneToMany(targetEntity="Distributivos", mappedBy="aula")
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
        return $this->distributivos;
    }
    /**
     * @Serializer\VirtualProperty
     * @Serializer\SerializedName("aula")
    
     * @Serializer\Groups({"list"})
     * @return string
     */
    public function getAulaName()
    {
        return $this->curso." ".$this->paralelo." ".$this->especializacion." ".$this->seccion;
    }
    
    public function __toString()
    {
        return $this->getAulaName();
    }

}
