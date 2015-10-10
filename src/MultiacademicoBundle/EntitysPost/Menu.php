<?php

namespace MultiacademicoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity
 */
class Menu
{
    /**
     * @var string
     *
     * @ORM\Column(name="codmenu", type="string", length=2, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codmenu;

    /**
     * @var string
     *
     * @ORM\Column(name="menu", type="string", length=100, nullable=false)
     */
    private $menu;

    /**
     * @var string
     *
     * @ORM\Column(name="menuancho", type="string", length=3, nullable=false)
     */
    private $menuancho;

    /**
     * @var string
     *
     * @ORM\Column(name="menualto", type="string", length=4, nullable=false)
     */
    private $menualto;

    /**
     * @var string
     *
     * @ORM\Column(name="menuurl", type="string", length=50, nullable=false)
     */
    private $menuurl;

    /**
     * @var string
     *
     * @ORM\Column(name="menuestado", type="string", length=8, nullable=false)
     */
    private $menuestado;


}

