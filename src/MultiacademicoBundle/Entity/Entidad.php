<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * Entidad
 *
 * @ORM\Table(name="entidad")
 * @ORM\Entity
 * @Serializer\ExclusionPolicy("none")
 */
class Entidad
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
     * @ORM\Column(name="entidad", type="string", length=200, nullable=false)
     */
    private $entidad;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=150, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="lema", type="string", length=100, nullable=false)
     */
    private $lema;

    /**
     * @var string
     *
     * @ORM\Column(name="siglas", type="string", length=15, nullable=false)
     */
    private $siglas;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=50, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=30, nullable=false)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar", type="string", length=50, nullable=false)
     */
    private $lugar;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string", length=50, nullable=false)
     */
    private $web;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=100, nullable=false)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="visitas", type="string", length=10, nullable=false)
     */
    private $visitas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="es_particular", type="boolean", nullable=false, options={"default":false})
     */
    private $esParticular;
    
    /**
     * @var string
     *
     * @ORM\Column(name="data", type="json_array", nullable=true)
     */
    private $data;
    



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
     * Set entidad
     *
     * @param string $entidad
     *
     * @return Entidad
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;

        return $this;
    }

    /**
     * Get entidad
     *
     * @return string
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Entidad
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set lema
     *
     * @param string $lema
     *
     * @return Entidad
     */
    public function setLema($lema)
    {
        $this->lema = $lema;

        return $this;
    }

    /**
     * Get lema
     *
     * @return string
     */
    public function getLema()
    {
        return $this->lema;
    }

    /**
     * Set siglas
     *
     * @param string $siglas
     *
     * @return Entidad
     */
    public function setSiglas($siglas)
    {
        $this->siglas = $siglas;

        return $this;
    }

    /**
     * Get siglas
     *
     * @return string
     */
    public function getSiglas()
    {
        return $this->siglas;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Entidad
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Entidad
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     *
     * @return Entidad
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;

        return $this;
    }

    /**
     * Get lugar
     *
     * @return string
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set web
     *
     * @param string $web
     *
     * @return Entidad
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }

    /**
     * Get web
     *
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Entidad
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Entidad
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set visitas
     *
     * @param string $visitas
     *
     * @return Entidad
     */
    public function setVisitas($visitas)
    {
        $this->visitas = $visitas;

        return $this;
    }

    /**
     * Get visitas
     *
     * @return string
     */
    public function getVisitas()
    {
        return $this->visitas;
    }

    /**
     * Set data
     *
     * @param string $data
     *
     * @return Entidad
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
     * 
     * @return boolean
     */
    public function getEsParticular() {
        return $this->esParticular;
    }
    
    /**
     * 
     * @param boolean $esParticular
     * @return Entidad
     */
    public function setEsParticular($esParticular) {
        $this->esParticular = $esParticular;
        return $this;
    }


}
