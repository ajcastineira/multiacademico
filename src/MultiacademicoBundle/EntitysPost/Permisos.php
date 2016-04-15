<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permisos
 *
 * @ORM\Table(name="permisos")
 * @ORM\Entity
 */
class Permisos
{
    /**
     * @var string
     *
     * @ORM\Column(name="codpermiso", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codpermiso;

    /**
     * @var string
     *
     * @ORM\Column(name="permisocodigo", type="string", length=2, nullable=false)
     */
    private $permisocodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="permiso", type="string", length=50, nullable=false)
     */
    private $permiso;

    /**
     * @var string
     *
     * @ORM\Column(name="permisoestado", type="string", length=8, nullable=false)
     */
    private $permisoestado;


}

