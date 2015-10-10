<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Docentes
 *
 * @ORM\Table(name="docentes")
 * @ORM\Entity
 */
class Docentes
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
     * @ORM\Column(name="docentecedula", type="string", length=10, nullable=false)
     */
    private $docentecedula;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=20, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="docentetrato", type="string", length=8, nullable=false)
     */
    private $docentetrato;

    /**
     * @var string
     *
     * @ORM\Column(name="docente", type="string", length=50, nullable=false)
     */
    private $docente;

    /**
     * @var string
     *
     * @ORM\Column(name="docentedomicilio", type="string", length=50, nullable=false)
     */
    private $docentedomicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="docenteemail", type="string", length=50, nullable=false)
     */
    private $docenteemail;

    /**
     * @var string
     *
     * @ORM\Column(name="docentetelefono", type="string", length=22, nullable=false)
     */
    private $docentetelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="docentecargo", type="string", length=20, nullable=false)
     */
    private $docentecargo;

    /**
     * @var string
     *
     * @ORM\Column(name="docenteestado", type="string", length=8, nullable=false)
     */
    private $docenteestado;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="theme", type="string", length=255, nullable=false)
     */
    private $theme;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=false)
     */
    private $signature;

    /**
     * @var string
     *
     * @ORM\Column(name="signature_format", type="string", length=255, nullable=true)
     */
    private $signatureFormat;

    /**
     * @var integer
     *
     * @ORM\Column(name="created", type="integer", nullable=false)
     */
    private $created;

    /**
     * @var integer
     *
     * @ORM\Column(name="access", type="integer", nullable=false)
     */
    private $access;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastlogin", type="integer", nullable=false)
     */
    private $lastlogin;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastactivity", type="integer", nullable=false)
     */
    private $lastactivity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="timezone", type="string", length=32, nullable=true)
     */
    private $timezone;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=12, nullable=false)
     */
    private $language;

    /**
     * @var integer
     *
     * @ORM\Column(name="picture", type="integer", nullable=false)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="init", type="string", length=254, nullable=true)
     */
    private $init;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", nullable=true)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;


}

