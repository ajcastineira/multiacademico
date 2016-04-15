<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Submenus
 *
 * @ORM\Table(name="submenus")
 * @ORM\Entity
 */
class Submenus
{
    /**
     * @var string
     *
     * @ORM\Column(name="codsubmenu", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codsubmenu;

    /**
     * @var string
     *
     * @ORM\Column(name="submenucodmenu", type="string", length=2, nullable=false)
     */
    private $submenucodmenu;

    /**
     * @var string
     *
     * @ORM\Column(name="submenu", type="string", length=100, nullable=false)
     */
    private $submenu;

    /**
     * @var string
     *
     * @ORM\Column(name="submenualto", type="string", length=4, nullable=false)
     */
    private $submenualto;

    /**
     * @var string
     *
     * @ORM\Column(name="submenuurl", type="string", length=50, nullable=false)
     */
    private $submenuurl;

    /**
     * @var string
     *
     * @ORM\Column(name="submenuestado", type="string", length=8, nullable=false)
     */
    private $submenuestado;


}

