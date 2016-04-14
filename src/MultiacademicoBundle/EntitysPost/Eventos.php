<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Eventos
 *
 * @ORM\Table(name="eventos")
 * @ORM\Entity
 */
class Eventos
{
    /**
     * @var string
     *
     * @ORM\Column(name="codevento", type="string", length=3, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codevento;

    /**
     * @var string
     *
     * @ORM\Column(name="eventomesinicio", type="string", length=2, nullable=false)
     */
    private $eventomesinicio;

    /**
     * @var string
     *
     * @ORM\Column(name="eventomesfin", type="string", length=2, nullable=false)
     */
    private $eventomesfin;

    /**
     * @var string
     *
     * @ORM\Column(name="eventodiainicio", type="string", length=2, nullable=false)
     */
    private $eventodiainicio;

    /**
     * @var string
     *
     * @ORM\Column(name="eventodiafin", type="string", length=2, nullable=false)
     */
    private $eventodiafin;

    /**
     * @var string
     *
     * @ORM\Column(name="eventohorainicio", type="string", length=10, nullable=false)
     */
    private $eventohorainicio;

    /**
     * @var string
     *
     * @ORM\Column(name="eventohorafin", type="string", length=10, nullable=false)
     */
    private $eventohorafin;

    /**
     * @var string
     *
     * @ORM\Column(name="evento", type="string", length=100, nullable=false)
     */
    private $evento;

    /**
     * @var string
     *
     * @ORM\Column(name="eventolugar", type="string", length=50, nullable=false)
     */
    private $eventolugar;

    /**
     * @var string
     *
     * @ORM\Column(name="eventoestado", type="string", length=8, nullable=false)
     */
    private $eventoestado;


}

