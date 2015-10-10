<?php

/*
 * Multiservices (c) 2015 - Todos los derechos reservados.
 */

/**
 * Description of Grupo
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
namespace Multiservices\ArxisBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="grupos")
 */
class Grupo extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
}