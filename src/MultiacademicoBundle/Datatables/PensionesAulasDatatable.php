<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;
use Multiservices\PayPayBundle\DBAL\Types\EstadoFacturaType;
use MultiacademicoBundle\Datatables\Columns\RepresentanteColumn;
/**
 * Class PensionDatatable
 *
 * @package MultiacademicoBundle\Datatables
*/
class PensionesAulasDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
        $exporOptions=[
                       //'columns'=> [0,1,2,3,4,5,6,7,8,9]
            
                       ];
       /* $this->callbacks->set(array(
            'footer_callback' => "MultiacademicoBundle:Pension:footercallback.js.twig"
        ));*/

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
            'delay' => 500,
            'extensions' => array(
                'buttons' =>
                    array(
                        ['extend'=> 'colvis',
                         'text'=> 'Seleccionar Columnas',
                          'className'=>'btn-primary'
                         ],
                        ['extend'=> 'copy',
                         'text'=> 'Copiar',
                          'className'=>'btn-primary',
                          'exportOptions'=>$exporOptions],
                        ['extend'=> 'excel',
                         'text'=> 'Excel',
                         'className'=>'btn-success',
                         'exportOptions'=>$exporOptions,
                         'footer'=>true ],
                        ['extend'=> 'pdf',
                         'text'=> 'PDF',
                         'className'=>'btn-danger',
                         'exportOptions'=>$exporOptions,
                         'footer'=>true ],
                        ['extend'=> 'print',
                         'text'=> 'Imprimir',
                         'className'=>'btn-primary',
                         'exportOptions'=>$exporOptions,
                            'footer'=>true],
                        [
                            'text' => 'Recargar',
                            'className'=>'btn btn-primary',
                            'action' => '::reload.js.twig'
                        ]
                   ),
                'responsive' => true
            )
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('results_pension_aulas'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => "<'row'<'col-sm-4 col-xs-12'f><'col-sm-4 col-xs-12'B><'col-sm-4 col-xs-12'l>>" .
                    "<'row'<'col-sm-12'rt>>" .
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'length_menu' => array(10, 25, 50, 100,-1),
            'order_classes' => true,
            'order' => array(array(0, 'asc')),
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 500,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'class' => Style::BOOTSTRAP_3_STYLE,
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('factura.id', 'column', array(
                'title' => 'Cod Factura',
                'width'=>'4em'
            ))    
            ->add('info', 'column', array(
                'title' => 'Info',
                'width'=>'5em'
            ))
           /* ->add('estudiante.id', 'column', array(
                'title' => 'Estudiante Id',
            ))*/
           /* ->add('estudiante.estudianteCedula', 'column', array(
                'title' => 'Estudiante EstudianteCedula',
            ))*/
            ->add('estudiante.matriculas.aula.id', 'array', array(
                'title' => 'Aula Codigo',
                'data' => 'estudiante.matriculas[,].aula.id',
                 'visible'=>false
            ))    
            ->add('estudiante.estudiante', 'column', array(
                'title' => 'Estudiante ',
                 'width'=>'7em',
            ))
                
             ->add('estudiante.matriculas.aula.alias', 'array', array(
                'title' => 'Alias ',
                'data' => 'estudiante.matriculas[,].aula.alias',
                 'width'=>'7em'
            ))
            ->add('estudiante.matriculas.aula.curso', 'array', array(
                'title' => 'Curso',
                'data' => 'estudiante.matriculas[,].aula.curso.curso',
                 'width'=>'7em'
            ))
            ->add('estudiante.matriculas.aula.paralelo', 'array', array(
                'title' => 'Paralelo',
                'data' => 'estudiante.matriculas[,].aula.paralelo',
                 'width'=>'7em'
            ))
            ->add('estudiante.matriculas.aula.seccion', 'array', array(
                'title' => 'Seccion',
                'data' => 'estudiante.matriculas[,].aula.seccion',
                 'width'=>'7em'
            ))        
            ->add('factura.estado', 'column', array(
                'title' => 'Estado',
                 'width'=>'5em'
            ))
            ->add('factura.vencimiento', 'datetime', array(
                'title' => 'Vencimiento',
                'date_format' => 'DD-MMM-YYYY H:mm:s',
                 'width'=>'5em',
            ))
            ->add('factura.pago', 'datetime', array(
                'title' => 'Factura Pago',
                'date_format' => 'DD-MMM-YYYY H:mm:s',
                 'width'=>'5em'
            ))
            ->add('factura.cobrado', 'column', array(
                'title' => 'Cobrado',
                'width'=>'4em',
            ))
            ->add('factura.total', 'column', array(
                'title' => 'Total',
                 'width'=>'4em'
            ))
            ->add('estudiante.id', 'column', array(
                'visible'=>false,
            ))     
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'pension',
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
                        'route' => 'pension_edit',
                        'route_parameters' => array(
                            'page' => 'id'
                        ),
                        'label' => $this->translator->trans('datatables.actions.edit'),
                        'icon' => 'glyphicon glyphicon-edit',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => $this->translator->trans('datatables.actions.edit'),
                            'class' => 'btn btn-warning btn-xs',
                            'role' => 'button'
                        ),
                    ),
                    array(
                        'route' => 'pension_pay',
                        'route_parameters' => array(
                            'page' => 'id'
                        ),
                        'label' => 'Pagar',
                        'icon' => 'fa fa-money',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Pagar Pension',
                            'class' => 'btn btn-danger btn-xs',
                            'role' => 'button',
                       //     'onclick'=>'event.preventDefault();',
                        ),
                        'confirm'=>true,
                        'confirm_message'=>'¿Esta seguro de realizar esta acción?'
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
            if (isset($line["factura"]))
            {
            $line["factura"]["estado"] = EstadoFacturaType::getReadableHtmlValue($line["factura"]["estado"]);
            }
            $estudianteroute = $router->generate('estudiantes_show', array('id' => $line["estudiante"]["id"]));
            $line["estudiante"]["estudiante"] = '<a href="'.$estudianteroute.'">'.$line["estudiante"]["estudiante"].'</a>';
            return $line;
        };

        return $formatter;
     
    }
    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'MultiacademicoBundle\Entity\Pension';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pension_datatable';
    }
}
