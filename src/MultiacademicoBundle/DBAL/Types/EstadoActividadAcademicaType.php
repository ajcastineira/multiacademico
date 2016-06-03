<?php
namespace MultiacademicoBundle\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Description of EstadoEquipoType
 *
 * @author Rene Arias <renearias@multiservices.com.ec>
 */
class EstadoActividadAcademicaType  extends AbstractEnumType
{
    const INDEFINIDO   = null;
    const ENVIADA ='enviada';
    const PENDIENTE ='pendiente';
    const ENTREGADA   = 'entregada';
    const REVISADA = 'revisada';
    const COMPLETADA = 'completada';

    
    

    protected static $choices = [
        
        self::INDEFINIDO=>'INDEFINIDO',
        self::ENVIADA  => 'Enviada',
        self::PENDIENTE => 'Pendiente',
        self::ENTREGADA => 'Entregada',
        self::REVISADA => 'Revisada',
        self::COMPLETADA => 'Completada',
        
    ];
    protected static $htmlchoices = [
        self::INDEFINIDO     => '<span class="label label-default">INDEFINIDO</span>',
        self::ENVIADA     => '<span class="label label-warning">Enviada</span>',
        self::PENDIENTE => '<span class="label label-warning">Pendiente</span>',
        self::ENTREGADA => '<span class="label label-info">Entregada</span>',
        self::REVISADA => '<span class="label label-success">Revisada</span>',
        self::COMPLETADA => '<span class="label label-success">Anulada</span>',
    ];
     /**
     * Get readable choices for the ENUM field
     * @static
     * @return array Values for the ENUM field
     */
    public static function getHtmlChoices()
    {
        return static::$htmlchoices;
    }
    /**
     * Get value in readable format
     * @param string $value ENUM value
     * @static
     * @return string|null $value Value in readable format
     * @throws \InvalidArgumentException
     */
    public static function getReadableHtmlValue($value)
    {
        if (!isset(static::getHtmlChoices()[$value])) {
            $message = sprintf('Invalid value "%s" for ENUM type "%s"', $value, get_called_class());

            throw new \InvalidArgumentException($message);
        }

        return static::getHtmlChoices()[$value];
    }
    
}