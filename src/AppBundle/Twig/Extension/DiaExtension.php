<?php

namespace AppBundle\Twig\Extension;

class DiaExtension extends \Twig_Extension
{
    /**
     * Get Base64 value
     *
     * @param string $value Link value
     * @return string
     */
    public function diaFilter($value)
    {
        switch ($value){
                        case 'Mon':  $dia="Lunes";      break;
                        case 'Tue':  $dia="Martes";     break;
                        case 'Wed':  $dia="Miércoles";  break;
                        case 'Thu':  $dia="Jueves";     break;
                        case 'Fri':  $dia="Viernes";    break;
                        case 'Sat':  $dia="Sábado";     break;
                        case 'Sun':  $dia="Domingo";    break;
                                 }
            return ($dia);
    }
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('dia', array($this, 'diaFilter')),
        );
    }
     /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Arxis dia Filter Extension';
    }
}
