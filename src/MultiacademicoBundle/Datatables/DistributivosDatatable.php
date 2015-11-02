<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class DistributivosDatatable
 *
 * @package MultiacademicoBundle\Datatables
 */
class DistributivosDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable()
    {
        $this->features->setFeatures(array(
            'auto_width' => true,
            'defer_render' => false,
            'info' => true,
            'jquery_ui' => false,
            'length_change' => true,
            'ordering' => true,
            'paging' => true,
            'processing' => true,
            'scroll_x' => false,
            'scroll_y' => '',
            'searching' => true,
            'server_side' => true,
            'state_save' => false,
            'delay' => 0
        ));
             $this->setUseSDom(true);
                    $this->ajax->setOptions(array(
            'url' => $this->router->generate('distributivos_results'),
            'type' => 'GET'
        ));
            
        $this->options->setOptions(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'sdom'=>'<"H"<"dt-toolbar"<"col-xs-12 col-sm-5"f><"col-sm-4 col-xs-6 hidden-xs"><"col-xs-6 col-sm-3"l>r>>t<"F"<"dt-toolbar-footer"<"col-xs-12 col-sm-6"i><"col-xs-12 col-sm-6"p>>>',
            //'dom' => 'lfrtip',
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => [[0, 'asc']],
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'responsive' => true,
            'class' => Style::BOOTSTRAP_3_STYLE.' table-bordered table-hover',
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true
        ));

        $this->columnBuilder
                ->add('id', 'column', array('title' => 'Cod','width'=>'2em'))
                ->add('distributivocodmateria.materia', 'column', array('title' => 'Materia','width'=>'12em'))
                ->add('distributivocoddocente.docente', 'column', array('title' => 'Docente','width'=>'15em'))
                ->add('distributivocodcurso.curso', 'column', array('title' => 'Curso','width'=>'5em'))
                ->add('distributivocodespecializacion.especializacion', 'column', array('title' => 'Especializacion','width'=>'7em'))
                ->add('distributivoparalelo', 'column', array('title' => 'Paralelo','width'=>'2em'))
                ->add('distributivoseccion', 'column', array('title' => 'Seccion','width'=>'4em'))
                
                //->add('distributivohora', 'column', array('title' => 'Distributivohora',))
               // ->add('distributivofecha', 'column', array('title' => 'Distributivofecha',))
               // ->add('distributivoestado', 'column', array('title' => 'Distributivoestado',))
              //  ->add('distributivogrado', 'column', array('title' => 'Distributivogrado',))
                
                
                //->add('distributivocodperiodo.periodoestado', 'column', array('title' => 'Distributivocodperiodo Periodoestado',))
                
                //->add('distributivocoddocente.docentetrato', 'column', array('title' => 'Distributivocoddocente Docentetrato',))
                
               // ->add('distributivocodmateria.id', 'column', array('title' => 'Distributivocodmateria Id',))
                
               // ->add('distributivocodmateria.materiatipo', 'column', array('title' => 'Distributivocodmateria Materiatipo',))
              //  ->add('distributivocodmateria.materiaestado', 'column', array('title' => 'Distributivocodmateria Materiaestado',))
              //  ->add('distributivocodmateria.prioridad', 'column', array('title' => 'Distributivocodmateria Prioridad',))
              //  ->add('distributivocodcurso.id', 'column', array('title' => 'Distributivocodcurso Id',))
              //  ->add('distributivocodcurso.cursoabreviatura', 'column', array('title' => 'Distributivocodcurso Cursoabreviatura',))
                
              //  ->add('distributivocodcurso.cursoestado', 'column', array('title' => 'Distributivocodcurso Cursoestado',))
              //  ->add('distributivocodespecializacion.id', 'column', array('title' => 'Distributivocodespecializacion Id',))
                
               // ->add('distributivocodespecializacion.especializacionestado', 'column', array('title' => 'Distributivocodespecializacion Especializacionestado',))
                //->add('aula.paralelo', 'column', array('title' => 'Aula Paralelo',))
                //->add('aula.seccion', 'column', array('title' => 'Aula Seccion',))
               // ->add('aula.estado', 'column', array('title' => 'Aula Estado',))
                ->add('distributivocodperiodo.periodo', 'column', array('title' => 'Periodo','width'=>'5em'))
                ->add(null, 'action', array(
                'title' => 'Acciones',
                'start_html' => '<div class="wrapper">',
                'end_html' => '</div>',
                'actions' => array(
                    array(
                        'route' => 'distributivos_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Mostrar',
                       // 'toajax'=>true,
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Mostrar',
                            'class' => 'btn btn-warning btn-xs',
                            'role' => 'button'
                        ),
                        'role' => 'ROLE_USER',
                        //'render_if' => array('visible')
                    ),
                    array(
                        'route' => 'distributivos_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Editar',
                       // 'toajax'=>true,
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Editar',
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                        //'confirm' => true,
                        //'confirm_message' => 'Esta Seguro?',
                        'role' => 'ROLE_ADMIN',
                    )
                )
            ))
                ;
    }

    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'MultiacademicoBundle\Entity\Distributivos';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'distributivos_datatable';
    }
}
