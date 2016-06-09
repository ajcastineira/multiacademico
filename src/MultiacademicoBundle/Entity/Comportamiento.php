<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use MultiacademicoBundle\Libs\Letra;
use MultiacademicoBundle\Libs\Equivalencia;

/**
 * Comportamiento
 *
 * @ORM\Table(name="comportamiento", indexes={@ORM\Index(name="FK_comportamiento", columns={"comportamientonummatricula"})})
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Repository\ComportamientoRepository")
 * @Serializer\ExclusionPolicy("none")
 */
class Comportamiento
{
    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1_p1", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1_p1", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1_p1", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1_p1", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"}) 
     */
    private $crecomendacionQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1_p2", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1_p2", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1_p2", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1_p2", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1_p3", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1_p3", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1_p3", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1_p3", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q1", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q1", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q1", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q1", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ1;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2_p1", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2_p1", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2_p1", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2_p1", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2_p2", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2_p2", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2_p2", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2_p2", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2_p3", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2_p3", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2_p3", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2_p3", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ2P3;

    /**
     * @var string
     *
     * @ORM\Column(name="agdc_q2", type="string", length=1, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $agdcQ2;

    /**
     * @var string
     *
     * @ORM\Column(name="estabien_q2", type="string", length=250, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $estabienQ2;

    /**
     * @var string
     *
     * @ORM\Column(name="mejorar_q2", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $mejorarQ2;

    /**
     * @var string
     *
     * @ORM\Column(name="crecomendacion_q2", type="string", length=500, nullable=true)
     * @Serializer\Groups({"list","detail"})
     */
    private $crecomendacionQ2;

    /**
     * @var \Matriculas
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Matriculas", inversedBy="comportamiento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="comportamientonummatricula", referencedColumnName="id")
     * })
     */
    private $comportamientonummatricula;



    /**
     * Set agdcQ1P1
     *
     * @param string $agdcQ1P1
     *
     * @return Comportamiento
     */
    public function setAgdcQ1P1($agdcQ1P1)
    {
        $this->agdcQ1P1 = $agdcQ1P1;

        return $this;
    }

    /**
     * Get agdcQ1P1
     *
     * @return string
     */
    public function getAgdcQ1P1()
    {
        return $this->agdcQ1P1;
    }

    /**
     * Set estabienQ1P1
     *
     * @param string $estabienQ1P1
     *
     * @return Comportamiento
     */
    public function setEstabienQ1P1($estabienQ1P1)
    {
        $this->estabienQ1P1 = $estabienQ1P1;

        return $this;
    }

    /**
     * Get estabienQ1P1
     *
     * @return string
     */
    public function getEstabienQ1P1()
    {
        return $this->estabienQ1P1;
    }

    /**
     * Set mejorarQ1P1
     *
     * @param string $mejorarQ1P1
     *
     * @return Comportamiento
     */
    public function setMejorarQ1P1($mejorarQ1P1)
    {
        $this->mejorarQ1P1 = $mejorarQ1P1;

        return $this;
    }

    /**
     * Get mejorarQ1P1
     *
     * @return string
     */
    public function getMejorarQ1P1()
    {
        return $this->mejorarQ1P1;
    }

    /**
     * Set crecomendacionQ1P1
     *
     * @param string $crecomendacionQ1P1
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ1P1($crecomendacionQ1P1)
    {
        $this->crecomendacionQ1P1 = $crecomendacionQ1P1;

        return $this;
    }

    /**
     * Get crecomendacionQ1P1
     *
     * @return string
     */
    public function getCrecomendacionQ1P1()
    {
        return $this->crecomendacionQ1P1;
    }

    /**
     * Set agdcQ1P2
     *
     * @param string $agdcQ1P2
     *
     * @return Comportamiento
     */
    public function setAgdcQ1P2($agdcQ1P2)
    {
        $this->agdcQ1P2 = $agdcQ1P2;

        return $this;
    }

    /**
     * Get agdcQ1P2
     *
     * @return string
     */
    public function getAgdcQ1P2()
    {
        return $this->agdcQ1P2;
    }

    /**
     * Set estabienQ1P2
     *
     * @param string $estabienQ1P2
     *
     * @return Comportamiento
     */
    public function setEstabienQ1P2($estabienQ1P2)
    {
        $this->estabienQ1P2 = $estabienQ1P2;

        return $this;
    }

