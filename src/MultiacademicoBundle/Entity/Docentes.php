<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Multiservices\ArxisBundle\Validator\Constraints as ArxisAssert;
use MultiacademicoBundle\Validator\Constraints\DocenteEmail;

/**
 * Docentes
 *
 * @ORM\Table(name="docentes")
 * @ORM\Entity
 * @UniqueEntity({"docentecedula"}, message="Cedula ya registrada en el sistema")
 * @UniqueEntity({"docenteemail"}, message="Este email ya existe en el sistema")
 * @UniqueEntity({"docente"}, message="Este nombre ya existe en el sistema")
 * @DocenteEmail
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
     * @Assert\Email()
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
    private $docenteestado="Activo";

    /**
     * @var string
     *
     * @ArxisAssert\Username
     */
    private $username;
    
    /**
     * @var string
     *
     * 
     */
    private $password;



    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     */
    private $path;


    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", nullable=true)
     */
    private $data;

    
    /**
     * @var \Multiservices\ArxisBundle\Entity\Usuario
     *
     *
     * @ORM\OneToOne(targetEntity="\Multiservices\ArxisBundle\Entity\Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codusuario", referencedColumnName="id")
     * })
     */
    private $usuario;
    
     /**
     * 
     * 
     * @ORM\OneToMany(targetEntity="Distributivos", mappedBy="distributivocoddocente")
     * 
     */
    private $distributivos;
    



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
     * 
     * @return \Multiservices\ArxisBundle\Entity\Usuario
     */
    public function getUsuario() {
        return $this->usuario;
    }
    /**
     * 
     * @param \Multiservices\ArxisBundle\Entity\Usuario $usuario
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function setUsuario(\Multiservices\ArxisBundle\Entity\Usuario $usuario) {
        $this->usuario = $usuario;
        return $this;
    }
    
    
    public function __toString() {
        return $this->docente;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->distributivos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add distributivo
     *
     * @param \MultiacademicoBundle\Entity\Distributivos $distributivo
     *
     * @return Docentes
     */
    public function addDistributivo(\MultiacademicoBundle\Entity\Distributivos $distributivo)
    {
        $this->distributivos[] = $distributivo;

        return $this;
    }

    /**
     * Remove distributivo
     *
     * @param \MultiacademicoBundle\Entity\Distributivos $distributivo
     */
    public function removeDistributivo(\MultiacademicoBundle\Entity\Distributivos $distributivo)
    {
        $this->distributivos->removeElement($distributivo);
    }

    /**
     * Get distributivos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDistributivos()
    {
        return $this->distributivos;
    }
}
