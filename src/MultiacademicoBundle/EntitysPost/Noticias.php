<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Noticias
 *
 * @ORM\Table(name="noticias")
 * @ORM\Entity
 */
class Noticias
{
    /**
     * @var string
     *
     * @ORM\Column(name="codnoticia", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codnoticia;

    /**
     * @var integer
     *
     * @ORM\Column(name="noticiaanio", type="integer", nullable=false)
     */
    private $noticiaanio;

    /**
     * @var integer
     *
     * @ORM\Column(name="noticiames", type="integer", nullable=false)
     */
    private $noticiames;

    /**
     * @var integer
     *
     * @ORM\Column(name="noticiadia", type="integer", nullable=false)
     */
    private $noticiadia;

    /**
     * @var string
     *
     * @ORM\Column(name="noticiatitulo", type="string", length=200, nullable=false)
     */
    private $noticiatitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="noticia", type="string", length=500, nullable=false)
     */
    private $noticia;

    /**
     * @var string
     *
     * @ORM\Column(name="noticiaimg", type="string", length=100, nullable=false)
     */
    private $noticiaimg;

    /**
     * @var string
     *
     * @ORM\Column(name="noticiaestado", type="string", length=8, nullable=false)
     */
    private $noticiaestado;


}

