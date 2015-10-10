<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estudiantes
 *
 * @ORM\Table(name="estudiantes")
 * @ORM\Entity
 */
class Estudiantes
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
     * @ORM\Column(name="estudiante_cedula", type="string", length=10, nullable=false)
     */
    private $estudianteCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante", type="string", length=50, nullable=false)
     */
    private $estudiante;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_fechanacimiento", type="string", length=10, nullable=false)
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
    private $estudianteConae;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_etnia", type="string", length=20, nullable=false)
     */
    private $estudianteEtnia;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_plantel", type="string", length=50, nullable=false)
     */
    private $estudiantePlantel;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_correo", type="string", length=50, nullable=false)
     */
    private $estudianteCorreo;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_carnet", type="string", length=2, nullable=false)
     */
    private $estudianteCarnet;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_foto", type="string", length=100, nullable=false)
     */
    private $estudianteFoto;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_estado", type="string", length=15, nullable=false)
     */
    private $estudianteEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="estudiante_numeroacta", type="string", length=3, nullable=false)
     */
    private $estudianteNumeroacta;

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
    private $representanteCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="representante", type="string", length=50, nullable=false)
     */
    private $representante;

    /**
     * @var string
     *
     * @ORM\Column(name="representante_domicilio", type="string", length=50, nullable=false)
     */
    private $representanteDomicilio;

    /**
     * @var string
     *
     * @ORM\Column(name="representante_telefono", type="string", length=20, nullable=false)
     */
    private $representanteTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="representante_tipo", type="string", length=5, nullable=false)
     */
    private $representanteTipo;

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
     * Constructor
     */
    public function __construct()
    {
        $this->codclub = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

