<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoticiasDetalle
 *
 * @ORM\Table(name="noticias_detalle")
 * @ORM\Entity
 */
class NoticiasDetalle
{
    /**
     * @var string
     *
     * @ORM\Column(name="coddetalle", type="string", length=5, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $coddetalle;

    /**
     * @var string
     *
     * @ORM\Column(name="detallecodnoticia", type="string", length=5, nullable=false)
     */
    private $detallecodnoticia;

    /**
     * @var string
     *
     * @ORM\Column(name="detalletitulo", type="string", length=200, nullable=false)
     */
    private $detalletitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="detallenoticia", type="string", length=700, nullable=false)
     */
    private $detallenoticia;

    /**
     * @var string
     *
     * @ORM\Column(name="detalleimg", type="string", length=50, nullable=false)
     */
    private $detalleimg;


}

