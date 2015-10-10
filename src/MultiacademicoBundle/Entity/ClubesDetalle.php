<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClubesDetalle
 *
 * @ORM\Table(name="clubes_detalle", indexes={@ORM\Index(name="codclub", columns={"codclub"}), @ORM\Index(name="clubescodestudiante", columns={"clubescodestudiante"})})
 * @ORM\Entity
 */
class ClubesDetalle
{
    /**
     * @var string
     *
     * @ORM\Column(name="nota_q1_p1", type="string", length=1, nullable=true)
     */
    private $notaQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q1_p2", type="string", length=1, nullable=true)
     */
    private $notaQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q1_p3", type="string", length=1, nullable=true)
     */
    private $notaQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q2_p1", type="string", length=1, nullable=true)
     */
    private $notaQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q2_p2", type="string", length=1, nullable=true)
     */
    private $notaQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q2_p3", type="string", length=1, nullable=true)
     */
    private $notaQ2P3;

    /**
     * @var \Clubes
     *
     * @ORM\ManyToOne(targetEntity="Clubes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codclub", referencedColumnName="id", nullable=false)
     * })
     */
    private $codclub;

    /**
     * @var \Estudiantes
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Estudiantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clubescodestudiante", referencedColumnName="id")
     * })
     */
    private $clubescodestudiante;


}

