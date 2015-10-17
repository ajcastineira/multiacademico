<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificaciones
 *
 * @ORM\Table(name="calificaciones", indexes={@ORM\Index(name="calificacionnummatricula", columns={"calificacionnummatricula"}), @ORM\Index(name="calificacioncodmateria", columns={"calificacioncodmateria"})})
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Entity\CalificacionesRepository")
 */
class Calificaciones
{
    /*/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    /*private $id;*/

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p1_n1", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P1N1;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p1_n2", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P1N2;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p1_n3", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P1N3;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p1_n4", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P1N4;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p1_n5", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P1N5;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p1_recomendacion", type="string", length=500, nullable=false)
     */
    private $q1P1Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p1_planmejora", type="string", length=500, nullable=false)
     */
    private $q1P1Planmejora;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p1_co", type="string", length=1, nullable=false)
     */
    private $q1P1Co;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p2_n1", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P2N1;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p2_n2", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P2N2;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p2_n3", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P2N3;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p2_n4", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P2N4;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p2_n5", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P2N5;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p2_recomendacion", type="string", length=500, nullable=false)
     */
    private $q1P2Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p2_planmejora", type="string", length=500, nullable=false)
     */
    private $q1P2Planmejora;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p2_co", type="string", length=1, nullable=false)
     */
    private $q1P2Co;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p3_n1", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P3N1;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p3_n2", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P3N2;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p3_n3", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P3N3;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p3_n4", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P3N4;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_p3_n5", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1P3N5;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p3_recomendacion", type="string", length=500, nullable=false)
     */
    private $q1P3Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p3_planmejora", type="string", length=500, nullable=false)
     */
    private $q1P3Planmejora;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_p3_co", type="string", length=1, nullable=false)
     */
    private $q1P3Co;

    /**
     * @var float
     *
     * @ORM\Column(name="q1_ex", type="float", precision=10, scale=2, nullable=false)
     */
    private $q1Ex;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_recomendacion", type="string", length=500, nullable=false)
     */
    private $q1Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q1_planmejora", type="string", length=500, nullable=false)
     */
    private $q1Planmejora;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p1_n1", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P1N1;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p1_n2", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P1N2;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p1_n3", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P1N3;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p1_n4", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P1N4;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p1_n5", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P1N5;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p1_recomendacion", type="string", length=500, nullable=false)
     */
    private $q2P1Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p1_planmejora", type="string", length=500, nullable=false)
     */
    private $q2P1Planmejora;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p1_co", type="string", length=1, nullable=false)
     */
    private $q2P1Co;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p2_n1", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P2N1;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p2_n2", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P2N2;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p2_n3", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P2N3;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p2_n4", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P2N4;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p2_n5", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P2N5;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p2_recomendacion", type="string", length=500, nullable=false)
     */
    private $q2P2Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p2_planmejora", type="string", length=500, nullable=false)
     */
    private $q2P2Planmejora;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p2_co", type="string", length=1, nullable=false)
     */
    private $q2P2Co;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p3_n1", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P3N1;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p3_n2", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P3N2;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p3_n3", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P3N3;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p3_n4", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P3N4;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_p3_n5", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2P3N5;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p3_recomendacion", type="string", length=500, nullable=false)
     */
    private $q2P3Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p3_planmejora", type="string", length=500, nullable=false)
     */
    private $q2P3Planmejora;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_p3_co", type="string", length=1, nullable=false)
     */
    private $q2P3Co;

    /**
     * @var float
     *
     * @ORM\Column(name="q2_ex", type="float", precision=10, scale=2, nullable=false)
     */
    private $q2Ex;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_recomendacion", type="string", length=500, nullable=false)
     */
    private $q2Recomendacion;

    /**
     * @var string
     *
     * @ORM\Column(name="q2_planmejora", type="string", length=500, nullable=false)
     */
    private $q2Planmejora;

    /**
     * @var float
     *
     * @ORM\Column(name="mejoramiento", type="float", precision=10, scale=2, nullable=false)
     */
    private $mejoramiento;

    /**
     * @var float
     *
     * @ORM\Column(name="supletorio", type="float", precision=10, scale=2, nullable=false)
     */
    private $supletorio;

    /**
     * @var float
     *
     * @ORM\Column(name="remedial", type="float", precision=10, scale=2, nullable=false)
     */
    private $remedial;

    /**
     * @var float
     *
     * @ORM\Column(name="gracia", type="float", precision=10, scale=2, nullable=false)
     */
    private $gracia;

    /**
     * @var float
     *
     * @ORM\Column(name="grado", type="float", precision=10, scale=2, nullable=false)
     */
    private $grado;

    /**
     * @var \Materias
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Materias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calificacioncodmateria", referencedColumnName="id", nullable=false)
     * })
     */
    private $calificacioncodmateria;

    /**
     * @var \Matriculas
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Matriculas", inversedBy="calificaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calificacionnummatricula", referencedColumnName="id", nullable=false)
     * })
     */
    private $calificacionnummatricula;

    public function __construct($matricula=NULL,$materia=NULL) {
        $this->calificacioncodmateria=$materia;
        $this->calificacionnummatricula=$matricula;
    }

    /*/**
     * Get id
     *
     * @return integer
     */
   /* public function getId()
    {
        return $this->id;
    }*/

    /**
     * Set q1P1N1
     *
     * @param float $q1P1N1
     *
     * @return Calificaciones
     */
    public function setQ1P1N1($q1P1N1)
    {
        $this->q1P1N1 = $q1P1N1;

        return $this;
    }

    /**
     * Get q1P1N1
     *
     * @return float
     */
    public function getQ1P1N1()
    {
        return $this->q1P1N1;
    }

    /**
     * Set q1P1N2
     *
     * @param float $q1P1N2
     *
     * @return Calificaciones
     */
    public function setQ1P1N2($q1P1N2)
    {
        $this->q1P1N2 = $q1P1N2;

        return $this;
    }

    /**
     * Get q1P1N2
     *
     * @return float
     */
    public function getQ1P1N2()
    {
        return $this->q1P1N2;
    }

    /**
     * Set q1P1N3
     *
     * @param float $q1P1N3
     *
     * @return Calificaciones
     */
    public function setQ1P1N3($q1P1N3)
    {
        $this->q1P1N3 = $q1P1N3;

        return $this;
    }

    /**
     * Get q1P1N3
     *
     * @return float
     */
    public function getQ1P1N3()
    {
        return $this->q1P1N3;
    }

    /**
     * Set q1P1N4
     *
     * @param float $q1P1N4
     *
     * @return Calificaciones
     */
    public function setQ1P1N4($q1P1N4)
    {
        $this->q1P1N4 = $q1P1N4;

        return $this;
    }

    /**
     * Get q1P1N4
     *
     * @return float
     */
    public function getQ1P1N4()
    {
        return $this->q1P1N4;
    }

    /**
     * Set q1P1N5
     *
     * @param float $q1P1N5
     *
     * @return Calificaciones
     */
    public function setQ1P1N5($q1P1N5)
    {
        $this->q1P1N5 = $q1P1N5;

        return $this;
    }

    /**
     * Get q1P1N5
     *
     * @return float
     */
    public function getQ1P1N5()
    {
        return $this->q1P1N5;
    }

    /**
     * Set q1P1Recomendacion
     *
     * @param string $q1P1Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ1P1Recomendacion($q1P1Recomendacion)
    {
        $this->q1P1Recomendacion = $q1P1Recomendacion;

        return $this;
    }

    /**
     * Get q1P1Recomendacion
     *
     * @return string
     */
    public function getQ1P1Recomendacion()
    {
        return $this->q1P1Recomendacion;
    }

    /**
     * Set q1P1Planmejora
     *
     * @param string $q1P1Planmejora
     *
     * @return Calificaciones
     */
    public function setQ1P1Planmejora($q1P1Planmejora)
    {
        $this->q1P1Planmejora = $q1P1Planmejora;

        return $this;
    }

    /**
     * Get q1P1Planmejora
     *
     * @return string
     */
    public function getQ1P1Planmejora()
    {
        return $this->q1P1Planmejora;
    }

    /**
     * Set q1P1Co
     *
     * @param string $q1P1Co
     *
     * @return Calificaciones
     */
    public function setQ1P1Co($q1P1Co)
    {
        $this->q1P1Co = $q1P1Co;

        return $this;
    }

    /**
     * Get q1P1Co
     *
     * @return string
     */
    public function getQ1P1Co()
    {
        return $this->q1P1Co;
    }

    /**
     * Set q1P2N1
     *
     * @param float $q1P2N1
     *
     * @return Calificaciones
     */
    public function setQ1P2N1($q1P2N1)
    {
        $this->q1P2N1 = $q1P2N1;

        return $this;
    }

    /**
     * Get q1P2N1
     *
     * @return float
     */
    public function getQ1P2N1()
    {
        return $this->q1P2N1;
    }

    /**
     * Set q1P2N2
     *
     * @param float $q1P2N2
     *
     * @return Calificaciones
     */
    public function setQ1P2N2($q1P2N2)
    {
        $this->q1P2N2 = $q1P2N2;

        return $this;
    }

    /**
     * Get q1P2N2
     *
     * @return float
     */
    public function getQ1P2N2()
    {
        return $this->q1P2N2;
    }

    /**
     * Set q1P2N3
     *
     * @param float $q1P2N3
     *
     * @return Calificaciones
     */
    public function setQ1P2N3($q1P2N3)
    {
        $this->q1P2N3 = $q1P2N3;

        return $this;
    }

    /**
     * Get q1P2N3
     *
     * @return float
     */
    public function getQ1P2N3()
    {
        return $this->q1P2N3;
    }

    /**
     * Set q1P2N4
     *
     * @param float $q1P2N4
     *
     * @return Calificaciones
     */
    public function setQ1P2N4($q1P2N4)
    {
        $this->q1P2N4 = $q1P2N4;

        return $this;
    }

    /**
     * Get q1P2N4
     *
     * @return float
     */
    public function getQ1P2N4()
    {
        return $this->q1P2N4;
    }

    /**
     * Set q1P2N5
     *
     * @param float $q1P2N5
     *
     * @return Calificaciones
     */
    public function setQ1P2N5($q1P2N5)
    {
        $this->q1P2N5 = $q1P2N5;

        return $this;
    }

    /**
     * Get q1P2N5
     *
     * @return float
     */
    public function getQ1P2N5()
    {
        return $this->q1P2N5;
    }

    /**
     * Set q1P2Recomendacion
     *
     * @param string $q1P2Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ1P2Recomendacion($q1P2Recomendacion)
    {
        $this->q1P2Recomendacion = $q1P2Recomendacion;

        return $this;
    }

    /**
     * Get q1P2Recomendacion
     *
     * @return string
     */
    public function getQ1P2Recomendacion()
    {
        return $this->q1P2Recomendacion;
    }

    /**
     * Set q1P2Planmejora
     *
     * @param string $q1P2Planmejora
     *
     * @return Calificaciones
     */
    public function setQ1P2Planmejora($q1P2Planmejora)
    {
        $this->q1P2Planmejora = $q1P2Planmejora;

        return $this;
    }

    /**
     * Get q1P2Planmejora
     *
     * @return string
     */
    public function getQ1P2Planmejora()
    {
        return $this->q1P2Planmejora;
    }

    /**
     * Set q1P2Co
     *
     * @param string $q1P2Co
     *
     * @return Calificaciones
     */
    public function setQ1P2Co($q1P2Co)
    {
        $this->q1P2Co = $q1P2Co;

        return $this;
    }

    /**
     * Get q1P2Co
     *
     * @return string
     */
    public function getQ1P2Co()
    {
        return $this->q1P2Co;
    }

    /**
     * Set q1P3N1
     *
     * @param float $q1P3N1
     *
     * @return Calificaciones
     */
    public function setQ1P3N1($q1P3N1)
    {
        $this->q1P3N1 = $q1P3N1;

        return $this;
    }

    /**
     * Get q1P3N1
     *
     * @return float
     */
    public function getQ1P3N1()
    {
        return $this->q1P3N1;
    }

    /**
     * Set q1P3N2
     *
     * @param float $q1P3N2
     *
     * @return Calificaciones
     */
    public function setQ1P3N2($q1P3N2)
    {
        $this->q1P3N2 = $q1P3N2;

        return $this;
    }

    /**
     * Get q1P3N2
     *
     * @return float
     */
    public function getQ1P3N2()
    {
        return $this->q1P3N2;
    }

    /**
     * Set q1P3N3
     *
     * @param float $q1P3N3
     *
     * @return Calificaciones
     */
    public function setQ1P3N3($q1P3N3)
    {
        $this->q1P3N3 = $q1P3N3;

        return $this;
    }

    /**
     * Get q1P3N3
     *
     * @return float
     */
    public function getQ1P3N3()
    {
        return $this->q1P3N3;
    }

    /**
     * Set q1P3N4
     *
     * @param float $q1P3N4
     *
     * @return Calificaciones
     */
    public function setQ1P3N4($q1P3N4)
    {
        $this->q1P3N4 = $q1P3N4;

        return $this;
    }

    /**
     * Get q1P3N4
     *
     * @return float
     */
    public function getQ1P3N4()
    {
        return $this->q1P3N4;
    }

    /**
     * Set q1P3N5
     *
     * @param float $q1P3N5
     *
     * @return Calificaciones
     */
    public function setQ1P3N5($q1P3N5)
    {
        $this->q1P3N5 = $q1P3N5;

        return $this;
    }

    /**
     * Get q1P3N5
     *
     * @return float
     */
    public function getQ1P3N5()
    {
        return $this->q1P3N5;
    }

    /**
     * Set q1P3Recomendacion
     *
     * @param string $q1P3Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ1P3Recomendacion($q1P3Recomendacion)
    {
        $this->q1P3Recomendacion = $q1P3Recomendacion;

        return $this;
    }

    /**
     * Get q1P3Recomendacion
     *
     * @return string
     */
    public function getQ1P3Recomendacion()
    {
        return $this->q1P3Recomendacion;
    }

    /**
     * Set q1P3Planmejora
     *
     * @param string $q1P3Planmejora
     *
     * @return Calificaciones
     */
    public function setQ1P3Planmejora($q1P3Planmejora)
    {
        $this->q1P3Planmejora = $q1P3Planmejora;

        return $this;
    }

    /**
     * Get q1P3Planmejora
     *
     * @return string
     */
    public function getQ1P3Planmejora()
    {
        return $this->q1P3Planmejora;
    }

    /**
     * Set q1P3Co
     *
     * @param string $q1P3Co
     *
     * @return Calificaciones
     */
    public function setQ1P3Co($q1P3Co)
    {
        $this->q1P3Co = $q1P3Co;

        return $this;
    }

    /**
     * Get q1P3Co
     *
     * @return string
     */
    public function getQ1P3Co()
    {
        return $this->q1P3Co;
    }

    /**
     * Set q1Ex
     *
     * @param float $q1Ex
     *
     * @return Calificaciones
     */
    public function setQ1Ex($q1Ex)
    {
        $this->q1Ex = $q1Ex;

        return $this;
    }

    /**
     * Get q1Ex
     *
     * @return float
     */
    public function getQ1Ex()
    {
        return $this->q1Ex;
    }

    /**
     * Set q1Recomendacion
     *
     * @param string $q1Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ1Recomendacion($q1Recomendacion)
    {
        $this->q1Recomendacion = $q1Recomendacion;

        return $this;
    }

    /**
     * Get q1Recomendacion
     *
     * @return string
     */
    public function getQ1Recomendacion()
    {
        return $this->q1Recomendacion;
    }

    /**
     * Set q1Planmejora
     *
     * @param string $q1Planmejora
     *
     * @return Calificaciones
     */
    public function setQ1Planmejora($q1Planmejora)
    {
        $this->q1Planmejora = $q1Planmejora;

        return $this;
    }

    /**
     * Get q1Planmejora
     *
     * @return string
     */
    public function getQ1Planmejora()
    {
        return $this->q1Planmejora;
    }

    /**
     * Set q2P1N1
     *
     * @param float $q2P1N1
     *
     * @return Calificaciones
     */
    public function setQ2P1N1($q2P1N1)
    {
        $this->q2P1N1 = $q2P1N1;

        return $this;
    }

    /**
     * Get q2P1N1
     *
     * @return float
     */
    public function getQ2P1N1()
    {
        return $this->q2P1N1;
    }

    /**
     * Set q2P1N2
     *
     * @param float $q2P1N2
     *
     * @return Calificaciones
     */
    public function setQ2P1N2($q2P1N2)
    {
        $this->q2P1N2 = $q2P1N2;

        return $this;
    }

    /**
     * Get q2P1N2
     *
     * @return float
     */
    public function getQ2P1N2()
    {
        return $this->q2P1N2;
    }

    /**
     * Set q2P1N3
     *
     * @param float $q2P1N3
     *
     * @return Calificaciones
     */
    public function setQ2P1N3($q2P1N3)
    {
        $this->q2P1N3 = $q2P1N3;

        return $this;
    }

    /**
     * Get q2P1N3
     *
     * @return float
     */
    public function getQ2P1N3()
    {
        return $this->q2P1N3;
    }

    /**
     * Set q2P1N4
     *
     * @param float $q2P1N4
     *
     * @return Calificaciones
     */
    public function setQ2P1N4($q2P1N4)
    {
        $this->q2P1N4 = $q2P1N4;

        return $this;
    }

    /**
     * Get q2P1N4
     *
     * @return float
     */
    public function getQ2P1N4()
    {
        return $this->q2P1N4;
    }

    /**
     * Set q2P1N5
     *
     * @param float $q2P1N5
     *
     * @return Calificaciones
     */
    public function setQ2P1N5($q2P1N5)
    {
        $this->q2P1N5 = $q2P1N5;

        return $this;
    }

    /**
     * Get q2P1N5
     *
     * @return float
     */
    public function getQ2P1N5()
    {
        return $this->q2P1N5;
    }

    /**
     * Set q2P1Recomendacion
     *
     * @param string $q2P1Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ2P1Recomendacion($q2P1Recomendacion)
    {
        $this->q2P1Recomendacion = $q2P1Recomendacion;

        return $this;
    }

    /**
     * Get q2P1Recomendacion
     *
     * @return string
     */
    public function getQ2P1Recomendacion()
    {
        return $this->q2P1Recomendacion;
    }

    /**
     * Set q2P1Planmejora
     *
     * @param string $q2P1Planmejora
     *
     * @return Calificaciones
     */
    public function setQ2P1Planmejora($q2P1Planmejora)
    {
        $this->q2P1Planmejora = $q2P1Planmejora;

        return $this;
    }

    /**
     * Get q2P1Planmejora
     *
     * @return string
     */
    public function getQ2P1Planmejora()
    {
        return $this->q2P1Planmejora;
    }

    /**
     * Set q2P1Co
     *
     * @param string $q2P1Co
     *
     * @return Calificaciones
     */
    public function setQ2P1Co($q2P1Co)
    {
        $this->q2P1Co = $q2P1Co;

        return $this;
    }

    /**
     * Get q2P1Co
     *
     * @return string
     */
    public function getQ2P1Co()
    {
        return $this->q2P1Co;
    }

    /**
     * Set q2P2N1
     *
     * @param float $q2P2N1
     *
     * @return Calificaciones
     */
    public function setQ2P2N1($q2P2N1)
    {
        $this->q2P2N1 = $q2P2N1;

        return $this;
    }

    /**
     * Get q2P2N1
     *
     * @return float
     */
    public function getQ2P2N1()
    {
        return $this->q2P2N1;
    }

    /**
     * Set q2P2N2
     *
     * @param float $q2P2N2
     *
     * @return Calificaciones
     */
    public function setQ2P2N2($q2P2N2)
    {
        $this->q2P2N2 = $q2P2N2;

        return $this;
    }

    /**
     * Get q2P2N2
     *
     * @return float
     */
    public function getQ2P2N2()
    {
        return $this->q2P2N2;
    }

    /**
     * Set q2P2N3
     *
     * @param float $q2P2N3
     *
     * @return Calificaciones
     */
    public function setQ2P2N3($q2P2N3)
    {
        $this->q2P2N3 = $q2P2N3;

        return $this;
    }

    /**
     * Get q2P2N3
     *
     * @return float
     */
    public function getQ2P2N3()
    {
        return $this->q2P2N3;
    }

    /**
     * Set q2P2N4
     *
     * @param float $q2P2N4
     *
     * @return Calificaciones
     */
    public function setQ2P2N4($q2P2N4)
    {
        $this->q2P2N4 = $q2P2N4;

        return $this;
    }

    /**
     * Get q2P2N4
     *
     * @return float
     */
    public function getQ2P2N4()
    {
        return $this->q2P2N4;
    }

    /**
     * Set q2P2N5
     *
     * @param float $q2P2N5
     *
     * @return Calificaciones
     */
    public function setQ2P2N5($q2P2N5)
    {
        $this->q2P2N5 = $q2P2N5;

        return $this;
    }

    /**
     * Get q2P2N5
     *
     * @return float
     */
    public function getQ2P2N5()
    {
        return $this->q2P2N5;
    }

    /**
     * Set q2P2Recomendacion
     *
     * @param string $q2P2Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ2P2Recomendacion($q2P2Recomendacion)
    {
        $this->q2P2Recomendacion = $q2P2Recomendacion;

        return $this;
    }

    /**
     * Get q2P2Recomendacion
     *
     * @return string
     */
    public function getQ2P2Recomendacion()
    {
        return $this->q2P2Recomendacion;
    }

    /**
     * Set q2P2Planmejora
     *
     * @param string $q2P2Planmejora
     *
     * @return Calificaciones
     */
    public function setQ2P2Planmejora($q2P2Planmejora)
    {
        $this->q2P2Planmejora = $q2P2Planmejora;

        return $this;
    }

    /**
     * Get q2P2Planmejora
     *
     * @return string
     */
    public function getQ2P2Planmejora()
    {
        return $this->q2P2Planmejora;
    }

    /**
     * Set q2P2Co
     *
     * @param string $q2P2Co
     *
     * @return Calificaciones
     */
    public function setQ2P2Co($q2P2Co)
    {
        $this->q2P2Co = $q2P2Co;

        return $this;
    }

    /**
     * Get q2P2Co
     *
     * @return string
     */
    public function getQ2P2Co()
    {
        return $this->q2P2Co;
    }

    /**
     * Set q2P3N1
     *
     * @param float $q2P3N1
     *
     * @return Calificaciones
     */
    public function setQ2P3N1($q2P3N1)
    {
        $this->q2P3N1 = $q2P3N1;

        return $this;
    }

    /**
     * Get q2P3N1
     *
     * @return float
     */
    public function getQ2P3N1()
    {
        return $this->q2P3N1;
    }

    /**
     * Set q2P3N2
     *
     * @param float $q2P3N2
     *
     * @return Calificaciones
     */
    public function setQ2P3N2($q2P3N2)
    {
        $this->q2P3N2 = $q2P3N2;

        return $this;
    }

    /**
     * Get q2P3N2
     *
     * @return float
     */
    public function getQ2P3N2()
    {
        return $this->q2P3N2;
    }

    /**
     * Set q2P3N3
     *
     * @param float $q2P3N3
     *
     * @return Calificaciones
     */
    public function setQ2P3N3($q2P3N3)
    {
        $this->q2P3N3 = $q2P3N3;

        return $this;
    }

    /**
     * Get q2P3N3
     *
     * @return float
     */
    public function getQ2P3N3()
    {
        return $this->q2P3N3;
    }

    /**
     * Set q2P3N4
     *
     * @param float $q2P3N4
     *
     * @return Calificaciones
     */
    public function setQ2P3N4($q2P3N4)
    {
        $this->q2P3N4 = $q2P3N4;

        return $this;
    }

    /**
     * Get q2P3N4
     *
     * @return float
     */
    public function getQ2P3N4()
    {
        return $this->q2P3N4;
    }

    /**
     * Set q2P3N5
     *
     * @param float $q2P3N5
     *
     * @return Calificaciones
     */
    public function setQ2P3N5($q2P3N5)
    {
        $this->q2P3N5 = $q2P3N5;

        return $this;
    }

    /**
     * Get q2P3N5
     *
     * @return float
     */
    public function getQ2P3N5()
    {
        return $this->q2P3N5;
    }

    /**
     * Set q2P3Recomendacion
     *
     * @param string $q2P3Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ2P3Recomendacion($q2P3Recomendacion)
    {
        $this->q2P3Recomendacion = $q2P3Recomendacion;

        return $this;
    }

    /**
     * Get q2P3Recomendacion
     *
     * @return string
     */
    public function getQ2P3Recomendacion()
    {
        return $this->q2P3Recomendacion;
    }

    /**
     * Set q2P3Planmejora
     *
     * @param string $q2P3Planmejora
     *
     * @return Calificaciones
     */
    public function setQ2P3Planmejora($q2P3Planmejora)
    {
        $this->q2P3Planmejora = $q2P3Planmejora;

        return $this;
    }

    /**
     * Get q2P3Planmejora
     *
     * @return string
     */
    public function getQ2P3Planmejora()
    {
        return $this->q2P3Planmejora;
    }

    /**
     * Set q2P3Co
     *
     * @param string $q2P3Co
     *
     * @return Calificaciones
     */
    public function setQ2P3Co($q2P3Co)
    {
        $this->q2P3Co = $q2P3Co;

        return $this;
    }

    /**
     * Get q2P3Co
     *
     * @return string
     */
    public function getQ2P3Co()
    {
        return $this->q2P3Co;
    }

    /**
     * Set q2Ex
     *
     * @param float $q2Ex
     *
     * @return Calificaciones
     */
    public function setQ2Ex($q2Ex)
    {
        $this->q2Ex = $q2Ex;

        return $this;
    }

    /**
     * Get q2Ex
     *
     * @return float
     */
    public function getQ2Ex()
    {
        return $this->q2Ex;
    }

    /**
     * Set q2Recomendacion
     *
     * @param string $q2Recomendacion
     *
     * @return Calificaciones
     */
    public function setQ2Recomendacion($q2Recomendacion)
    {
        $this->q2Recomendacion = $q2Recomendacion;

        return $this;
    }

    /**
     * Get q2Recomendacion
     *
     * @return string
     */
    public function getQ2Recomendacion()
    {
        return $this->q2Recomendacion;
    }

    /**
     * Set q2Planmejora
     *
     * @param string $q2Planmejora
     *
     * @return Calificaciones
     */
    public function setQ2Planmejora($q2Planmejora)
    {
        $this->q2Planmejora = $q2Planmejora;

        return $this;
    }

    /**
     * Get q2Planmejora
     *
     * @return string
     */
    public function getQ2Planmejora()
    {
        return $this->q2Planmejora;
    }

    /**
     * Set mejoramiento
     *
     * @param float $mejoramiento
     *
     * @return Calificaciones
     */
    public function setMejoramiento($mejoramiento)
    {
        $this->mejoramiento = $mejoramiento;

        return $this;
    }

    /**
     * Get mejoramiento
     *
     * @return float
     */
    public function getMejoramiento()
    {
        return $this->mejoramiento;
    }

    /**
     * Set supletorio
     *
     * @param float $supletorio
     *
     * @return Calificaciones
     */
    public function setSupletorio($supletorio)
    {
        $this->supletorio = $supletorio;

        return $this;
    }

    /**
     * Get supletorio
     *
     * @return float
     */
    public function getSupletorio()
    {
        return $this->supletorio;
    }

    /**
     * Set remedial
     *
     * @param float $remedial
     *
     * @return Calificaciones
     */
    public function setRemedial($remedial)
    {
        $this->remedial = $remedial;

        return $this;
    }

    /**
     * Get remedial
     *
     * @return float
     */
    public function getRemedial()
    {
        return $this->remedial;
    }

    /**
     * Set gracia
     *
     * @param float $gracia
     *
     * @return Calificaciones
     */
    public function setGracia($gracia)
    {
        $this->gracia = $gracia;

        return $this;
    }

    /**
     * Get gracia
     *
     * @return float
     */
    public function getGracia()
    {
        return $this->gracia;
    }

    /**
     * Set grado
     *
     * @param float $grado
     *
     * @return Calificaciones
     */
    public function setGrado($grado)
    {
        $this->grado = $grado;

        return $this;
    }

    /**
     * Get grado
     *
     * @return float
     */
    public function getGrado()
    {
        return $this->grado;
    }

    /**
     * Set calificacioncodmateria
     *
     * @param \MultiacademicoBundle\Entity\Materias $calificacioncodmateria
     *
     * @return Calificaciones
     */
    public function setCalificacioncodmateria(\MultiacademicoBundle\Entity\Materias $calificacioncodmateria)
    {
        $this->calificacioncodmateria = $calificacioncodmateria;

        return $this;
    }

    /**
     * Get calificacioncodmateria
     *
     * @return \MultiacademicoBundle\Entity\Materias
     */
    public function getCalificacioncodmateria()
    {
        return $this->calificacioncodmateria;
    }

    /**
     * Set calificacionnummatricula
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $calificacionnummatricula
     *
     * @return Calificaciones
     */
    public function setCalificacionnummatricula(\MultiacademicoBundle\Entity\Matriculas $calificacionnummatricula)
    {
        $this->calificacionnummatricula = $calificacionnummatricula;

        return $this;
    }

    /**
     * Get calificacionnummatricula
     *
     * @return \MultiacademicoBundle\Entity\Matriculas
     */
    public function getCalificacionnummatricula()
    {
        return $this->calificacionnummatricula;
    }
    
    function redondear_dos_decimal($valor) { 
        //$float_redondeado=floor($valor * 100) / 100;
        $float_redondeado=round($valor,2,PHP_ROUND_HALF_DOWN);
    return $float_redondeado; 
    } 
    
     public function getPromedioParcial($q,$p)
    {
        $sumpar=0; 
        for ($n=1;$n<=5;$n++)
                           {
                               $nvar="q".$q."P".$p."N".$n;
                               ${"$nvar"}=$this->$nvar;
                               $sumpar+=${"$nvar"};
                       }
          return $this->redondear_dos_decimal($sumpar/5);
    }
    public function getPromedioParciales($q)
    {
        $sumpar=0;     
        for($p=1;$p<=3;$p++)
                 {
                    $promedio_p=$this->getPromedioParcial($q, $p);
                    $sumpar+=$promedio_p;
                 }
                       
          return $this->redondear_dos_decimal($sumpar/3);
    }
    public function getPromedioQuimestre($q)
    {
                $promedio_parciales=$this->getPromedioParciales( $q);

             $promedio_q_80=$this->redondear_dos_decimal($promedio_parciales*0.8);
             $promedio_q_ex_20=$this->redondear_dos_decimal($this->{'q'.$q.'Ex'}*0.2);
             $promedio_q=$this->redondear_dos_decimal(($promedio_q_80+$promedio_q_ex_20));
                       
          return $promedio_q;
    }
}
