<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valores
 *
 * @ORM\Table(name="valores")
 * @ORM\Entity
 */
class Valores
{
    /**
     * @var string
     *
     * @ORM\Column(name="idvalor", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvalor = '';

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=25, nullable=true)
     */
    private $valor;


}

