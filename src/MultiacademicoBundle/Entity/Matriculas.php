<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Matriculas
 *
 * @ORM\Table(name="matriculas", indexes={@ORM\Index(name="FK_matriculas", columns={"matriculacodperiodo"}), @ORM\Index(name="matriculacodestudiante", columns={"matriculacodestudiante"})})
 * @ORM\Entity
 */
class Matriculas
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
     * @var \Estudiantes
     *
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Estudiantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="matriculacodestudiante", referencedColumnName="id", nullable=false)
     * })
     */
    private $matriculacodestudiante;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculacodperiodo", type="string", length=2, nullable=false)
     */
    private $matriculacodperiodo;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculacodcurso", type="string", length=2, nullable=false)
     */
    private $matriculacodcurso;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculacodespecializacion", type="string", length=2, nullable=false)
     */
    private $matriculacodespecializacion;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaseccion", type="string", length=15, nullable=false)
     */
    private $matriculaseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaparalelo", type="string", length=1, nullable=false)
     */
    private $matriculaparalelo;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculausuario", type="string", length=2, nullable=false)
     */
    private $matriculausuario;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculafecha", type="string", length=10, nullable=false)
     */
    private $matriculafecha;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaclave", type="string", length=4, nullable=false)
     */
    private $matriculaclave;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculatipo", type="string", length=14, nullable=false)
     */
    private $matriculatipo;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaobservacion", type="string", length=250, nullable=false)
     */
    private $matriculaobservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="matriculaestado", type="string", length=14, nullable=false)
     */
    private $matriculaestado;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q1_laborada", type="string", length=2, nullable=false)
     */
    private $matriculaQ1Laborada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q1_jutificada", type="string", length=2, nullable=false)
     */
    private $matriculaQ1Jutificada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q1_injustificada", type="string", length=2, nullable=false)
     */
    private $matriculaQ1Injustificada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q2_laborada", type="string", length=2, nullable=false)
     */
    private $matriculaQ2Laborada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q2_jutificada", type="string", length=2, nullable=false)
     */
    private $matriculaQ2Jutificada;

    /**
     * @var string
     *
     * @ORM\Column(name="matricula_q2_injustificada", type="string", length=2, nullable=false)
     */
    private $matriculaQ2Injustificada;


}

