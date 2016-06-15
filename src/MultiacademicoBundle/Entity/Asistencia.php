<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia")
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\AsistenciaRepository")
 */
class Asistencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="at_p1_q1", type="string", length=4, nullable=false)
     */
    private $atP1Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p1_q1", type="string", length=4, nullable=false)
     */
    private $fjP1Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p1_q1", type="string", length=4, nullable=false)
     */
    private $fiP1Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p2_q1", type="string", length=4, nullable=false)
     */
    private $atP2Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p2_q1", type="string", length=4, nullable=false)
     */
    private $fjP2Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p2_q1", type="string", length=4, nullable=false)
     */
    private $fiP2Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p3_q1", type="string", length=4, nullable=false)
     */
    private $atP3Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p3_q1", type="string", length=4, nullable=false)
     */
    private $fjP3Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p3_q1", type="string", length=4, nullable=false)
     */
    private $fiP3Q1=0;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p1_q2", type="string", length=4, nullable=false)
     */
    private $atP1Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p1_q2", type="string", length=4, nullable=false)
     */
    private $fjP1Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p1_q2", type="string", length=4, nullable=false)
     */
    private $fiP1Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p2_q2", type="string", length=4, nullable=false)
     */
    private $atP2Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p2_q2", type="string", length=4, nullable=false)
     */
    private $fjP2Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p2_q2", type="string", length=4, nullable=false)
     */
    private $fiP2Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p3_q2", type="string", length=4, nullable=false)
     */
    private $atP3Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p3_q2", type="string", length=4, nullable=false)
     */
    private $fjP3Q2=0;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p3_q2", type="string", length=4, nullable=false)
     */
    private $fiP3Q2=0;

    /**
     * @var \Matriculas
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matriculas", inversedBy="asistencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asistencianummatricula", referencedColumnName="id")
     * })
     */
    private $asistencianummatricula;



    /**
     * Set atP1Q1
     *
     * @param string $atP1Q1
     *
     * @return Asistencia
     */
    public function setAtP1Q1($atP1Q1)
    {
        $this->atP1Q1 = $atP1Q1;

        return $this;
    }

    /**
     * Get atP1Q1
     *
     * @return string
     */
    public function getAtP1Q1()
    {
        return $this->atP1Q1;
    }

    /**
     * Set fjP1Q1
     *
     * @param string $fjP1Q1
     *
     * @return Asistencia
     */
    public function setFjP1Q1($fjP1Q1)
    {
        $this->fjP1Q1 = $fjP1Q1;

        return $this;
    }

    /**
     * Get fjP1Q1
     *
     * @return string
     */
    public function getFjP1Q1()
    {
        return $this->fjP1Q1;
    }

    /**
     * Set fiP1Q1
     *
     * @param string $fiP1Q1
     *
     * @return Asistencia
     */
    public function setFiP1Q1($fiP1Q1)
    {
        $this->fiP1Q1 = $fiP1Q1;

        return $this;
    }

    /**
     * Get fiP1Q1
     *
     * @return string
     */
    public function getFiP1Q1()
    {
        return $this->fiP1Q1;
    }

    /**
     * Set atP2Q1
     *
     * @param string $atP2Q1
     *
     * @return Asistencia
     */
    public function setAtP2Q1($atP2Q1)
    {
        $this->atP2Q1 = $atP2Q1;

        return $this;
    }

    /**
     * Get atP2Q1
     *
     * @return string
     */
    public function getAtP2Q1()
    {
        return $this->atP2Q1;
    }

    /**
     * Set fjP2Q1
     *
     * @param string $fjP2Q1
     *
     * @return Asistencia
     */
    public function setFjP2Q1($fjP2Q1)
    {
        $this->fjP2Q1 = $fjP2Q1;

        return $this;
    }

    /**
     * Get fjP2Q1
     *
     * @return string
     */
    public function getFjP2Q1()
    {
        return $this->fjP2Q1;
    }

    /**
     * Set fiP2Q1
     *
     * @param string $fiP2Q1
     *
     * @return Asistencia
     */
    public function setFiP2Q1($fiP2Q1)
    {
        $this->fiP2Q1 = $fiP2Q1;

        return $this;
    }

    /**
     * Get fiP2Q1
     *
     * @return string
     */
    public function getFiP2Q1()
    {
        return $this->fiP2Q1;
    }

    /**
     * Set atP3Q1
     *
     * @param string $atP3Q1
     *
     * @return Asistencia
     */
    public function setAtP3Q1($atP3Q1)
    {
        $this->atP3Q1 = $atP3Q1;

        return $this;
    }

    /**
     * Get atP3Q1
     *
     * @return string
     */
    public function getAtP3Q1()
    {
        return $this->atP3Q1;
    }

    /**
     * Set fjP3Q1
     *
     * @param string $fjP3Q1
     *
     * @return Asistencia
     */
    public function setFjP3Q1($fjP3Q1)
    {
        $this->fjP3Q1 = $fjP3Q1;

        return $this;
    }

    /**
     * Get fjP3Q1
     *
     * @return string
     */
    public function getFjP3Q1()
    {
        return $this->fjP3Q1;
    }

    /**
     * Set fiP3Q1
     *
     * @param string $fiP3Q1
     *
     * @return Asistencia
     */
    public function setFiP3Q1($fiP3Q1)
    {
        $this->fiP3Q1 = $fiP3Q1;

        return $this;
    }

    /**
     * Get fiP3Q1
     *
     * @return string
     */
    public function getFiP3Q1()
    {
        return $this->fiP3Q1;
    }

    /**
     * Set atP1Q2
     *
     * @param string $atP1Q2
     *
     * @return Asistencia
     */
    public function setAtP1Q2($atP1Q2)
    {
        $this->atP1Q2 = $atP1Q2;

        return $this;
    }

    /**
     * Get atP1Q2
     *
     * @return string
     */
    public function getAtP1Q2()
    {
        return $this->atP1Q2;
    }

    /**
     * Set fjP1Q2
     *
     * @param string $fjP1Q2
     *
     * @return Asistencia
     */
    public function setFjP1Q2($fjP1Q2)
    {
        $this->fjP1Q2 = $fjP1Q2;

        return $this;
    }

    /**
     * Get fjP1Q2
     *
     * @return string
     */
    public function getFjP1Q2()
    {
        return $this->fjP1Q2;
    }

    /**
     * Set fiP1Q2
     *
     * @param string $fiP1Q2
     *
     * @return Asistencia
     */
    public function setFiP1Q2($fiP1Q2)
    {
        $this->fiP1Q2 = $fiP1Q2;

        return $this;
    }

    /**
     * Get fiP1Q2
     *
     * @return string
     */
    public function getFiP1Q2()
    {
        return $this->fiP1Q2;
    }

    /**
     * Set atP2Q2
     *
     * @param string $atP2Q2
     *
     * @return Asistencia
     */
    public function setAtP2Q2($atP2Q2)
    {
        $this->atP2Q2 = $atP2Q2;

        return $this;
    }

    /**
     * Get atP2Q2
     *
     * @return string
     */
    public function getAtP2Q2()
    {
        return $this->atP2Q2;
    }

    /**
     * Set fjP2Q2
     *
     * @param string $fjP2Q2
     *
     * @return Asistencia
     */
    public function setFjP2Q2($fjP2Q2)
    {
        $this->fjP2Q2 = $fjP2Q2;

        return $this;
    }

    /**
     * Get fjP2Q2
     *
     * @return string
     */
    public function getFjP2Q2()
    {
        return $this->fjP2Q2;
    }

    /**
     * Set fiP2Q2
     *
     * @param string $fiP2Q2
     *
     * @return Asistencia
     */
    public function setFiP2Q2($fiP2Q2)
    {
        $this->fiP2Q2 = $fiP2Q2;

        return $this;
    }

    /**
     * Get fiP2Q2
     *
     * @return string
     */
    public function getFiP2Q2()
    {
        return $this->fiP2Q2;
    }

    /**
     * Set atP3Q2
     *
     * @param string $atP3Q2
     *
     * @return Asistencia
     */
    public function setAtP3Q2($atP3Q2)
    {
        $this->atP3Q2 = $atP3Q2;

        return $this;
    }

    /**
     * Get atP3Q2
     *
     * @return string
     */
    public function getAtP3Q2()
    {
        return $this->atP3Q2;
    }

    /**
     * Set fjP3Q2
     *
     * @param string $fjP3Q2
     *
     * @return Asistencia
     */
    public function setFjP3Q2($fjP3Q2)
    {
        $this->fjP3Q2 = $fjP3Q2;

        return $this;
    }

    /**
     * Get fjP3Q2
     *
     * @return string
     */
    public function getFjP3Q2()
    {
        return $this->fjP3Q2;
    }

    /**
     * Set fiP3Q2
     *
     * @param string $fiP3Q2
     *
     * @return Asistencia
     */
    public function setFiP3Q2($fiP3Q2)
    {
        $this->fiP3Q2 = $fiP3Q2;

        return $this;
    }

    /**
     * Get fiP3Q2
     *
     * @return string
     */
    public function getFiP3Q2()
    {
        return $this->fiP3Q2;
    }

    /**
     * Set asistencianummatricula
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $asistencianummatricula
     *
     * @return Asistencia
     */
    public function setAsistencianummatricula(\MultiacademicoBundle\Entity\Matriculas $asistencianummatricula)
    {
        $this->asistencianummatricula = $asistencianummatricula;

        return $this;
    }

    /**
     * Get asistencianummatricula
     *
     * @return \MultiacademicoBundle\Entity\Matriculas
     */
    public function getAsistencianummatricula()
    {
        return $this->asistencianummatricula;
    }
    
    public function getTotalFaltasParcial($q,$p) {
        $varj='fjP'.$p.'Q'.$q;
        $vari='fiP'.$p.'Q'.$q;
        return $this->$varj+$this->$vari;
    }
}