    /**
     * Get estabienQ1P2
     *
     * @return string
     */
    public function getEstabienQ1P2()
    {
        return $this->estabienQ1P2;
    }

    /**
     * Set mejorarQ1P2
     *
     * @param string $mejorarQ1P2
     *
     * @return Comportamiento
     */
    public function setMejorarQ1P2($mejorarQ1P2)
    {
        $this->mejorarQ1P2 = $mejorarQ1P2;

        return $this;
    }

    /**
     * Get mejorarQ1P2
     *
     * @return string
     */
    public function getMejorarQ1P2()
    {
        return $this->mejorarQ1P2;
    }

    /**
     * Set crecomendacionQ1P2
     *
     * @param string $crecomendacionQ1P2
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ1P2($crecomendacionQ1P2)
    {
        $this->crecomendacionQ1P2 = $crecomendacionQ1P2;

        return $this;
    }

    /**
     * Get crecomendacionQ1P2
     *
     * @return string
     */
    public function getCrecomendacionQ1P2()
    {
        return $this->crecomendacionQ1P2;
    }

    /**
     * Set agdcQ1P3
     *
     * @param string $agdcQ1P3
     *
     * @return Comportamiento
     */
    public function setAgdcQ1P3($agdcQ1P3)
    {
        $this->agdcQ1P3 = $agdcQ1P3;

        return $this;
    }

    /**
     * Get agdcQ1P3
     *
     * @return string
     */
    public function getAgdcQ1P3()
    {
        return $this->agdcQ1P3;
    }

    /**
     * Set estabienQ1P3
     *
     * @param string $estabienQ1P3
     *
     * @return Comportamiento
     */
    public function setEstabienQ1P3($estabienQ1P3)
    {
        $this->estabienQ1P3 = $estabienQ1P3;

        return $this;
    }

    /**
     * Get estabienQ1P3
     *
     * @return string
     */
    public function getEstabienQ1P3()
    {
        return $this->estabienQ1P3;
    }

    /**
     * Set mejorarQ1P3
     *
     * @param string $mejorarQ1P3
     *
     * @return Comportamiento
     */
    public function setMejorarQ1P3($mejorarQ1P3)
    {
        $this->mejorarQ1P3 = $mejorarQ1P3;

        return $this;
    }

    /**
     * Get mejorarQ1P3
     *
     * @return string
     */
    public function getMejorarQ1P3()
    {
        return $this->mejorarQ1P3;
    }

    /**
     * Set crecomendacionQ1P3
     *
     * @param string $crecomendacionQ1P3
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ1P3($crecomendacionQ1P3)
    {
        $this->crecomendacionQ1P3 = $crecomendacionQ1P3;

        return $this;
    }

    /**
     * Get crecomendacionQ1P3
     *
     * @return string
     */
    public function getCrecomendacionQ1P3()
    {
        return $this->crecomendacionQ1P3;
    }

    /**
     * Set agdcQ1
     *
     * @param string $agdcQ1
     *
     * @return Comportamiento
     */
    public function setAgdcQ1($agdcQ1)
    {
        $this->agdcQ1 = $agdcQ1;

        return $this;
    }

    /**
     * Get agdcQ1
     *
     * @return string
     */
    public function getAgdcQ1()
    {
        return $this->agdcQ1;
    }

    /**
     * Set estabienQ1
     *
     * @param string $estabienQ1
     *
     * @return Comportamiento
     */
    public function setEstabienQ1($estabienQ1)
    {
        $this->estabienQ1 = $estabienQ1;

        return $this;
    }

    /**
     * Get estabienQ1
     *
     * @return string
     */
    public function getEstabienQ1()
    {
        return $this->estabienQ1;
    }

    /**
     * Set mejorarQ1
     *
     * @param string $mejorarQ1
     *
     * @return Comportamiento
     */
    public function setMejorarQ1($mejorarQ1)
    {
        $this->mejorarQ1 = $mejorarQ1;

        return $this;
    }

    /**
     * Get mejorarQ1
     *
     * @return string
     */
    public function getMejorarQ1()
    {
        return $this->mejorarQ1;
    }

    /**
     * Set crecomendacionQ1
     *
     * @param string $crecomendacionQ1
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ1($crecomendacionQ1)
    {
        $this->crecomendacionQ1 = $crecomendacionQ1;

        return $this;
    }

    /**
     * Get crecomendacionQ1
     *
     * @return string
     */
    public function getCrecomendacionQ1()
    {
        return $this->crecomendacionQ1;
    }

