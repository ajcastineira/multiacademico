<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Calificaciones
 *
 * @ORM\Table(name="calificaciones", indexes={@ORM\Index(name="calificacionnummatricula", columns={"calificacionnummatricula"}), @ORM\Index(name="calificacioncodmateria", columns={"calificacioncodmateria"})})
 * @ORM\Entity
 */
class Calificaciones
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
     *
     * @ORM\ManyToOne(targetEntity="Materias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calificacioncodmateria", referencedColumnName="id", nullable=false)
     * })
     */
    private $calificacioncodmateria;

    /**
     * @var \Matriculas
     *
     * @ORM\ManyToOne(targetEntity="Matriculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="calificacionnummatricula", referencedColumnName="id", nullable=false)
     * })
     */
    private $calificacionnummatricula;


}

