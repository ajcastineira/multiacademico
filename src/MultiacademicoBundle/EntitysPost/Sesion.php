<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sesion
 *
 * @ORM\Table(name="sesion")
 * @ORM\Entity
 */
class Sesion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=16, nullable=false)
     */
    private $login;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechahora", type="datetime", nullable=false)
     */
    private $fechahora;

    /**
     * @var string
     *
     * @ORM\Column(name="ip", type="string", length=16, nullable=false)
     */
    private $ip;


}

