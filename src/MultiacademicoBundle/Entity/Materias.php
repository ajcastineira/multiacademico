<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Materias
 *
 * @ORM\Table(name="materias")
 * @ORM\Entity
 */
class Materias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id",length=10, type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="materia", type="string", length=40, nullable=false)
     */
    private $materia;

    /**
     * @var string
     *
     * @ORM\Column(name="materiatipo", type="string", length=15, nullable=false)
     */
    private $materiatipo;

    /**
     * @var string
     *
     * @ORM\Column(name="materiaestado", type="string", length=8, nullable=false)
     */
    private $materiaestado;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad = '20';


}

