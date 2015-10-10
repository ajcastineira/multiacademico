<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Especializaciones
 *
 * @ORM\Table(name="especializaciones")
 * @ORM\Entity
 */
class Especializaciones
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
     * @ORM\Column(name="especializacion", type="string", length=50, nullable=false)
     */
    private $especializacion;

    /**
     * @var string
     *
     * @ORM\Column(name="especializacionestado", type="string", length=8, nullable=false)
     */
    private $especializacionestado;


}

