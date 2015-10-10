<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distributivos
 *
 * @ORM\Table(name="distributivos", indexes={@ORM\Index(name="FK_asignaturasprofesores", columns={"distributivocodperiodo"}), @ORM\Index(name="distributivocoddocente", columns={"distributivocoddocente"}), @ORM\Index(name="distributivocodmateria", columns={"distributivocodmateria"}), @ORM\Index(name="distributivocodcurso", columns={"distributivocodcurso"}), @ORM\Index(name="distributivocodespecializacion", columns={"distributivocodespecializacion"})})
 * @ORM\Entity
 */
class Distributivos
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
     * @var string
     *
     * @ORM\Column(name="distributivoparalelo", type="string", length=1, nullable=false)
     */
    private $distributivoparalelo;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivoseccion", type="string", length=20, nullable=false)
     */
    private $distributivoseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivohora", type="string", length=10, nullable=false)
     */
    private $distributivohora;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivofecha", type="string", length=10, nullable=false)
     */
    private $distributivofecha;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivoestado", type="string", length=8, nullable=false)
     */
    private $distributivoestado;

    /**
     * @var string
     *
     * @ORM\Column(name="distributivogrado", type="string", length=2, nullable=true)
     */
    private $distributivogrado;

    /**
     * @var \Periodos
     *
     * @ORM\ManyToOne(targetEntity="Periodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodperiodo", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodperiodo;

    /**
     * @var \Docentes
     *
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocoddocente", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocoddocente;

    /**
     * @var \Materias
     *
     * @ORM\ManyToOne(targetEntity="Materias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodmateria", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodmateria;

    /**
     * @var \Cursos
     *
     * @ORM\ManyToOne(targetEntity="Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodcurso", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodcurso;

    /**
     * @var \Especializaciones
     *
     * @ORM\ManyToOne(targetEntity="Especializaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distributivocodespecializacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $distributivocodespecializacion;


}

