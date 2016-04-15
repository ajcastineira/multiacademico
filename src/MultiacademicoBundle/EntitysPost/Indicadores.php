<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicadores
 *
 * @ORM\Table(name="indicadores")
 * @ORM\Entity
 */
class Indicadores
{
    /**
     * @var string
     *
     * @ORM\Column(name="idindicador", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idindicador = '';

    /**
     * @var string
     *
     * @ORM\Column(name="indicador", type="string", length=150, nullable=true)
     */
    private $indicador;

    /**
     * @var string
     *
     * @ORM\Column(name="i_idcriterio", type="string", length=3, nullable=true)
     */
    private $iIdcriterio;


}

