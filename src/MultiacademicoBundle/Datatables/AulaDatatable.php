<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class DistributivosDatatable
 *
 * @package MultiacademicoBundle\Datatables
*/
class AulaDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-6">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('aulas',['page'=>'new']),
                    'label' => $this->translator->trans('datatables.actions.new'),
                    'icon' => 'glyphicon glyphicon-plus',
                    'attributes' => array(
                        'rel' => 'tooltip',
                        'title' => $this->translator->trans('datatables.actions.new'),
                        'class' => 'btn btn-primary',
                        'role' => 'button'
                    ),
                ),
                array(
                    'route' => $this->router->generate('estadisticas_matriculados'),
                    'label' => 'Ver Resumen',
                    'icon' => 'fa fa-print',
                    'attributes' => array(
                        'rel' => 'tooltip',
                        'title' => 'Resumen Estadistico',
                        'class' => 'btn btn-success',
                        'role' => 'button'
                    ),
                )
            )
        ));

        $this->features->set(array(
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
            'delay' => 0,
            'extensions' => array(
                'buttons' =>
                    array(
                        ['extend'=> 'copy',
                         'text'=> 'Copiar'],
                        'excel',
                        'pdf',
                        ['extend'=> 'print',
                         'text'=> 'Imprimir'],
                       
                   ),
                'responsive' => true
            )
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('aula_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => "<'row'<'col-sm-4 col-xs-12'f><'col-sm-4 col-xs-12'B><'col-sm-4 col-xs-12'l>>" .
                    "<'row'<'col-sm-12'rt>>" .
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 50,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
                'visible'=>false,
            ))    
            ->add('curso.curso', 'column', array(
                'title' => 'Curso',
                'width'=>'8em',
            ))
            ->add('especializacion.especializacion', 'column', array(
                'title' => 'Especializacion',
                'width'=>'10em',
            ))
            ->add('paralelo', 'column', array(
                'title' => 'Paralelo',
                'width'=>'5em',
            ))
            ->add('seccion', 'column', array(
                'title' => 'Seccion',
                'width'=>'8em',
            ))
            ->add('periodo.periodo', 'column', array(
                'title' => 'Periodo',
                'width'=>'5em',
            ))    
            ->add('alias', 'column', array(
                'title' => 'Alias',
                'width'=>'5em',
            ))
            ->add('tutor.docente', 'column', array(
                'title' => 'Tutor',
                'width'=>'15em',
            ))
            /*->add('distributivocodmateria.materia', 'column', array(
                'title' => 'Materia',
            ))
            ->add('distributivocodcurso.curso', 'column', array(
                'title' => 'Curso',
            ))            
            ->add('distributivocodespecializacion.especializacion', 'column', array(
                'title' => 'Especializacion',
            ))
            ->add('distributivoparalelo', 'column', array(
                'title' => 'Paralelo',
                'width' => '3em'
            ))
            ->add('distributivoseccion', 'column', array(
                'title' => 'Seccion',
            ))*/    
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'aulas_show',
                        'route_parameters' => array(
                            'curso' => 'curso.id',
                            'especializacion' => 'especializacion.id',
                            'paralelo' => 'paralelo',
                            'seccion' => 'seccion',
                            'periodo' => 'periodo.id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.show'),
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.show'),
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    ),
                   array(
                        'route' => 'aulas_edit',
                        'route_parameters' => array(
                            'curso' => 'curso.id',
                            'especializacion' => 'especializacion.id',
                            'paralelo' => 'paralelo',
                            'seccion' => 'seccion',
                            'periodo' => 'periodo.id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                            'class' => 'btn btn-warning btn-xs',
                            'role' => 'button'
                        ),
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
        return 'MultiacademicoBundle\Entity\Aula';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'aula_datatable';
    }
}
