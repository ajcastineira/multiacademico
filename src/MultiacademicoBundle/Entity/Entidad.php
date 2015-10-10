<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entidad
 *
 * @ORM\Table(name="entidad")
 * @ORM\Entity
 */
class Entidad
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
     * @ORM\Column(name="entidad", type="string", length=200, nullable=false)
     */
    private $entidad;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="lema", type="string", length=100, nullable=false)
     */
    private $lema;

    /**
     * @var string
     *
     * @ORM\Column(name="siglas", type="string", length=15, nullable=false)
     */
    private $siglas;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=50, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=30, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=50, nullable=false)
     */
    private $lugar;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=50, nullable=false)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=100, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="visitas", type="string", length=10, nullable=false)
     */
    private $visitas;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", nullable=true)
     */
    private $data;


}

