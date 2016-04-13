<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\Collection, Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Multiservices\ArxisBundle\Validator\Constraints as ArxisAssert;

/**
 * Estudiantes
 *
 * @ORM\Table(name="estudiantes",  indexes={@ORM\Index(name="estudiante", columns={"estudiante"})})
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Entity\EstudiantesRepository")
 * @UniqueEntity({"estudianteCedula"}, message="Cedula ya registrada en el sistema")
 * @UniqueEntity({"mail"}, message="Este email ya existe en el sistema")
 * @UniqueEntity({"estudiante"}, message="Este nombre ya existe en el sistema")
 * @Serializer\ExclusionPolicy("all")
 */
class Estudiantes
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
     * @ORM\Column(name="estudiante_cedula", type="string", length=10, nullable=false)
     */
    private $estudianteCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante", type="string", length=50, nullable=false)
     * @Serializer\Expose
     * @Serializer\Groups({"list","detail"})
     */
    private $estudiante;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_fechanacimiento", type="date", nullable=false)
     */
    private $estudianteFechanacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_nacionalidad", type="string", length=20, nullable=false)
     */
    private $estudianteNacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_lugarnacimiento", type="string", length=30, nullable=false)
     */
    private $estudianteLugarnacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_provincia_n", type="string", length=30, nullable=false)
     */
    private $estudianteProvinciaN;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_canton_n", type="string", length=30, nullable=false)
     */
    private $estudianteCantonN;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_parroquia_n", type="string", length=30, nullable=false)
     */
    private $estudianteParroquiaN;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_domicilio", type="string", length=50, nullable=false)
     */
    private $estudianteDomicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_provincia_d", type="string", length=30, nullable=false)
     */
    private $estudianteProvinciaD;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_canton_d", type="string", length=30, nullable=false)
     */
    private $estudianteCantonD;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_parroquia_d", type="string", length=30, nullable=false)
     */
    private $estudianteParroquiaD;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_genero", type="string", length=9, nullable=false)
     */
    private $estudianteGenero;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_discapacidad", type="string", length=2, nullable=false)
     */
    private $estudianteDiscapacidad;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_conae", type="string", length=5, nullable=false)
     */
    private $estudianteConae="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_etnia", type="string", length=20, nullable=false)
     */
    private $estudianteEtnia="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_plantel", type="string", length=50, nullable=false)
     */
    private $estudiantePlantel="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_correo", type="string", length=50, nullable=false)
     */
    private $estudianteCorreo="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_carnet", type="string", length=2, nullable=false)
     */
    private $estudianteCarnet="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_foto", type="string", length=100, nullable=false)
     */
    private $estudianteFoto="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_estado", type="string", length=15, nullable=false)
     */
    private $estudianteEstado="";

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_numeroacta", type="string", length=3, nullable=false)
     */
    private $estudianteNumeroacta="";

    /**
     * @var string
     *
     * @ORM\Column(name="madre", type="string", length=50, nullable=false)
     */
    private $madre;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_cedula", type="string", length=10, nullable=false)
     */
    private $madreCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_estadocivil", type="string", length=12, nullable=false)
     */
    private $madreEstadocivil;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_telefono", type="string", length=20, nullable=false)
     */
    private $madreTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_domicilio", type="string", length=50, nullable=false)
     */
    private $madreDomicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="madre_bono", type="string", length=2, nullable=false)
     */
    private $madreBono;

    /**
     * @var string
     *
     * @ORM\Column(name="padre", type="string", length=50, nullable=false)
     */
    private $padre;

    /**
     * @var string
     *
     * @ORM\Column(name="padre_cedula", type="string", length=10, nullable=false)
     */
    private $padreCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="padre_estadocivil", type="string", length=12, nullable=false)
     */
    private $padreEstadocivil;

    /**
     * @var string
     *
     * @ORM\Column(name="padre_telefono", type="string", length=20, nullable=false)
     */
    private $padreTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="padre_domicilio", type="string", length=50, nullable=false)
     */
    private $padreDomicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="representante_cedula", type="string", length=12, nullable=false)
     */
    private $representanteCedula=0;

    /**
     * @var \MultiacademicoBundle\Entity\Representantes
     *
     * @ORM\ManyToOne(targetEntity="\MultiacademicoBundle\Entity\Representantes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="representante_id", referencedColumnName="id")
     * })
     */
    private $representante;
    
    /**
     * @var string
     *
     * @ORM\Column(name="representante", type="string", length=50, nullable=false)
     */
    private $representanteNombre="";

    /**
     * @var string
     *
     * @ORM\Column(name="representante_domicilio", type="string", length=50, nullable=false)
     */
    private $representanteDomicilio="";

    /**
     * @var string
     *
     * @ORM\Column(name="representante_telefono", type="string", length=20, nullable=false)
     */
    private $representanteTelefono="";

    /**
     * @var string
     *
     * @ORM\Column(name="representante_tipo", type="string", length=5, nullable=false)
     */
    private $representanteTipo="";

    /**
     * @var string
     *
     * @ArxisAssert\Username
     */
    private $username;

    /**
     * @var string
     *
     */
    private $password="";

    
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
    private $theme="";

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=255, nullable=false)
     */
    private $signature="";

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
    private $created=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="access", type="integer", nullable=false)
     */
    private $access=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastlogin", type="integer", nullable=false)
     */
    private $lastlogin=0;

    /**
     * @var integer
     *
     * @ORM\Column(name="lastactivity", type="integer", nullable=false)
     */
    private $lastactivity=0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status=true;

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
    private $language="";

    /**
     * @var integer
     *
     * @ORM\Column(name="picture", type="integer", nullable=false)
     */
    private $picture=0;

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
     * @ArxisAssert\Email
     */
    private $mail;
    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection
     * @ORM\OneToMany(targetEntity="\MultiacademicoBundle\Entity\Matriculas", mappedBy="matriculacodestudiante")
     */
    private $matriculas;
    
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
     *
     * @var \MultiacademicoBundle\Entity\ClubesDetalle
     * @ORM\OneToOne(targetEntity="\MultiacademicoBundle\Entity\ClubesDetalle", mappedBy="clubescodestudiante")
     */
    private $codclub;
    
    /**
     * @ORM\OneToMany(targetEntity="Pension", mappedBy="estudiante")
     */
    private $pensiones;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->codclub = new ArrayCollection();
        $this->matriculas = new ArrayCollection();
        $this->pensiones = new ArrayCollection();
    }


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
     * Set estudianteCedula
     *
     * @param string $estudianteCedula
     *
     * @return Estudiantes
     */
    public function setEstudianteCedula($estudianteCedula)
    {
        $this->estudianteCedula = $estudianteCedula;

        return $this;
    }

    /**
     * Get estudianteCedula
     *
     * @return string
     */
    public function getEstudianteCedula()
    {
        return $this->estudianteCedula;
    }

    /**
     * Set estudiante
     *
     * @param string $estudiante
     *
     * @return Estudiantes
     */
    public function setEstudiante($estudiante)
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * Get estudiante
     *
     * @return string
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * Set estudianteFechanacimiento
     *
     * @param string $estudianteFechanacimiento
     *
     * @return Estudiantes
     */
    public function setEstudianteFechanacimiento($estudianteFechanacimiento)
    {
        $this->estudianteFechanacimiento = $estudianteFechanacimiento;

        return $this;
    }

    /**
     * Get estudianteFechanacimiento
     *
     * @return string
     */
    public function getEstudianteFechanacimiento()
    {
        return $this->estudianteFechanacimiento;
    }

    /**
     * Set estudianteNacionalidad
     *
     * @param string $estudianteNacionalidad
     *
     * @return Estudiantes
     */
    public function setEstudianteNacionalidad($estudianteNacionalidad)
    {
        $this->estudianteNacionalidad = $estudianteNacionalidad;

        return $this;
    }

    /**
     * Get estudianteNacionalidad
     *
     * @return string
     */
    public function getEstudianteNacionalidad()
    {
        return $this->estudianteNacionalidad;
    }

    /**
     * Set estudianteLugarnacimiento
     *
     * @param string $estudianteLugarnacimiento
     *
     * @return Estudiantes
     */
    public function setEstudianteLugarnacimiento($estudianteLugarnacimiento)
    {
        $this->estudianteLugarnacimiento = $estudianteLugarnacimiento;

        return $this;
    }

    /**
     * Get estudianteLugarnacimiento
     *
     * @return string
     */
    public function getEstudianteLugarnacimiento()
    {
        return $this->estudianteLugarnacimiento;
    }

    /**
     * Set estudianteProvinciaN
     *
     * @param string $estudianteProvinciaN
     *
     * @return Estudiantes
     */
    public function setEstudianteProvinciaN($estudianteProvinciaN)
    {
        $this->estudianteProvinciaN = $estudianteProvinciaN;

        return $this;
    }

    /**
     * Get estudianteProvinciaN
     *
     * @return string
     */
    public function getEstudianteProvinciaN()
    {
        return $this->estudianteProvinciaN;
    }

    /**
     * Set estudianteCantonN
     *
     * @param string $estudianteCantonN
     *
     * @return Estudiantes
     */
    public function setEstudianteCantonN($estudianteCantonN)
    {
        $this->estudianteCantonN = $estudianteCantonN;

        return $this;
    }

    /**
     * Get estudianteCantonN
     *
     * @return string
     */
    public function getEstudianteCantonN()
    {
        return $this->estudianteCantonN;
    }

    /**
     * Set estudianteParroquiaN
     *
     * @param string $estudianteParroquiaN
     *
     * @return Estudiantes
     */
    public function setEstudianteParroquiaN($estudianteParroquiaN)
    {
        $this->estudianteParroquiaN = $estudianteParroquiaN;

        return $this;
    }

    /**
     * Get estudianteParroquiaN
     *
     * @return string
     */
    public function getEstudianteParroquiaN()
    {
        return $this->estudianteParroquiaN;
    }

    /**
     * Set estudianteDomicilio
     *
     * @param string $estudianteDomicilio
     *
     * @return Estudiantes
     */
    public function setEstudianteDomicilio($estudianteDomicilio)
    {
        $this->estudianteDomicilio = $estudianteDomicilio;

        return $this;
    }

    /**
     * Get estudianteDomicilio
     *
     * @return string
     */
    public function getEstudianteDomicilio()
    {
        return $this->estudianteDomicilio;
    }

    /**
     * Set estudianteProvinciaD
     *
     * @param string $estudianteProvinciaD
     *
     * @return Estudiantes
     */
    public function setEstudianteProvinciaD($estudianteProvinciaD)
    {
        $this->estudianteProvinciaD = $estudianteProvinciaD;

        return $this;
    }

    /**
     * Get estudianteProvinciaD
     *
     * @return string
     */
    public function getEstudianteProvinciaD()
    {
        return $this->estudianteProvinciaD;
    }

    /**
     * Set estudianteCantonD
     *
     * @param string $estudianteCantonD
     *
     * @return Estudiantes
     */
    public function setEstudianteCantonD($estudianteCantonD)
    {
        $this->estudianteCantonD = $estudianteCantonD;

        return $this;
    }

    /**
     * Get estudianteCantonD
     *
     * @return string
     */
    public function getEstudianteCantonD()
    {
        return $this->estudianteCantonD;
    }

    /**
     * Set estudianteParroquiaD
     *
     * @param string $estudianteParroquiaD
     *
     * @return Estudiantes
     */
    public function setEstudianteParroquiaD($estudianteParroquiaD)
    {
        $this->estudianteParroquiaD = $estudianteParroquiaD;

        return $this;
    }

    /**
     * Get estudianteParroquiaD
     *
     * @return string
     */
    public function getEstudianteParroquiaD()
    {
        return $this->estudianteParroquiaD;
    }

    /**
     * Set estudianteGenero
     *
     * @param string $estudianteGenero
     *
     * @return Estudiantes
     */
    public function setEstudianteGenero($estudianteGenero)
    {
        $this->estudianteGenero = $estudianteGenero;

        return $this;
    }

    /**
     * Get estudianteGenero
     *
     * @return string
     */
    public function getEstudianteGenero()
    {
        return $this->estudianteGenero;
    }

    /**
     * Set estudianteDiscapacidad
     *
     * @param string $estudianteDiscapacidad
     *
     * @return Estudiantes
     */
    public function setEstudianteDiscapacidad($estudianteDiscapacidad)
    {
        $this->estudianteDiscapacidad = $estudianteDiscapacidad;

        return $this;
    }

    /**
     * Get estudianteDiscapacidad
     *
     * @return string
     */
    public function getEstudianteDiscapacidad()
    {
        return $this->estudianteDiscapacidad;
    }

    /**
     * Set estudianteConae
     *
     * @param string $estudianteConae
     *
     * @return Estudiantes
     */
    public function setEstudianteConae($estudianteConae)
    {
        $this->estudianteConae = $estudianteConae;

        return $this;
    }

    /**
     * Get estudianteConae
     *
     * @return string
     */
    public function getEstudianteConae()
    {
        return $this->estudianteConae;
    }

    /**
     * Set estudianteEtnia
     *
     * @param string $estudianteEtnia
     *
     * @return Estudiantes
     */
    public function setEstudianteEtnia($estudianteEtnia)
    {
        $this->estudianteEtnia = $estudianteEtnia;

        return $this;
    }

    /**
     * Get estudianteEtnia
     *
     * @return string
     */
    public function getEstudianteEtnia()
    {
        return $this->estudianteEtnia;
    }

    /**
     * Set estudiantePlantel
     *
     * @param string $estudiantePlantel
     *
     * @return Estudiantes
     */
    public function setEstudiantePlantel($estudiantePlantel)
    {
        $this->estudiantePlantel = $estudiantePlantel;

        return $this;
    }

    /**
     * Get estudiantePlantel
     *
     * @return string
     */
    public function getEstudiantePlantel()
    {
        return $this->estudiantePlantel;
    }

    /**
     * Set estudianteCorreo
     *
     * @param string $estudianteCorreo
     *
     * @return Estudiantes
     */
    public function setEstudianteCorreo($estudianteCorreo)
    {
        $this->estudianteCorreo = $estudianteCorreo;

        return $this;
    }

    /**
     * Get estudianteCorreo
     *
     * @return string
     */
    public function getEstudianteCorreo()
    {
        return $this->estudianteCorreo;
    }

    /**
     * Set estudianteCarnet
     *
     * @param string $estudianteCarnet
     *
     * @return Estudiantes
     */
    public function setEstudianteCarnet($estudianteCarnet)
    {
        $this->estudianteCarnet = $estudianteCarnet;

        return $this;
    }

    /**
     * Get estudianteCarnet
     *
     * @return string
     */
    public function getEstudianteCarnet()
    {
        return $this->estudianteCarnet;
    }

    /**
     * Set estudianteFoto
     *
     * @param string $estudianteFoto
     *
     * @return Estudiantes
     */
    public function setEstudianteFoto($estudianteFoto)
    {
        $this->estudianteFoto = $estudianteFoto;

        return $this;
    }

    /**
     * Get estudianteFoto
     *
     * @return string
     */
    public function getEstudianteFoto()
    {
        return $this->estudianteFoto;
    }

    /**
     * Set estudianteEstado
     *
     * @param string $estudianteEstado
     *
     * @return Estudiantes
     */
    public function setEstudianteEstado($estudianteEstado)
    {
        $this->estudianteEstado = $estudianteEstado;

        return $this;
    }

    /**
     * Get estudianteEstado
     *
     * @return string
     */
    public function getEstudianteEstado()
    {
        return $this->estudianteEstado;
    }

    /**
     * Set estudianteNumeroacta
     *
     * @param string $estudianteNumeroacta
     *
     * @return Estudiantes
     */
    public function setEstudianteNumeroacta($estudianteNumeroacta)
    {
        $this->estudianteNumeroacta = $estudianteNumeroacta;

        return $this;
    }

    /**
     * Get estudianteNumeroacta
     *
     * @return string
     */
    public function getEstudianteNumeroacta()
    {
        return $this->estudianteNumeroacta;
    }

    /**
     * Set madre
     *
     * @param string $madre
     *
     * @return Estudiantes
     */
    public function setMadre($madre)
    {
        $this->madre = $madre;

        return $this;
    }

    /**
     * Get madre
     *
     * @return string
     */
    public function getMadre()
    {
        return $this->madre;
    }

    /**
     * Set madreCedula
     *
     * @param string $madreCedula
     *
     * @return Estudiantes
     */
    public function setMadreCedula($madreCedula)
    {
        $this->madreCedula = $madreCedula;

        return $this;
    }

    /**
     * Get madreCedula
     *
     * @return string
     */
    public function getMadreCedula()
    {
        return $this->madreCedula;
    }

    /**
     * Set madreEstadocivil
     *
     * @param string $madreEstadocivil
     *
     * @return Estudiantes
     */
    public function setMadreEstadocivil($madreEstadocivil)
    {
        $this->madreEstadocivil = $madreEstadocivil;

        return $this;
    }

    /**
     * Get madreEstadocivil
     *
     * @return string
     */
    public function getMadreEstadocivil()
    {
        return $this->madreEstadocivil;
    }

    /**
     * Set madreTelefono
     *
     * @param string $madreTelefono
     *
     * @return Estudiantes
     */
    public function setMadreTelefono($madreTelefono)
    {
        $this->madreTelefono = $madreTelefono;

        return $this;
    }

    /**
     * Get madreTelefono
     *
     * @return string
     */
    public function getMadreTelefono()
    {
        return $this->madreTelefono;
    }

    /**
     * Set madreDomicilio
     *
     * @param string $madreDomicilio
     *
     * @return Estudiantes
     */
    public function setMadreDomicilio($madreDomicilio)
    {
        $this->madreDomicilio = $madreDomicilio;

        return $this;
    }

    /**
     * Get madreDomicilio
     *
     * @return string
     */
    public function getMadreDomicilio()
    {
        return $this->madreDomicilio;
    }

    /**
     * Set madreBono
     *
     * @param string $madreBono
     *
     * @return Estudiantes
     */
    public function setMadreBono($madreBono)
    {
        $this->madreBono = $madreBono;

        return $this;
    }

    /**
     * Get madreBono
     *
     * @return string
     */
    public function getMadreBono()
    {
        return $this->madreBono;
    }

    /**
     * Set padre
     *
     * @param string $padre
     *
     * @return Estudiantes
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * Get padre
     *
     * @return string
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Set padreCedula
     *
     * @param string $padreCedula
     *
     * @return Estudiantes
     */
    public function setPadreCedula($padreCedula)
    {
        $this->padreCedula = $padreCedula;

        return $this;
    }

    /**
     * Get padreCedula
     *
     * @return string
     */
    public function getPadreCedula()
    {
        return $this->padreCedula;
    }

    /**
     * Set padreEstadocivil
     *
     * @param string $padreEstadocivil
     *
     * @return Estudiantes
     */
    public function setPadreEstadocivil($padreEstadocivil)
    {
        $this->padreEstadocivil = $padreEstadocivil;

        return $this;
    }

    /**
     * Get padreEstadocivil
     *
     * @return string
     */
    public function getPadreEstadocivil()
    {
        return $this->padreEstadocivil;
    }

    /**
     * Set padreTelefono
     *
     * @param string $padreTelefono
     *
     * @return Estudiantes
     */
    public function setPadreTelefono($padreTelefono)
    {
        $this->padreTelefono = $padreTelefono;

        return $this;
    }

    /**
     * Get padreTelefono
     *
     * @return string
     */
    public function getPadreTelefono()
    {
        return $this->padreTelefono;
    }

    /**
     * Set padreDomicilio
     *
     * @param string $padreDomicilio
     *
     * @return Estudiantes
     */
    public function setPadreDomicilio($padreDomicilio)
    {
        $this->padreDomicilio = $padreDomicilio;

        return $this;
    }

    /**
     * Get padreDomicilio
     *
     * @return string
     */
    public function getPadreDomicilio()
    {
        return $this->padreDomicilio;
    }

    /**
     * Set representanteCedula
     *
     * @param string $representanteCedula
     *
     * @return Estudiantes
     */
    public function setRepresentanteCedula($representanteCedula)
    {
        $this->representanteCedula = $representanteCedula;

        return $this;
    }

    /**
     * Get representanteCedula
     *
     * @return string
     */
    public function getRepresentanteCedula()
    {
        return $this->representanteCedula;
    }

    /**
     * Set representanteDomicilio
     *
     * @param string $representanteDomicilio
     *
     * @return Estudiantes
     */
    public function setRepresentanteDomicilio($representanteDomicilio)
    {
        $this->representanteDomicilio = $representanteDomicilio;

        return $this;
    }

    /**
     * Get representanteDomicilio
     *
     * @return string
     */
    public function getRepresentanteDomicilio()
    {
        return $this->representanteDomicilio;
    }

    /**
     * Set representanteTelefono
     *
     * @param string $representanteTelefono
     *
     * @return Estudiantes
     */
    public function setRepresentanteTelefono($representanteTelefono)
    {
        $this->representanteTelefono = $representanteTelefono;

        return $this;
    }

    /**
     * Get representanteTelefono
     *
     * @return string
     */
    public function getRepresentanteTelefono()
    {
        return $this->representanteTelefono;
    }

    /**
     * Set representanteTipo
     *
     * @param string $representanteTipo
     *
     * @return Estudiantes
     */
    public function setRepresentanteTipo($representanteTipo)
    {
        $this->representanteTipo = $representanteTipo;

        return $this;
    }

    /**
     * Get representanteTipo
     *
     * @return string
     */
    public function getRepresentanteTipo()
    {
        return $this->representanteTipo;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Estudiantes
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
     * @return Estudiantes
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
     * Set path
     *
     * @param string $path
     *
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
     * @return Estudiantes
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
    
    /**
     * 
     * @return \Doctrine\Common\Collections\ArrayCollection
     */
    public function getMatriculas() {
        
        return $this->matriculas;
    }
    
    /**
     * 
     * @param \Doctrine\Common\Collections\ArrayCollection $matriculas
     * @return \MultiacademicoBundle\Entity\Estudiantes
     */
    public function setMatriculas(\Doctrine\Common\Collections\ArrayCollection $matriculas) {
        $this->matriculas = $matriculas;
        return $this;
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
     * @return \MultiacademicoBundle\Entity\Estudiantes
     */
    public function setUsuario(\Multiservices\ArxisBundle\Entity\Usuario $usuario) {
        $this->usuario = $usuario;
        return $this;
    }
    /**
     * 
     * @return \MultiacademicoBundle\Entity\Matriculas
     */
    public function getMatriculaVigente() {
        $matriculas=$this->matriculas->toArray();
        if (isset($matriculas[0]))
        {return $matriculas[0];}
            else
            {return null;}
    }
    /**
     * 
     * @return \MultiacademicoBundle\Entity\ClubesDetalle
     */
    public function getCodclub() {
        return $this->codclub;
    }
    /**
     * 
     * @param \MultiacademicoBundle\Entity\ClubesDetalle $codclub
     * @return \MultiacademicoBundle\Entity\Estudiantes
     */
    public function setCodclub(\MultiacademicoBundle\Entity\ClubesDetalle $codclub) {
        $this->codclub = $codclub;
        return $this;
    }

        
    
    public function __toString() {
        return $this->estudiante;
    }

    /**
     * Set representanteNombre
     *
     * @param string $representanteNombre
     *
     * @return Estudiantes
     */
    public function setRepresentanteNombre($representanteNombre)
    {
        $this->representanteNombre = $representanteNombre;

        return $this;
    }

    /**
     * Get representanteNombre
     *
     * @return string
     */
    public function getRepresentanteNombre()
    {
        return $this->representanteNombre;
    }

    /**
     * Set representante
     *
     * @param \MultiacademicoBundle\Entity\Representantes $representante
     *
     * @return Estudiantes
     */
    public function setRepresentante(\MultiacademicoBundle\Entity\Representantes $representante = null)
    {
        $this->representante = $representante;

        return $this;
    }

    /**
     * Get representante
     *
     * @return \MultiacademicoBundle\Entity\Representantes
     */
    public function getRepresentante()
    {
        return $this->representante;
    }

    /**
     * Add matricula
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $matricula
     *
     * @return Estudiantes
     */
    public function addMatricula(\MultiacademicoBundle\Entity\Matriculas $matricula)
    {
        $this->matriculas[] = $matricula;

        return $this;
    }

    /**
     * Remove matricula
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $matricula
     */
    public function removeMatricula(\MultiacademicoBundle\Entity\Matriculas $matricula)
    {
        $this->matriculas->removeElement($matricula);
    }
}