    /**
     * Set agdcQ2P1
     *
     * @param string $agdcQ2P1
     *
     * @return Comportamiento
     */
    public function setAgdcQ2P1($agdcQ2P1)
    {
        $this->agdcQ2P1 = $agdcQ2P1;

        return $this;
    }

    /**
     * Get agdcQ2P1
     *
     * @return string
     */
    public function getAgdcQ2P1()
    {
        return $this->agdcQ2P1;
    }

    /**
     * Set estabienQ2P1
     *
     * @param string $estabienQ2P1
     *
     * @return Comportamiento
     */
    public function setEstabienQ2P1($estabienQ2P1)
    {
        $this->estabienQ2P1 = $estabienQ2P1;

        return $this;
    }

    /**
     * Get estabienQ2P1
     *
     * @return string
     */
    public function getEstabienQ2P1()
    {
        return $this->estabienQ2P1;
    }

    /**
     * Set mejorarQ2P1
     *
     * @param string $mejorarQ2P1
     *
     * @return Comportamiento
     */
    public function setMejorarQ2P1($mejorarQ2P1)
    {
        $this->mejorarQ2P1 = $mejorarQ2P1;

        return $this;
    }

    /**
     * Get mejorarQ2P1
     *
     * @return string
     */
    public function getMejorarQ2P1()
    {
        return $this->mejorarQ2P1;
    }

    /**
     * Set crecomendacionQ2P1
     *
     * @param string $crecomendacionQ2P1
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ2P1($crecomendacionQ2P1)
    {
        $this->crecomendacionQ2P1 = $crecomendacionQ2P1;

        return $this;
    }

    /**
     * Get crecomendacionQ2P1
     *
     * @return string
     */
    public function getCrecomendacionQ2P1()
    {
        return $this->crecomendacionQ2P1;
    }

    /**
     * Set agdcQ2P2
     *
     * @param string $agdcQ2P2
     *
     * @return Comportamiento
     */
    public function setAgdcQ2P2($agdcQ2P2)
    {
        $this->agdcQ2P2 = $agdcQ2P2;

        return $this;
    }

    /**
     * Get agdcQ2P2
     *
     * @return string
     */
    public function getAgdcQ2P2()
    {
        return $this->agdcQ2P2;
    }

    /**
     * Set estabienQ2P2
     *
     * @param string $estabienQ2P2
     *
     * @return Comportamiento
     */
    public function setEstabienQ2P2($estabienQ2P2)
    {
        $this->estabienQ2P2 = $estabienQ2P2;

        return $this;
    }

    /**
     * Get estabienQ2P2
     *
     * @return string
     */
    public function getEstabienQ2P2()
    {
        return $this->estabienQ2P2;
    }

    /**
     * Set mejorarQ2P2
     *
     * @param string $mejorarQ2P2
     *
     * @return Comportamiento
     */
    public function setMejorarQ2P2($mejorarQ2P2)
    {
        $this->mejorarQ2P2 = $mejorarQ2P2;

        return $this;
    }

    /**
     * Get mejorarQ2P2
     *
     * @return string
     */
    public function getMejorarQ2P2()
    {
        return $this->mejorarQ2P2;
    }

    /**
     * Set crecomendacionQ2P2
     *
     * @param string $crecomendacionQ2P2
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ2P2($crecomendacionQ2P2)
    {
        $this->crecomendacionQ2P2 = $crecomendacionQ2P2;

        return $this;
    }

    /**
     * Get crecomendacionQ2P2
     *
     * @return string
     */
    public function getCrecomendacionQ2P2()
    {
        return $this->crecomendacionQ2P2;
    }

    /**
     * Set agdcQ2P3
     *
     * @param string $agdcQ2P3
     *
     * @return Comportamiento
     */
    public function setAgdcQ2P3($agdcQ2P3)
    {
        $this->agdcQ2P3 = $agdcQ2P3;

        return $this;
    }

    /**
     * Get agdcQ2P3
     *
     * @return string
     */
    public function getAgdcQ2P3()
    {
        return $this->agdcQ2P3;
    }

    /**
     * Set estabienQ2P3
     *
     * @param string $estabienQ2P3
     *
     * @return Comportamiento
     */
    public function setEstabienQ2P3($estabienQ2P3)
    {
        $this->estabienQ2P3 = $estabienQ2P3;

        return $this;
    }

