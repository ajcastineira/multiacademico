<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asistencia
 *
 * @ORM\Table(name="asistencia")
 * @ORM\Entity
 */
class Asistencia
{
    /**
     * @var string
     *
     * @ORM\Column(name="at_p1_q1", type="string", length=4, nullable=false)
     */
    private $atP1Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p1_q1", type="string", length=4, nullable=false)
     */
    private $fjP1Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p1_q1", type="string", length=4, nullable=false)
     */
    private $fiP1Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p2_q1", type="string", length=4, nullable=false)
     */
    private $atP2Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p2_q1", type="string", length=4, nullable=false)
     */
    private $fjP2Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p2_q1", type="string", length=4, nullable=false)
     */
    private $fiP2Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p3_q1", type="string", length=4, nullable=false)
     */
    private $atP3Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p3_q1", type="string", length=4, nullable=false)
     */
    private $fjP3Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p3_q1", type="string", length=4, nullable=false)
     */
    private $fiP3Q1;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p1_q2", type="string", length=4, nullable=false)
     */
    private $atP1Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p1_q2", type="string", length=4, nullable=false)
     */
    private $fjP1Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p1_q2", type="string", length=4, nullable=false)
     */
    private $fiP1Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p2_q2", type="string", length=4, nullable=false)
     */
    private $atP2Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p2_q2", type="string", length=4, nullable=false)
     */
    private $fjP2Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p2_q2", type="string", length=4, nullable=false)
     */
    private $fiP2Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="at_p3_q2", type="string", length=4, nullable=false)
     */
    private $atP3Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="fj_p3_q2", type="string", length=4, nullable=false)
     */
    private $fjP3Q2;

    /**
     * @var string
     *
     * @ORM\Column(name="fi_p3_q2", type="string", length=4, nullable=false)
     */
    private $fiP3Q2;

    /**
     * @var \Matriculas
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matriculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asistencianummatricula", referencedColumnName="id")
     * })
     */
    private $asistencianummatricula;


}

