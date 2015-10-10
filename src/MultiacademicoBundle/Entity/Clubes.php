<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clubes
 *
 * @ORM\Table(name="clubes", uniqueConstraints={@ORM\UniqueConstraint(name="club", columns={"club"})}, indexes={@ORM\Index(name="clubcoddocente", columns={"clubcoddocente"})})
 * @ORM\Entity
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


}

