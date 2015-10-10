<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Periodos
 *
 * @ORM\Table(name="periodos")
 * @ORM\Entity
 */
class Periodos
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
     * @ORM\Column(name="periodo", type="string", length=15, nullable=false)
     */
    private $periodo;

    /**
     * @var string
     *
     * @ORM\Column(name="periodoestado", type="string", length=8, nullable=false)
     */
    private $periodoestado;


}

