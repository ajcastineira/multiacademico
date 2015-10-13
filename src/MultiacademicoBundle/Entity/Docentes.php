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



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set docentecedula
     *
     * @param string $docentecedula
     *
     * @return Docentes
     */
    public function setDocentecedula($docentecedula)
    {
        $this->docentecedula = $docentecedula;

        return $this;
    }

    /**
     * Get docentecedula
     *
     * @return string
     */
    public function getDocentecedula()
    {
        return $this->docentecedula;
    }

    /**
     * Set login
     *
     * @param string $login
     *
     * @return Docentes
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Docentes
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set docentetrato
     *
     * @param string $docentetrato
     *
     * @return Docentes
     */
    public function setDocentetrato($docentetrato)
    {
        $this->docentetrato = $docentetrato;

        return $this;
    }

    /**
     * Get docentetrato
     *
     * @return string
     */
    public function getDocentetrato()
    {
        return $this->docentetrato;
    }

    /**
     * Set docente
     *
     * @param string $docente
     *
     * @return Docentes
     */
    public function setDocente($docente)
    {
        $this->docente = $docente;

        return $this;
    }

    /**
     * Get docente
     *
     * @return string
     */
    public function getDocente()
    {
        return $this->docente;
    }

    /**
     * Set docentedomicilio
     *
     * @param string $docentedomicilio
     *
     * @return Docentes
     */
    public function setDocentedomicilio($docentedomicilio)
    {
        $this->docentedomicilio = $docentedomicilio;

        return $this;
    }

    /**
     * Get docentedomicilio
     *
     * @return string
     */
    public function getDocentedomicilio()
    {
        return $this->docentedomicilio;
    }

    /**
     * Set docenteemail
     *
     * @param string $docenteemail
     *
     * @return Docentes
     */
    public function setDocenteemail($docenteemail)
    {
        $this->docenteemail = $docenteemail;

        return $this;
    }

    /**
     * Get docenteemail
     *
     * @return string
     */
    public function getDocenteemail()
    {
        return $this->docenteemail;
    }

    /**
     * Set docentetelefono
     *
     * @param string $docentetelefono
     *
     * @return Docentes
     */
    public function setDocentetelefono($docentetelefono)
    {
        $this->docentetelefono = $docentetelefono;

        return $this;
    }

    /**
     * Get docentetelefono
     *
     * @return string
     */
    public function getDocentetelefono()
    {
        return $this->docentetelefono;
    }

    /**
     * Set docentecargo
     *
     * @param string $docentecargo
     *
     * @return Docentes
     */
    public function setDocentecargo($docentecargo)
    {
        $this->docentecargo = $docentecargo;

        return $this;
    }

    /**
     * Get docentecargo
     *
     * @return string
     */
    public function getDocentecargo()
    {
        return $this->docentecargo;
    }

    /**
     * Set docenteestado
     *
     * @param string $docenteestado
     *
     * @return Docentes
     */
    public function setDocenteestado($docenteestado)
    {
        $this->docenteestado = $docenteestado;

        return $this;
    }

    /**
     * Get docenteestado
     *
     * @return string
     */
    public function getDocenteestado()
    {
        return $this->docenteestado;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Docentes
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Docentes
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Docentes
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set theme
     *
     * @param string $theme
     *
     * @return Docentes
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    /**
     * Get theme
     *
     * @return string
     */
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * Set signature
     *
     * @param string $signature
     *
     * @return Docentes
     */
    public function setSignature($signature)
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * Get signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Set signatureFormat
     *
     * @param string $signatureFormat
     *
     * @return Docentes
     */
    public function setSignatureFormat($signatureFormat)
    {
        $this->signatureFormat = $signatureFormat;

        return $this;
    }

    /**
     * Get signatureFormat
     *
     * @return string
     */
    public function getSignatureFormat()
    {
        return $this->signatureFormat;
    }

    /**
     * Set created
     *
     * @param integer $created
     *
     * @return Docentes
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set access
     *
     * @param integer $access
     *
     * @return Docentes
     */
    public function setAccess($access)
    {
        $this->access = $access;

        return $this;
    }

    /**
     * Get access
     *
     * @return integer
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Set lastlogin
     *
     * @param integer $lastlogin
     *
     * @return Docentes
     */
    public function setLastlogin($lastlogin)
    {
        $this->lastlogin = $lastlogin;

        return $this;
    }

    /**
     * Get lastlogin
     *
     * @return integer
     */
    public function getLastlogin()
    {
        return $this->lastlogin;
    }

    /**
     * Set lastactivity
     *
     * @param integer $lastactivity
     *
     * @return Docentes
     */
    public function setLastactivity($lastactivity)
    {
        $this->lastactivity = $lastactivity;

        return $this;
    }

    /**
     * Get lastactivity
     *
     * @return integer
     */
    public function getLastactivity()
    {
        return $this->lastactivity;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Docentes
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set timezone
     *
     * @param string $timezone
     *
     * @return Docentes
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;

        return $this;
    }

    /**
     * Get timezone
     *
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Set language
     *
     * @param string $language
     *
     * @return Docentes
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set picture
     *
     * @param integer $picture
     *
     * @return Docentes
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return integer
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set init
     *
     * @param string $init
     *
     * @return Docentes
     */
    public function setInit($init)
    {
        $this->init = $init;

        return $this;
    }

    /**
     * Get init
     *
     * @return string
     */
    public function getInit()
    {
        return $this->init;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Docentes
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Docentes
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }
}
