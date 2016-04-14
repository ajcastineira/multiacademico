<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Criterios
 *
 * @ORM\Table(name="criterios")
 * @ORM\Entity
 */
class Criterios
{
    /**
     * @var string
     *
     * @ORM\Column(name="idcriterio", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcriterio = '';

    /**
     * @var string
     *
     * @ORM\Column(name="criterio", type="string", length=75, nullable=true)
     */
    private $criterio;

    /**
     * @var string
     *
     * @ORM\Column(name="c_idvalor", type="string", length=2, nullable=true)
     */
    private $cIdvalor;


}

