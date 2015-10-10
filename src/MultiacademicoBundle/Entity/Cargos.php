<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cargos
 *
 * @ORM\Table(name="cargos")
 * @ORM\Entity
 */
class Cargos
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
     * @ORM\Column(name="cargo", type="string", length=100, nullable=false)
     */
    private $cargo;

    /**
     * @var string
     *
     * @ORM\Column(name="cargoestado", type="string", length=8, nullable=false)
     */
    private $cargoestado;


}

