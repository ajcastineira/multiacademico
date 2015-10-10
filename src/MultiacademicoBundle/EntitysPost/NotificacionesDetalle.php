<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NotificacionesDetalle
 *
 * @ORM\Table(name="notificaciones_detalle")
 * @ORM\Entity
 */
class NotificacionesDetalle
{
    /**
     * @var integer
     *
     * @ORM\Column(name="coddetalle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $coddetalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="detallecodnotificacion", type="integer", nullable=false)
     */
    private $detallecodnotificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalletitulo", type="string", length=200, nullable=false)
     */
    private $detalletitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="detallenotificacion", type="string", length=700, nullable=false)
     */
    private $detallenotificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="detalleimg", type="string", length=255, nullable=false)
     */
    private $detalleimg;


}

