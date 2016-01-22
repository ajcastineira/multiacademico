<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class EstudiantesDatatable
 *
 * @package MultiacademicoBundle\Datatables
 */
class EstudiantesDatatable extends AbstractDatatableView
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
            //$this->setUseSDom(true);
                    $this->ajax->setOptions(array(
            'url' => $this->router->generate('estudiantes_results'),
            'type' => 'POST'
        ));
            
        $this->options->setOptions(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom'=>'<"H"<"dt-toolbar"<"col-xs-12 col-sm-5"f><"col-sm-4 col-xs-6 hidden-xs"><"col-xs-6 col-sm-3"l>r>>t<"F"<"dt-toolbar-footer"<"col-xs-12 col-sm-6"i><"col-xs-12 col-sm-6"p>>>',
            //'sdom'=>'<"input-group rounded no-overflow"f>',
            
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
            //'class' => Style::BOOTSTRAP_3_STYLE,
            'class' => Style::BOOTSTRAP_3_STYLE.' table-bordered table-hover',
            'individual_filtering' => false,
            'individual_filtering_position' => 'foot',
            'use_integration_options' => true
        ));

        $this->columnBuilder
                ->add('id', 'column', array('title' => 'Id',))
            //    ->add('estudianteCedula', 'column', array('title' => 'EstudianteCedula',))
                ->add('estudiante', 'column', array('title' => 'Estudiante',))
            //    ->add('estudianteFechanacimiento', 'column', array('title' => 'EstudianteFechanacimiento',))
            //    ->add('estudianteNacionalidad', 'column', array('title' => 'EstudianteNacionalidad',))
            //    ->add('estudianteLugarnacimiento', 'column', array('title' => 'EstudianteLugarnacimiento',))
            //    ->add('estudianteProvinciaN', 'column', array('title' => 'EstudianteProvinciaN',))
            //    ->add('estudianteCantonN', 'column', array('title' => 'EstudianteCantonN',))
            //    ->add('estudianteParroquiaN', 'column', array('title' => 'EstudianteParroquiaN',))
            //    ->add('estudianteDomicilio', 'column', array('title' => 'EstudianteDomicilio',))
           //     ->add('estudianteProvinciaD', 'column', array('title' => 'EstudianteProvinciaD',))
           //     ->add('estudianteCantonD', 'column', array('title' => 'EstudianteCantonD',))
           //     ->add('estudianteParroquiaD', 'column', array('title' => 'EstudianteParroquiaD',))
            //    ->add('estudianteGenero', 'column', array('title' => 'EstudianteGenero',))
             //   ->add('estudianteDiscapacidad', 'column', array('title' => 'EstudianteDiscapacidad',))
             //   ->add('estudianteConae', 'column', array('title' => 'EstudianteConae',))
             //   ->add('estudianteEtnia', 'column', array('title' => 'EstudianteEtnia',))
             //   ->add('estudiantePlantel', 'column', array('title' => 'EstudiantePlantel',))
             //   ->add('estudianteCorreo', 'column', array('title' => 'EstudianteCorreo',))
             //   ->add('estudianteCarnet', 'column', array('title' => 'EstudianteCarnet',))
             //   ->add('estudianteFoto', 'column', array('title' => 'EstudianteFoto',))
            //    ->add('estudianteEstado', 'column', array('title' => 'EstudianteEstado',))
            //    ->add('estudianteNumeroacta', 'column', array('title' => 'EstudianteNumeroacta',))
            //    ->add('madre', 'column', array('title' => 'Madre',))
           //     ->add('madreCedula', 'column', array('title' => 'MadreCedula',))
            //    ->add('madreEstadocivil', 'column', array('title' => 'MadreEstadocivil',))
           //     ->add('madreTelefono', 'column', array('title' => 'MadreTelefono',))
           //     ->add('madreDomicilio', 'column', array('title' => 'MadreDomicilio',))
          //      ->add('madreBono', 'column', array('title' => 'MadreBono',))
            //    ->add('padre', 'column', array('title' => 'Padre',))
            //    ->add('padreCedula', 'column', array('title' => 'PadreCedula',))
             //   ->add('padreEstadocivil', 'column', array('title' => 'PadreEstadocivil',))
            //    ->add('padreTelefono', 'column', array('title' => 'PadreTelefono',))
             //   ->add('padreDomicilio', 'column', array('title' => 'PadreDomicilio',))
              //  ->add('representanteCedula', 'column', array('title' => 'RepresentanteCedula',))
             //   ->add('representante', 'column', array('title' => 'Representante',))
             //   ->add('representanteDomicilio', 'column', array('title' => 'RepresentanteDomicilio',))
             //   ->add('representanteTelefono', 'column', array('title' => 'RepresentanteTelefono',))
             //   ->add('representanteTipo', 'column', array('title' => 'RepresentanteTipo',))
            //    ->add('username', 'column', array('title' => 'Username',))
              // ->add('password', 'column', array('title' => 'Password',))
              //  ->add('salt', 'column', array('title' => 'Salt',))
              //  ->add('path', 'column', array('title' => 'Path',))
               // ->add('theme', 'column', array('title' => 'Theme',))
             //   ->add('signature', 'column', array('title' => 'Signature',))
              //  ->add('signatureFormat', 'column', array('title' => 'SignatureFormat',))
               // ->add('created', 'column', array('title' => 'Created',))
              //  ->add('access', 'column', array('title' => 'Access',))
              //  ->add('lastlogin', 'column', array('title' => 'Lastlogin',))
             //   ->add('lastactivity', 'column', array('title' => 'Lastactivity',))
              // ->add('status', 'boolean', array('title' => 'Status',))
               // ->add('timezone', 'column', array('title' => 'Timezone',))
               // ->add('language', 'column', array('title' => 'Language',))
               // ->add('picture', 'column', array('title' => 'Picture',))
               // ->add('init', 'column', array('title' => 'Init',))
              //  ->add('data', 'column', array('title' => 'Data',))
                ->add('mail', 'column', array('title' => 'Mail',))
                ->add(null, 'action', array(
                'title' => 'Acciones',
                'start_html' => '<div class="wrapper">',
                'end_html' => '</div>',
                'actions' => array(
                    array(
                        'route' => 'estudiantes_show',
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
                        'route' => 'estudiantes_edit',
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
        return 'MultiacademicoBundle\Entity\Estudiantes';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'estudiantes_datatable';
    }
}
