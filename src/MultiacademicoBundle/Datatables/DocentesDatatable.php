<?php

namespace MultiacademicoBundle\Datatables;

use Sg\DatatablesBundle\Datatable\View\AbstractDatatableView;
use Sg\DatatablesBundle\Datatable\View\Style;

/**
 * Class DocentesDatatable
 *
 * @package MultiacademicoBundle\Datatables
*/
class DocentesDatatable extends AbstractDatatableView
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
                    'route' => $this->router->generate('docentes',['page'=>'new']),
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
            'url' => $this->router->generate('docentes_results'),
            'type' => 'GET'
        ));

        $this->options->set(array(
            'display_start' => 0,
            'defer_loading' => -1,
            //'dom' => 'lfrtip',
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
            ->add('docentecedula', 'column', array(
                'title' => 'Docentecedula',
            ))
            ->add('login', 'column', array(
                'title' => 'Login',
            ))
            ->add('password', 'column', array(
                'title' => 'Password',
            ))
            ->add('docentetrato', 'column', array(
                'title' => 'Docentetrato',
            ))
            ->add('docente', 'column', array(
                'title' => 'Docente',
            ))
            ->add('docentedomicilio', 'column', array(
                'title' => 'Docentedomicilio',
            ))
            ->add('docenteemail', 'column', array(
                'title' => 'Docenteemail',
            ))
            ->add('docentetelefono', 'column', array(
                'title' => 'Docentetelefono',
            ))
            ->add('docentecargo', 'column', array(
                'title' => 'Docentecargo',
            ))
            ->add('docenteestado', 'column', array(
                'title' => 'Docenteestado',
            ))
            ->add('username', 'column', array(
                'title' => 'Username',
            ))
            ->add('salt', 'column', array(
                'title' => 'Salt',
            ))
            ->add('path', 'column', array(
                'title' => 'Path',
            ))
            ->add('theme', 'column', array(
                'title' => 'Theme',
            ))
            ->add('signature', 'column', array(
                'title' => 'Signature',
            ))
            ->add('signatureFormat', 'column', array(
                'title' => 'SignatureFormat',
            ))
            ->add('created', 'column', array(
                'title' => 'Created',
            ))
            ->add('access', 'column', array(
                'title' => 'Access',
            ))
            ->add('lastlogin', 'column', array(
                'title' => 'Lastlogin',
            ))
            ->add('lastactivity', 'column', array(
                'title' => 'Lastactivity',
            ))
            ->add('status', 'boolean', array(
                'title' => 'Status',
            ))
            ->add('timezone', 'column', array(
                'title' => 'Timezone',
            ))
            ->add('language', 'column', array(
                'title' => 'Language',
            ))
            ->add('picture', 'column', array(
                'title' => 'Picture',
            ))
            ->add('init', 'column', array(
                'title' => 'Init',
            ))
            ->add('data', 'column', array(
                'title' => 'Data',
            ))
            ->add('mail', 'column', array(
                'title' => 'Mail',
            ))
            ->add('usuario.id', 'column', array(
                'title' => 'Usuario Id',
            ))
            ->add('usuario.name', 'column', array(
                'title' => 'Usuario Name',
            ))
            ->add('usuario.cargo', 'column', array(
                'title' => 'Usuario Cargo',
            ))
            ->add('usuario.trato', 'column', array(
                'title' => 'Usuario Trato',
            ))
            ->add('usuario.path', 'column', array(
                'title' => 'Usuario Path',
            ))
            ->add('usuario.telefono', 'column', array(
                'title' => 'Usuario Telefono',
            ))
            ->add('usuario.direccion', 'column', array(
                'title' => 'Usuario Direccion',
            ))
            ->add('usuario.theme', 'column', array(
                'title' => 'Usuario Theme',
            ))
            ->add('usuario.signature', 'column', array(
                'title' => 'Usuario Signature',
            ))
            ->add('usuario.signatureFormat', 'column', array(
                'title' => 'Usuario SignatureFormat',
            ))
            ->add('usuario.created', 'column', array(
                'title' => 'Usuario Created',
            ))
            ->add('usuario.access', 'column', array(
                'title' => 'Usuario Access',
            ))
            ->add('usuario.login', 'column', array(
                'title' => 'Usuario Login',
            ))
            ->add('usuario.status', 'column', array(
                'title' => 'Usuario Status',
            ))
            ->add('usuario.timezone', 'column', array(
                'title' => 'Usuario Timezone',
            ))
            ->add('usuario.language', 'column', array(
                'title' => 'Usuario Language',
            ))
            ->add('usuario.picture', 'column', array(
                'title' => 'Usuario Picture',
            ))
            ->add('usuario.init', 'column', array(
                'title' => 'Usuario Init',
            ))
            ->add('usuario.data', 'column', array(
                'title' => 'Usuario Data',
            ))
            ->add(null, 'action', array(
                'title' => $this->translator->trans('datatables.actions.title'),
                'actions' => array(
                    array(
                        'route' => 'docentes',
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
                        'route' => 'docentes_edit',
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
        return 'MultiacademicoBundle\Entity\Docentes';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'docentes_datatable';
    }
}
