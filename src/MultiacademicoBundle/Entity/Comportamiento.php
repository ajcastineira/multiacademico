<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comportamiento
 *
 * @ORM\Table(name="comportamiento", indexes={@ORM\Index(name="FK_comportamiento", columns={"comportamientonummatricula"})})
 * @ORM\Entity
 */
class Comportamiento
{
    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1_p1", type="string", length=1, nullable=false)
     */
    private $agdcQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1_p1", type="string", length=250, nullable=false)
     */
    private $estabienQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1_p1", type="string", length=500, nullable=false)
     */
    private $mejorarQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1_p1", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1_p2", type="string", length=1, nullable=false)
     */
    private $agdcQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1_p2", type="string", length=250, nullable=false)
     */
    private $estabienQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1_p2", type="string", length=500, nullable=false)
     */
    private $mejorarQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1_p2", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1_p3", type="string", length=1, nullable=false)
     */
    private $agdcQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1_p3", type="string", length=250, nullable=false)
     */
    private $estabienQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1_p3", type="string", length=500, nullable=false)
     */
    private $mejorarQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1_p3", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1", type="string", length=1, nullable=false)
     */
    private $agdcQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1", type="string", length=250, nullable=false)
     */
    private $estabienQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1", type="string", length=500, nullable=false)
     */
    private $mejorarQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2_p1", type="string", length=1, nullable=false)
     */
    private $agdcQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2_p1", type="string", length=250, nullable=false)
     */
    private $estabienQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2_p1", type="string", length=500, nullable=false)
     */
    private $mejorarQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2_p1", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2_p2", type="string", length=1, nullable=false)
     */
    private $agdcQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2_p2", type="string", length=250, nullable=false)
     */
    private $estabienQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2_p2", type="string", length=500, nullable=false)
     */
    private $mejorarQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2_p2", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2_p3", type="string", length=1, nullable=false)
     */
    private $agdcQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2_p3", type="string", length=250, nullable=false)
     */
    private $estabienQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2_p3", type="string", length=500, nullable=false)
     */
    private $mejorarQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2_p3", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2", type="string", length=1, nullable=false)
     */
    private $agdcQ2;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2", type="string", length=250, nullable=false)
     */
    private $estabienQ2;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2", type="string", length=500, nullable=false)
     */
    private $mejorarQ2;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2", type="string", length=500, nullable=false)
     */
    private $crecomendacionQ2;

    /**
     * @var \Matriculas
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matriculas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comportamientonummatricula", referencedColumnName="id")
     * })
     */
    private $comportamientonummatricula;


}

