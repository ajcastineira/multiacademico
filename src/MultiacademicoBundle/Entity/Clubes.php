<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Clubes
 *
 * @ORM\Table(name="clubes", uniqueConstraints={@ORM\UniqueConstraint(name="club", columns={"club"})}, indexes={@ORM\Index(name="clubcoddocente", columns={"clubcoddocente"})})
 * @ORM\Entity(repositoryClass="MultiacademicoBundle\Entity\ClubesRepository")
 */
class Clubes
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
     * @ORM\Column(name="club", type="string", length=255, nullable=false)
     */
    private $club;

    /**
     * @var string
     *
     * @ORM\Column(name="clubabreviatura", type="string", length=100, nullable=true)
     */
    private $clubabreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="clubestado", type="string", length=1, nullable=true)
     */
    private $clubestado;

    /**
     * @var string
     *
     * @ORM\Column(name="campoaccion", type="string", length=30, nullable=true)
     */
    private $campoaccion;

    /**
     * @var \Docentes
     *
     * @ORM\ManyToOne(targetEntity="Docentes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clubcoddocente", referencedColumnName="id", nullable=false)
     * })
     */
    private $clubcoddocente;
    /**
     *
     * @var \Doctrine\Common\Collections\ArrayCollection;
     * @ORM\OneToMany(targetEntity="ClubesDetalle",mappedBy="codclub", cascade={"persist"})
     * ORM\OrderBy({"clubescodestudiante" = "ASC"})
     */
    private $registrados;
    
    public function __construct() {
        $this->registrados=new \Doctrine\Common\Collections\ArrayCollection;
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
     * Set club
     *
     * @param string $club
     *
     * @return Clubes
     */
    public function setClub($club)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return string
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set clubabreviatura
     *
     * @param string $clubabreviatura
     *
     * @return Clubes
     */
    public function setClubabreviatura($clubabreviatura)
    {
        $this->clubabreviatura = $clubabreviatura;

        return $this;
    }

    /**
     * Get clubabreviatura
     *
     * @return string
     */
    public function getClubabreviatura()
    {
        return $this->clubabreviatura;
    }

    /**
     * Set clubestado
     *
     * @param string $clubestado
     *
     * @return Clubes
     */
    public function setClubestado($clubestado)
    {
        $this->clubestado = $clubestado;

        return $this;
    }

    /**
     * Get clubestado
     *
     * @return string
     */
    public function getClubestado()
    {
        return $this->clubestado;
    }

    /**
     * Set campoaccion
     *
     * @param string $campoaccion
     *
     * @return Clubes
     */
    public function setCampoaccion($campoaccion)
    {
        $this->campoaccion = $campoaccion;

        return $this;
    }

    /**
     * Get campoaccion
     *
     * @return string
     */
    public function getCampoaccion()
    {
        return $this->campoaccion;
    }

    /**
     * Set clubcoddocente
     *
     * @param \MultiacademicoBundle\Entity\Docentes $clubcoddocente
     *
     * @return Clubes
     */
    public function setClubcoddocente(\MultiacademicoBundle\Entity\Docentes $clubcoddocente)
    {
        $this->clubcoddocente = $clubcoddocente;

        return $this;
    }

    /**
     * Get clubcoddocente
     *
     * @return \MultiacademicoBundle\Entity\Docentes
     */
    public function getClubcoddocente()
    {
        return $this->clubcoddocente;
    }
    public function __toString() {
        return $this->club;
    }

    /**
     * Add registrado
     *
     * @param \MultiacademicoBundle\Entity\ClubesDetalle $registrado
     *
     * @return Clubes
     */
    public function addRegistrado(\MultiacademicoBundle\Entity\ClubesDetalle $registrado)
    {
        $registrado->setCodclub($this);
        if (!$this->registrados->contains($registrado)) {
            $this->registrados->add($registrado);
        }
        
        
        return $this;
    }

    /**
     * Remove registrado
     *
     * @param \MultiacademicoBundle\Entity\ClubesDetalle $registrado
     */
    public function removeRegistrado(\MultiacademicoBundle\Entity\ClubesDetalle $registrado)
    {
        $this->registrados->removeElement($registrado);
    }

    /**
     * Get registrados
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegistrados()
    {
        $iterator = $this->registrados->getIterator();
        $iterator->uasort(function ($a, $b) {
            return ($a->getClubescodestudiante()->getEstudiante() < $b->getClubescodestudiante()->getEstudiante()) ? -1 : 1;
        });
        $this->registrados = new ArrayCollection(iterator_to_array($iterator));
        
        return $this->registrados;
    }
}
