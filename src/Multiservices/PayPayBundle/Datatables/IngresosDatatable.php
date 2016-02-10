<?php

namespace Multiservices\PayPayBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;
use Multiservices\PayPayBundle\Form\Type\ClientesType;
use Multiservices\PayPayBundle\Form\Type\FormasPagosType;
use Multiservices\PayPayBundle\Form\Type\UsuariosType;

/**
 * Class IngresosDatatable
 *
 * @package Multiservices\PayPayBundle\Datatables
 */
class IngresosDatatable extends AbstractDatatableView
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
            'url' => $this->router->generate('ingresos_results'),
            'type' => 'GET'
        ));
            
        $this->options->setOptions(array(
            'display_start' => 0,
            'defer_loading' => -1,
            'dom' => 'lfrtip',
            'sdom'=>'<"H"<"dt-toolbar"<"col-xs-12 col-sm-5"f><"col-sm-4 col-xs-6 hidden-xs"><"col-xs-6 col-sm-3"l>r>>t<"F"<"dt-toolbar-footer"<"col-xs-12 col-sm-6"i><"col-xs-12 col-sm-6"p>>>',
            'length_menu' => array(10, 25, 50, 100),
            'order_classes' => true,
            'order' => [[2, 'desc']],
            'order_multi' => true,
            'page_length' => 10,
            'paging_type' => Style::FULL_NUMBERS_PAGINATION,
            'renderer' => '',
            'scroll_collapse' => false,
            'search_delay' => 0,
            'state_duration' => 7200,
            'stripe_classes' => array(),
            'responsive' => true,
            'class' => Style::BASE_STYLE.' projects-table '.Style::BOOTSTRAP_3_STYLE.' table-striped table-bordered table-hover',
            'individual_filtering' => false,
            'individual_filtering_position' => 'head',
            'use_integration_options' => true,
            'detail_child_rows' => true
        ));

        $this->columnBuilder
                ->add(null, 'detailscontrol', array(
                        'title' => '',
                    ))
                ->add('id', 'rowdetail', array('title' => 'Codigo',
                                            'visible'=>false))
                ->add('fecha', 'datetime', array('title' => 'Fecha',))
                ->add('cliente.nombre', 'column', array('title' => 'Cliente',))
                ->add('cliente.apellido', 'rowdetail', array('title' => 'Cliente','visible'=>false))
                ->add('monto', 'column', array('title' => 'Monto',))
                ->add('descripcion', 'column', array('title' => 'Descripción',))
                ->add('formaPago.formaPago', 'rowdetail', array('title' => 'Forma de Pago',))
                ->add('referencia', 'rowdetail', array('title' => 'Referencia',))
                ->add('collectedby.name', 'rowdetail', array('title' => 'Cobrado por',))
                
               
               
                ->add(null, 'action', array(
                'title' => 'Acciones',
                'start_html' => '<div class="wrapper">',
                'end_html' => '</div>',
                'actions' => array(
                    array(
                        'route' => 'ingresos_show',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Mostrar',
                       // 'toajax'=>true,
                        'icon' => 'glyphicon glyphicon-eye-open',
                        'attributes' => array(
                            'rel' => 'tooltip',
                            'title' => 'Mostrar',
                            'class' => 'btn btn-default btn-xs',
                            'role' => 'button'
                        ),
                        'role' => 'ROLE_USER',
                        //'render_if' => array('visible')
                    ),
                    array(
                        'route' => 'ingresos_edit',
                        'route_parameters' => array(
                            'id' => 'id'
                        ),
                        'label' => 'Editar',
                        //'toajax'=>true,
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
            ));
                
    }
    /**
     * {@inheritdoc}
     */
    public function getLineFormatter()
    {
        $formatter = function($line){
        	$line["cliente"]["nombre"]=$line["cliente"]["apellido"]." ".$line["cliente"]["nombre"];        	
            
            return $line;
        };

        return $formatter;
     
    }
    /**
     * {@inheritdoc}
     */
    public function getEntity()
    {
        return 'Multiservices\PayPayBundle\Entity\Ingresos';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ingresos_datatable';
    }
}
