<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modulos
 *
 * @ORM\Table(name="modulos")
 * @ORM\Entity
 */
class Modulos
{
    /**
     * @var string
     *
     * @ORM\Column(name="codmodulo", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codmodulo;

    /**
     * @var string
     *
     * @ORM\Column(name="modulo", type="string", length=100, nullable=false)
     */
    private $modulo;

    /**
     * @var string
     *
     * @ORM\Column(name="modulourl", type="string", length=256, nullable=true)
     */
    private $modulourl;

    /**
     * @var string
     *
     * @ORM\Column(name="moduloico", type="string", length=100, nullable=false)
     */
    private $moduloico;

    /**
     * @var string
     *
     * @ORM\Column(name="modulotexto", type="string", length=150, nullable=false)
     */
    private $modulotexto;

    /**
     * @var string
     *
     * @ORM\Column(name="moduloestado", type="string", length=8, nullable=false)
     */
    private $moduloestado;


}

