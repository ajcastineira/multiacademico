<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;
use MultiacademicoBundle\Datatables\Columns\RepresentanteColumn;

/**
 * Class MatriculasDatatable
 *
 * @package MultiacademicoBundle\Datatables
*/
class MatriculasDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
       $exporOptions=[
                       //'columns'=> [0,1,2,3,4,5,6,7,8,9]
            
                       ];
        $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('matriculas',['page'=>'new']),
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
                'buttons' =>
                    array(
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
            'url' => $this->router->generate('matriculas_results'),
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
            'page_length' => 10,
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
                'title' => 'Num. Mat.',
                'width'=>'4em'
            ))
            ->add('matriculacodestudiante.estudiante', 'column', array(
                'title' => 'Matriculacodestudiante Estudiante',
            ))
            ->add('matriculacodcurso.curso', 'column', array(
                'title' => 'Curso',
            ))
            ->add('matriculacodespecializacion.especializacion', 'column', array(
                'title' => 'Especializacion',
            ))    
            ->add('matriculaseccion', 'column', array(
                'title' => 'Seccion',
            ))
            ->add('aula.paralelo', 'column', array(
                'title' => 'Paralelo',
                 'width'=>'4em'
            ))
            ->add('aula.alias', 'column', array(
                'title' => 'Alias',
                 'width'=>'4em'
            ))
            ->add('estaAlDia', 'virtual', array(
                'title' => '¿Esta al Dia?',
                 'width'=>'4em'
            ))    
           ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'matriculas',
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
                        'route' => 'matriculas_edit',
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
            ->add('matriculacodestudiante.representante', new RepresentanteColumn(), array(
                'title' => 'Representante',
                'data'=>'matriculacodestudiante.representante.representante',
                //'visible'=>false
                 //'width'=>'4em'
            ))
            ->add('matriculacodestudiante.representanteTelefono', 'column', array(
                'title' => 'Tlf Representante',
                //'visible'=>false
                 //'width'=>'4em'
            ))    
             ->add('matriculacodestudiante.estudianteCedula', 'column', array(
                'title' => 'Cedula',
                //'visible'=>false
                 //'width'=>'4em'
            ))     
             ->add('matriculacodestudiante.estudianteGenero', 'column', array(
                'title' => 'Genero',
                //'visible'=>false
                 //'width'=>'4em'
            ))
             ->add('matriculacodestudiante.estudianteDomicilio', 'column', array(
                'title' => 'Domicilio',
                //'visible'=>false
                 //'width'=>'4em'
            ))         
           /* ->add('matriculafecha', 'datetime', array(
                'title' => 'Fecha Mat.',
                'date_format' => 'Y-M-d',
            ))*/
            
            /*->add('matriculaestado', 'column', array(
                'title' => 'Matriculaestado',
            ))*/
          
           
            
          /*  ->add('matriculacodestudiante.representante', 'column', array(
                'title' => 'Matriculacodestudiante Representante',
            ))*/
           
            
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
           // var_dump($line["matriculacodestudiante"]["representante"]);
            if (isset($line["matriculacodestudiante"]))
            {
            
            $representanteroute = $router->generate('representantes', array('page' => $line["matriculacodestudiante"]["representante"]["id"]));
            $line["matriculacodestudiante"]["representante"]["representante"] = '<a href="'.$representanteroute.'">'.$line["matriculacodestudiante"]["representante"]["representante"].'</a>';
            $mat=$this->em->find('MultiacademicoBundle:Matriculas', $line["id"]);
            if ($mat->estaAlDia())
            {$line["estaAlDia"]='<span class="label label-success">SI</span>';}
            else
            {    
            $line["estaAlDia"]='<span class="label label-danger">NO</span>';
            }
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
        return 'MultiacademicoBundle\Entity\Matriculas';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'matriculas_datatable';
    }
}
