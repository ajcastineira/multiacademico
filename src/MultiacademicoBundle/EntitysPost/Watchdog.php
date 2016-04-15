<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Watchdog
 *
 * @ORM\Table(name="watchdog", indexes={@ORM\Index(name="type", columns={"type"}), @ORM\Index(name="uid", columns={"uid"}), @ORM\Index(name="severity", columns={"severity"})})
 * @ORM\Entity
 */
class Watchdog
{
    /**
     * @var integer
     *
     * @ORM\Column(name="wid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $wid;

    /**
     * @var integer
     *
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=64, nullable=false)
     */
    private $type = '';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="variables", type="blob", nullable=false)
     */
    private $variables;

    /**
     * @var boolean
     *
     * @ORM\Column(name="severity", type="boolean", nullable=false)
     */
    private $severity = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link = '';

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="text", length=65535, nullable=false)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="referer", type="text", length=65535, nullable=true)
     */
    private $referer;

    /**
     * @var string
     *
     * @ORM\Column(name="hostname", type="string", length=128, nullable=false)
     */
    private $hostname = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp = '0';


}

