<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\Collection, Doctrine\Common\Collections\ArrayCollection;

/**
 * Representantes
 *
 * @ORM\Table(name="representantes",  indexes={@ORM\Index(name="representante", columns={"representante"})})
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\RepresentantesRepository")
  * @Serializer\ExclusionPolicy("all")
 */
class Representantes
{
 /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned":true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="representante", type="string", length=50, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $representante;

    /**
     * @var float
     *
     * @ORM\Column(name="monto_mensual", type="float", precision=10, scale=0, nullable=false)
     */
    private $montoMensual;

  /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

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
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */

    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     *
     * @ORM\OneToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codusuario", referencedColumnName="id")
     * })
     * @Serializer\Expose
     * @Serializer\Groups({"estadisticas"})
     */
    private $usuario;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set representante
     *
     * @param string $representante
     *
     * @return Representantes
     */
    public function setRepresentante($representante)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get representante
     *
     * @return string
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Set montoMensual
     *
     * @param float $montoMensual
     *
     * @return Representantes
     */
    public function setMontoMensual($montoMensual)
    {
        $this->montoMensual = $montoMensual;

        return $this;
    }

    /**
     * Get montoMensual
     *
     * @return float
     */
    public function getMontoMensual()
    {
        return $this->montoMensual;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Representantes
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
     * Set password
     *
     * @param string $password
     *
     * @return Representantes
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
     * Set salt
     *
     * @param string $salt
     *
     * @return Representante
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
     * Set lastlogin
     *
     * @param integer $lastlogin
     *
     * @return Representante
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
     * @return Representantes
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
     * @return Representantes
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
     * 
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getUsuario() {
        return $this->usuario;
    }

    /**
     * 
     * @param \Multiservices\ArxisBundle\Entity\Usuario $usuario
     * @return \MultiacademicoBundle\Entity\Representantes
     */
    public function setUsuario(\Multiservices\ArxisBundle\Entity\Usuario $usuario) {
        $this->usuario = $usuario;
        return $this;
    }
    public function __toString() {
        return $this->representante;
    }
}