    /**
     * Get estabienQ2P3
     *
     * @return string
     */
    public function getEstabienQ2P3()
    {
        return $this->estabienQ2P3;
    }

    /**
     * Set mejorarQ2P3
     *
     * @param string $mejorarQ2P3
     *
     * @return Comportamiento
     */
    public function setMejorarQ2P3($mejorarQ2P3)
    {
        $this->mejorarQ2P3 = $mejorarQ2P3;

        return $this;
    }

    /**
     * Get mejorarQ2P3
     *
     * @return string
     */
    public function getMejorarQ2P3()
    {
        return $this->mejorarQ2P3;
    }

    /**
     * Set crecomendacionQ2P3
     *
     * @param string $crecomendacionQ2P3
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ2P3($crecomendacionQ2P3)
    {
        $this->crecomendacionQ2P3 = $crecomendacionQ2P3;

        return $this;
    }

    /**
     * Get crecomendacionQ2P3
     *
     * @return string
     */
    public function getCrecomendacionQ2P3()
    {
        return $this->crecomendacionQ2P3;
    }

    /**
     * Set agdcQ2
     *
     * @param string $agdcQ2
     *
     * @return Comportamiento
     */
    public function setAgdcQ2($agdcQ2)
    {
        $this->agdcQ2 = $agdcQ2;

        return $this;
    }

    /**
     * Get agdcQ2
     *
     * @return string
     */
    public function getAgdcQ2()
    {
        return $this->agdcQ2;
    }

    /**
     * Set estabienQ2
     *
     * @param string $estabienQ2
     *
     * @return Comportamiento
     */
    public function setEstabienQ2($estabienQ2)
    {
        $this->estabienQ2 = $estabienQ2;

        return $this;
    }

    /**
     * Get estabienQ2
     *
     * @return string
     */
    public function getEstabienQ2()
    {
        return $this->estabienQ2;
    }

    /**
     * Set mejorarQ2
     *
     * @param string $mejorarQ2
     *
     * @return Comportamiento
     */
    public function setMejorarQ2($mejorarQ2)
    {
        $this->mejorarQ2 = $mejorarQ2;

        return $this;
    }

    /**
     * Get mejorarQ2
     *
     * @return string
     */
    public function getMejorarQ2()
    {
        return $this->mejorarQ2;
    }

    /**
     * Set crecomendacionQ2
     *
     * @param string $crecomendacionQ2
     *
     * @return Comportamiento
     */
    public function setCrecomendacionQ2($crecomendacionQ2)
    {
        $this->crecomendacionQ2 = $crecomendacionQ2;

        return $this;
    }

    /**
     * Get crecomendacionQ2
     *
     * @return string
     */
    public function getCrecomendacionQ2()
    {
        return $this->crecomendacionQ2;
    }

    /**
     * Set comportamientonummatricula
     *
     * @param \MultiacademicoBundle\Entity\Matriculas $comportamientonummatricula
     *
     * @return Comportamiento
     */
    public function setComportamientonummatricula(\MultiacademicoBundle\Entity\Matriculas $comportamientonummatricula)
    {
        $this->comportamientonummatricula = $comportamientonummatricula;

        return $this;
    }

    /**
     * Get comportamientonummatricula
     *
     * @return \MultiacademicoBundle\Entity\Matriculas
     */
    public function getComportamientonummatricula()
    {
        return $this->comportamientonummatricula;
    }
    public function getComportamientoQuimestral($q) {
        $comvar1='agdcQ'.$q.'P1';
        $comvar2='agdcQ'.$q.'P2';
        $comvar3='agdcQ'.$q.'P3';
        $pn=Letra::retornaentero((Letra::letranumero($this->$comvar1)+
            Letra::letranumero($this->$comvar2)+
            Letra::letranumero($this->$comvar3))/3);
        return Letra::retornaletra($pn);
    }
    public function getComportamientoAnual() {
        $pn=Letra::retornaentero((Letra::letranumero($this->getComportamientoQuimestral(1))+
            Letra::letranumero($this->getComportamientoQuimestral(2)))/2);
        return Letra::retornaletra($pn);
    }
    
    public function getCualidadComportamiento($letra)
    {
        return Equivalencia::retornacualidadconducta($letra);
    }
}
