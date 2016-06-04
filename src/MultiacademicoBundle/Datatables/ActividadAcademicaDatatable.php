<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

use MultiacademicoBundle\Datatables\Columns\RepresentanteColumn;
use MultiacademicoBundle\DBAL\Types\EstadoActividadAcademicaType;

/**
 * Class ActividadAcademicaDatatable
 *
 * @package MultiacademicoBundle\Datatables
 */
class ActividadAcademicaDatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('actividadacademica',['page'=>'new']),
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
            'extensions' => array(
                'responsive' => true
            )
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('actividadacademica_results'),
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
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => false,
            'individual_filtering_position' => 'foot',
            'use_integration_options' => false,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('id', 'column', array(
                'title' => 'Id',
                'width' => '10px'
            ))
            ->add('titulo', 'column', array(
                'title' => 'Titulo',
                'width' => '20em'
            ))
            ->add('tipo', 'column', array(
                'title' => 'Tipo',
                'width' => '10em'
            ))
            ->add('estado', 'column', array(
                'title' => 'Estado',
                'width' => '10em'
            ))    
            ->add('fechaEnvio', 'datetime', array(
                'title' => 'FechaEnvio',
            ))
            ->add('fechaEntrega', 'datetime', array(
                'title' => 'FechaEntrega',
            ))    
            ->add('distributivo.aula.curso.curso', 'column', array(
                'title' => 'Curso',
            ))
            ->add('distributivo.aula.especializacion', 'array', array(
                'title' => 'Especializacion',
                'data'=>'distributivo.aula.especializacion.especializacion',
            ))
            ->add('distributivo.aula.paralelo', 'column', array(
                'title' => 'Paralelo',
            ))
            ->add('distributivo.aula.seccion', 'column', array(
                'title' => 'Seccion',
            ))        
            ->add('distributivo.aula.alias', 'column', array(
                'title' => 'Alias',
            ))
            
            ->add('distributivo.distributivocodmateria', 'array', array(
                'title' => 'Materia',
                'data'=>'distributivo.distributivocodmateria.materia',
            ))
             ->add('sendBy.id', 'column', array(
                'title' => '',
                'visible' => false
            ))    
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'actividadacademica',
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
                        'route' => 'actividadacademica_edit',
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
    public function getLineFormatter()
    {
        $router = $this->router;
        
        $formatter = function($line) use ($router){
            //var_dump($line);
            //var_dump($line["factura"]);
            if (isset($line["estado"]))
            {
            $line["estado"] = EstadoActividadAcademicaType::getReadableHtmlValue($line["estado"]);
            //$representanteroute = $router->generate('representantes', array('page' => $line["factura"]["idcliente"]["id"]));
            //$line["factura"]["idcliente"]["representante"] = '<a href="'.$representanteroute.'">'.$line["factura"]["idcliente"]["representante"].'</a>';
            }
            //$estudianteroute = $router->generate('estudiantes_show', array('id' => $line["estudiante"]["id"]));
            //$line["estudiante"]["estudiante"] = '<a href="'.$estudianteroute.'">'.$line["estudiante"]["estudiante"].'</a>';
            return $line;
        };

        return $formatter;
     
    }
    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'MultiacademicoBundle\Entity\ActividadAcademica';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'actividadacademica_datatable';
    }
}
