<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuariosant
 *
 * @ORM\Table(name="usuariosant")
 * @ORM\Entity
 */
class Usuariosant
{
    /**
     * @var string
     *
     * @ORM\Column(name="codusuario", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="usuariocodcargo", type="string", length=2, nullable=false)
     */
    private $usuariocodcargo;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=20, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="usuariotrato", type="string", length=8, nullable=false)
     */
    private $usuariotrato;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=50, nullable=false)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="usuarioiniciales", type="string", length=5, nullable=false)
     */
    private $usuarioiniciales;

    /**
     * @var string
     *
     * @ORM\Column(name="usuarioestado", type="string", length=8, nullable=false)
     */
    private $usuarioestado;

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

