<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use MultiacademicoBundle\Libs\Letra;
use Doctrine\Common\Collections\Collection, Doctrine\Common\Collections\ArrayCollection;
use MultiacademicoBundle\Libs\Equivalencia;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * ClubesDetalle
 *
 * @ORM\Table(name="clubes_detalle",
 *           uniqueConstraints={@ORM\UniqueConstraint(name="search_codestudiante", columns={"clubescodestudiante"})},
 *           indexes={@ORM\Index(name="codclub", columns={"codclub"}), @ORM\Index(name="clubescodestudiante", columns={"clubescodestudiante"})})
 * @ORM\Entity
 * @UniqueEntity(fields={"clubescodestudiante"}, message="El Estudiante {{ value }} ya esta registrado en otro Proyecto Escolar")
 */
class ClubesDetalle
{
    /**
     * @var string
     *
     * @ORM\Column(name="nota_q1_p1", type="string", length=2, nullable=true)
     */
    private $notaQ1P1;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q1_p2", type="string", length=2, nullable=true)
     */
    private $notaQ1P2;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q1_p3", type="string", length=2, nullable=true)
     */
    private $notaQ1P3;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q2_p1", type="string", length=2, nullable=true)
     */
    private $notaQ2P1;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q2_p2", type="string", length=2, nullable=true)
     */
    private $notaQ2P2;

    /**
     * @var string
     *
     * @ORM\Column(name="nota_q2_p3", type="string", length=2, nullable=true)
     */
    private $notaQ2P3;

    /**
     * @var \Clubes
     *
     * @ORM\ManyToOne(targetEntity="Clubes", inversedBy="registrados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codclub", referencedColumnName="id", nullable=false)
     * })
     */
    private $codclub;

    /**
     * @var \Estudiantes
     *
     * @ORM\Id
     * ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Estudiantes", inversedBy="codclub")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clubescodestudiante", referencedColumnName="id", unique=true)
     * })
     */
    private $clubescodestudiante;
    
  
    
    /**
     * Set notaQ1P1
     *
     * @param string $notaQ1P1
     *
     * @return ClubesDetalle
     */
    public function setNotaQ1P1($notaQ1P1)
    {
        $this->notaQ1P1 = $notaQ1P1;

        return $this;
    }

    /**
     * Get notaQ1P1
     *
     * @return string
     */
    public function getNotaQ1P1()
    {
        return $this->notaQ1P1;
    }

    /**
     * Set notaQ1P2
     *
     * @param string $notaQ1P2
     *
     * @return ClubesDetalle
     */
    public function setNotaQ1P2($notaQ1P2)
    {
        $this->notaQ1P2 = $notaQ1P2;

        return $this;
    }

    /**
     * Get notaQ1P2
     *
     * @return string
     */
    public function getNotaQ1P2()
    {
        return $this->notaQ1P2;
    }

    /**
     * Set notaQ1P3
     *
     * @param string $notaQ1P3
     *
     * @return ClubesDetalle
     */
    public function setNotaQ1P3($notaQ1P3)
    {
        $this->notaQ1P3 = $notaQ1P3;

        return $this;
    }

    /**
     * Get notaQ1P3
     *
     * @return string
     */
    public function getNotaQ1P3()
    {
        return $this->notaQ1P3;
    }

    /**
     * Set notaQ2P1
     *
     * @param string $notaQ2P1
     *
     * @return ClubesDetalle
     */
    public function setNotaQ2P1($notaQ2P1)
    {
        $this->notaQ2P1 = $notaQ2P1;

        return $this;
    }

    /**
     * Get notaQ2P1
     *
     * @return string
     */
    public function getNotaQ2P1()
    {
        return $this->notaQ2P1;
    }

    /**
     * Set notaQ2P2
     *
     * @param string $notaQ2P2
     *
     * @return ClubesDetalle
     */
    public function setNotaQ2P2($notaQ2P2)
    {
        $this->notaQ2P2 = $notaQ2P2;

        return $this;
    }

    /**
     * Get notaQ2P2
     *
     * @return string
     */
    public function getNotaQ2P2()
    {
        return $this->notaQ2P2;
    }

    /**
     * Set notaQ2P3
     *
     * @param string $notaQ2P3
     *
     * @return ClubesDetalle
     */
    public function setNotaQ2P3($notaQ2P3)
    {
        $this->notaQ2P3 = $notaQ2P3;

        return $this;
    }

    /**
     * Get notaQ2P3
     *
     * @return string
     */
    public function getNotaQ2P3()
    {
        return $this->notaQ2P3;
    }

    /**
     * Set codclub
     *
     * @param \MultiacademicoBundle\Entity\Clubes $codclub
     *
     * @return ClubesDetalle
     */
    public function setCodclub(\MultiacademicoBundle\Entity\Clubes $codclub)
    {
        $this->codclub = $codclub;

        return $this;
    }

    /**
     * Get codclub
     *
     * @return \MultiacademicoBundle\Entity\Clubes
     */
    public function getCodclub()
    {
        return $this->codclub;
    }

    /**
     * Set clubescodestudiante
     *
     * @param \MultiacademicoBundle\Entity\Estudiantes $clubescodestudiante
     *
     * @return ClubesDetalle
     */
    public function setClubescodestudiante(\MultiacademicoBundle\Entity\Estudiantes $clubescodestudiante)
    {
        $this->clubescodestudiante = $clubescodestudiante;

        return $this;
    }

    /**
     * Get clubescodestudiante
     *
     * @return \MultiacademicoBundle\Entity\Estudiantes
     */
    public function getClubescodestudiante()
    {
        return $this->clubescodestudiante;
    }

    public function getClubNotaQuimestral($q)
    {
        
       $sumq=0;
       
        for($p=1;$p<=3;$p++)
                  {
                           $notavar="notaQ".$q."P".$p;
                           
                           ${"$notavar"}=$this->$notavar;
                          $sumq+=Letra::letranumero(${"$notavar"});
                   }
                   
                   return Letra::retornaletra(Letra::retornaentero($sumq/3));
         
         

    }
    
    
    public function getClubNotaAnual()
    {
            $q1=Letra::letranumero($this->getClubNotaQuimestral(1));
            $q2=Letra::letranumero($this->getClubNotaQuimestral(2));
            return Letra::retornaletra(Letra::retornaentero(($q1+$q2)/2));
        
    }
    
    public function getSiglasCualidad($letra)
    {
        return Equivalencia::siglas_cualidad_letra($letra);
    }
    public function getInterpretacionSiglas($siglas)
    {
        return Equivalencia::retornainterpretacion($siglas);
    }        
}