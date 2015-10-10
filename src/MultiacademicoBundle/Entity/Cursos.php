<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursos
 *
 * @ORM\Table(name="cursos")
 * @ORM\Entity
 */
class Cursos
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
     * @ORM\Column(name="cursoabreviatura", type="string", length=5, nullable=false)
     */
    private $cursoabreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="curso", type="string", length=30, nullable=false)
     */
    private $curso;

    /**
     * @var string
     *
     * @ORM\Column(name="cursoestado", type="string", length=8, nullable=false)
     */
    private $cursoestado;


}

