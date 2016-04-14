<?php

namespace AppBundle\Twig\Extension;

class MesExtension extends \Twig_Extension
{
    /**
     * Get Base64 value
     *
     * @param string $value Link value
     * @return string
     */
    public function mesFilter($value)
    {
        switch ($value){
                        case '01':  $mes="Enero";      break;
                        case '02':  $mes="Febrero";    break;
                        case '03':  $mes="Marzo";      break;
                        case '04':  $mes="Abril";      break;
                        case '05':  $mes="Mayo";       break;
                        case '06':  $mes="Junio";      break;
                        case '07':  $mes="Julio";      break;
                        case '08':  $mes="Agosto";     break;
                        case '09':  $mes="Septiembre"; break;
                        case '10':  $mes="Octubre";    break;
                        case '11':  $mes="Noviembre";  break;
                        case '12':  $mes="Diciembre";  break;
                                 }
        return ($mes);
    }
    public function getFilters()
    {
        return array(
            //new \Twig_SimpleFilter('mes', array($this, 'mesFilter')),
            new \Twig_SimpleFilter('mes', array($this, 'mesFilter')),
        );
    }
     /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Arxis mes Filter Extension';
    }
}
