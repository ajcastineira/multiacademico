<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comentarios
 *
 * @ORM\Table(name="comentarios")
 * @ORM\Entity
 */
class Comentarios
{
    /**
     * @var string
     *
     * @ORM\Column(name="codcomentario", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codcomentario;

    /**
     * @var string
     *
     * @ORM\Column(name="comentariousuario", type="string", length=50, nullable=false)
     */
    private $comentariousuario;

    /**
     * @var string
     *
     * @ORM\Column(name="comentariocorreo", type="string", length=50, nullable=false)
     */
    private $comentariocorreo;

    /**
     * @var integer
     *
     * @ORM\Column(name="comentariodia", type="integer", nullable=false)
     */
    private $comentariodia;

    /**
     * @var integer
     *
     * @ORM\Column(name="comentariomes", type="integer", nullable=false)
     */
    private $comentariomes;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarioanio", type="string", length=4, nullable=false)
     */
    private $comentarioanio;

    /**
     * @var string
     *
     * @ORM\Column(name="comentariohora", type="string", length=10, nullable=false)
     */
    private $comentariohora;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="string", length=300, nullable=false)
     */
    private $comentario;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarioestado", type="string", length=8, nullable=false)
     */
    private $comentarioestado;


}

