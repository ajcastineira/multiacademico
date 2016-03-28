<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class PensionDatatable
 *
 * @package MultiacademicoBundle\Datatables
*/
class PensionDatatable extends AbstractDatatableView
{
    /**
     * {@inheritdoc}
     */
    public function buildDatatable(array $options = array())
    {
       /* $this->topActions->set(array(
            'start_html' => '<div class="row"><div class="col-sm-3">',
            'end_html' => '<hr></div></div>',
            'actions' => array(
                array(
                    'route' => $this->router->generate('pension',['page'=>'new']),
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
            'delay' => 0,
            'extensions' => array()
        ));

        $this->ajax->set(array(
            'url' => $this->router->generate('pension_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
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
            'individual_filtering' => true,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'force_dom' => true
        ));

        $this->columnBuilder
            ->add('info', 'column', array(
                'title' => 'Info',
            ))
           /* ->add('estudiante.id', 'column', array(
                'title' => 'Estudiante Id',
            ))*/
           /* ->add('estudiante.estudianteCedula', 'column', array(
                'title' => 'Estudiante EstudianteCedula',
            ))*/
            ->add('estudiante.estudiante', 'column', array(
                'title' => 'Estudiante ',
            ))
        /*
            ->add('estudiante.madre', 'column', array(
                'title' => 'Estudiante Madre',
            ))
            ->add('estudiante.madreCedula', 'column', array(
                'title' => 'Estudiante MadreCedula',
            ))
            ->add('estudiante.madreEstadocivil', 'column', array(
                'title' => 'Estudiante MadreEstadocivil',
            ))
            ->add('estudiante.madreTelefono', 'column', array(
                'title' => 'Estudiante MadreTelefono',
            ))
            ->add('estudiante.madreDomicilio', 'column', array(
                'title' => 'Estudiante MadreDomicilio',
            ))
            ->add('estudiante.madreBono', 'column', array(
                'title' => 'Estudiante MadreBono',
            ))
            ->add('estudiante.padre', 'column', array(
                'title' => 'Estudiante Padre',
            ))
            ->add('estudiante.padreCedula', 'column', array(
                'title' => 'Estudiante PadreCedula',
            ))
            ->add('estudiante.padreEstadocivil', 'column', array(
                'title' => 'Estudiante PadreEstadocivil',
            ))
            ->add('estudiante.padreTelefono', 'column', array(
                'title' => 'Estudiante PadreTelefono',
            ))
            ->add('estudiante.padreDomicilio', 'column', array(
                'title' => 'Estudiante PadreDomicilio',
            ))
            ->add('estudiante.representanteCedula', 'column', array(
                'title' => 'Estudiante RepresentanteCedula',
            ))
            ->add('estudiante.representanteNombre', 'column', array(
                'title' => 'Estudiante RepresentanteNombre',
            ))
            ->add('estudiante.representanteDomicilio', 'column', array(
                'title' => 'Estudiante RepresentanteDomicilio',
            ))
            ->add('estudiante.representanteTelefono', 'column', array(
                'title' => 'Estudiante RepresentanteTelefono',
            ))
            ->add('estudiante.representanteTipo', 'column', array(
                'title' => 'Estudiante RepresentanteTipo',
            ))
            ->add('estudiante.path', 'column', array(
                'title' => 'Estudiante Path',
            ))
            ->add('estudiante.theme', 'column', array(
                'title' => 'Estudiante Theme',
            ))
            ->add('estudiante.signature', 'column', array(
                'title' => 'Estudiante Signature',
            ))
            ->add('estudiante.signatureFormat', 'column', array(
                'title' => 'Estudiante SignatureFormat',
            ))
            ->add('estudiante.created', 'column', array(
                'title' => 'Estudiante Created',
            ))
            ->add('estudiante.access', 'column', array(
                'title' => 'Estudiante Access',
            ))
            ->add('estudiante.lastlogin', 'column', array(
                'title' => 'Estudiante Lastlogin',
            ))
            ->add('estudiante.lastactivity', 'column', array(
                'title' => 'Estudiante Lastactivity',
            ))
            ->add('estudiante.status', 'column', array(
                'title' => 'Estudiante Status',
            ))
            ->add('estudiante.timezone', 'column', array(
                'title' => 'Estudiante Timezone',
            ))
            ->add('estudiante.language', 'column', array(
                'title' => 'Estudiante Language',
            ))
            ->add('estudiante.picture', 'column', array(
                'title' => 'Estudiante Picture',
            ))
            ->add('estudiante.init', 'column', array(
                'title' => 'Estudiante Init',
            ))
            ->add('estudiante.data', 'column', array(
                'title' => 'Estudiante Data',
            ))
            ->add('estudiante.mail', 'column', array(
                'title' => 'Estudiante Mail',
            ))*/
            ->add('factura.id', 'column', array(
                'title' => 'Cod Factura',
                'width'=>'5em'
            ))
            ->add('factura.idcliente.representante', 'column', array(
                'title' => 'Representante',
            ))
            ->add('factura.emitido', 'datetime', array(
                'title' => 'Factura Emitido',
                'date_format' => 'DD-MMM-YYYY H:mm:s'
            ))
            ->add('factura.vencimiento', 'datetime', array(
                'title' => 'Factura Vencimiento',
                'date_format' => 'DD-MMM-YYYY H:mm:s'
            ))
            ->add('factura.pago', 'datetime', array(
                'title' => 'Factura Pago',
                'date_format' => 'DD-MMM-YYYY H:mm:s'
            ))
            ->add('factura.total', 'column', array(
                'title' => 'Factura Total',
            ))
            /*->add('factura.forma', 'column', array(
                'title' => 'Factura Forma',
            ))*/
            ->add('factura.estado', 'column', array(
                'title' => 'Factura Estado',
            ))
            /*->add('factura.tipo', 'column', array(
                'title' => 'Factura Tipo',
            ))*/
            /*->add('factura.cobrado', 'column', array(
                'title' => 'Factura Cobrado',
            ))*/
            /*->add('factura.statevencido', 'column', array(
                'title' => 'Factura Statevencido',
            ))*/
            /*->add('factura.credito', 'column', array(
                'title' => 'Factura Credito',
            ))*/
            /*->add('factura.iva_igv', 'column', array(
                'title' => 'Factura Iva_igv',
            ))*/
            /*->add('factura.sub_total', 'column', array(
                'title' => 'Factura Sub_total',
            ))*/
           /* ->add(null, 'action', array(
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
                            'class' => 'btn btn-primary btn-xs',
                            'role' => 'button'
                        ),
                    )
                )
            ))*/
        ;
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
