<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class ActividadAcademicaDetalleDatatable
 *
 * @package MultiacademicoBundle\Datatables
 */
class ActividadAcademicaDetalleDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('actividadacademicadetalle',['page'=>'new']),
                    'label' => $this->translator->trans('datatables.actions.new'),
                    'icon' => 'glyphicon glyphicon-plus',
                    'attributes' => array(
                        'rel' => 'tooltip',
                        'title' => $this->translator->trans('datatables.actions.new'),
                        'class' => 'btn btn-primary',
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
            'extensions' => array()
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('actividadacademicadetalle_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            //'dom' => 'lfrtip',
            'dom' => "<'row'<'col-sm-4 col-xs-12'f><'col-sm-4 col-xs-12'><'col-sm-4 col-xs-12'l>>" .
                    "<'row'<'col-sm-12'rt>>" .
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BASE_STYLE,
            'individual_filtering' => false,
            'individual_filtering_position' => 'foot',
            'use_integration_options' => false,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
            ))
            ->add('calificacion', 'column', array(
                'title' => 'Calificacion',
            ))
            ->add('entregada', 'boolean', array(
                'title' => 'Entregada',
            ))
            ->add('fechaEntregada', 'datetime', array(
                'title' => 'FechaEntregada',
            ))
            ->add('revisada', 'boolean', array(
                'title' => 'Revisada',
            ))
            ->add('fechaRevisada', 'datetime', array(
                'title' => 'FechaRevisada',
            ))
            ->add('estado', 'boolean', array(
                'title' => 'Estado',
            ))
            ->add('matricula.id', 'column', array(
                'title' => 'Matricula Id',
            ))
            ->add('matricula.matriculaseccion', 'column', array(
                'title' => 'Matricula Matriculaseccion',
            ))
            ->add('matricula.matriculaparalelo', 'column', array(
                'title' => 'Matricula Matriculaparalelo',
            ))
            ->add('matricula.matriculafecha', 'column', array(
                'title' => 'Matricula Matriculafecha',
            ))
            ->add('matricula.matriculaclave', 'column', array(
                'title' => 'Matricula Matriculaclave',
            ))
            ->add('matricula.matriculatipo', 'column', array(
                'title' => 'Matricula Matriculatipo',
            ))
            ->add('matricula.matriculaobservacion', 'column', array(
                'title' => 'Matricula Matriculaobservacion',
            ))
            ->add('matricula.valorMatricula', 'column', array(
                'title' => 'Matricula ValorMatricula',
            ))
            ->add('matricula.valorPension', 'column', array(
                'title' => 'Matricula ValorPension',
            ))
            ->add('matricula.matriculaestado', 'column', array(
                'title' => 'Matricula Matriculaestado',
            ))
            ->add('matricula.matriculaQ1Laborada', 'column', array(
                'title' => 'Matricula MatriculaQ1Laborada',
            ))
            ->add('matricula.matriculaQ1Jutificada', 'column', array(
                'title' => 'Matricula MatriculaQ1Jutificada',
            ))
            ->add('matricula.matriculaQ1Injustificada', 'column', array(
                'title' => 'Matricula MatriculaQ1Injustificada',
            ))
            ->add('matricula.matriculaQ2Laborada', 'column', array(
                'title' => 'Matricula MatriculaQ2Laborada',
            ))
            ->add('matricula.matriculaQ2Jutificada', 'column', array(
                'title' => 'Matricula MatriculaQ2Jutificada',
            ))
            ->add('matricula.matriculaQ2Injustificada', 'column', array(
                'title' => 'Matricula MatriculaQ2Injustificada',
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'actividadacademicadetalle',
                        'route_parameters' => array(
                            'page' => 'id'
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
                        'route' => 'actividadacademicadetalle_edit',
                        'route_parameters' => array(
                            'page' => 'id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                            'class' => 'btn btn-primary btn-xs',
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
        return 'MultiacademicoBundle\Entity\ActividadAcademicaDetalle';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'actividadacademicadetalle_datatable';
    }
}
