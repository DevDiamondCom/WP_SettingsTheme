# WP_ThemeSettings
WP Theme Settings

/**
 * Add Sub Menu
 * ----------------------------------------------- */
add_filter('wpts_submenu', function($submunu)
{
    return array_merge($submunu, array(
        'test' => array(
            'menu_title' => 'TEST',           // required
            'page_title' => 'TEST Title',     // optional (default: '')
            'capability' => 'manage_options', // optional (default: 'manage_options')
        ),
        'test2' => array(
            'menu_title' => 'TEST2',          // required
            'page_title' => 'TEST2 Title',    // optional (default: '')
            'capability' => 'manage_options', // optional (default: 'manage_options')
        ),
    ));
});


/**
 * General Menu Tab - General
 * ----------------------------------------------- */
add_filter('wpts_tabs_wpts', function($tabs)
{
    return array_merge($tabs, array(
        //------------------------------------------------------------------
        //  General
        //------------------------------------------------------------------
        'general' => array(
            'title_args' => array(
                'title'   => __("General", WPTS_PLUGIN_SLUG),
                'id'      => 'general-settings',
                'fa-icon' => 'fa-gear',
                'class'   => ''
            ),
            'groups' => array(
                'set_1' => array(
                    'group_args' => array(
                        'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                        'id'    => 'site-name',
                        'class' => '',
                        'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                    ),
                    'fields' => array(
                        'set_1' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'switch',
                                    'name'  => 'set_1_set_1',
                                    'default' => false,
                                    'desc'  => 'default "OFF"',
                                    'id'    => 'blogname',
                                    'class' => 'option-item bg-grey-input ',
                                ),
                            ),
                        ),
                        'set_2' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'text',
                                    'name'  => 'set_1_set_2',
                                    'desc'  => 'me@devdiamond.com',
                                    'default' => 'me@devdiamond.com',
                                    'title' => __("Your Email address", WPTS_PLUGIN_SLUG),
                                    'id'    => 'address_id_01',
                                    'class' => 'address_class_01',
                                    'placeholder' => 'placeholder TEXT',
                                ),
                            ),
                        ),
                        'set_3' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'textarea',
                                    'name'  => 'set_1_set_3',
                                    'default' => '',
                                    'desc'  => 'Это поле TextArea',
                                    'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                    'id'    => 'blogname',
                                    'class' => 'option-item bg-grey-input ',
                                    'placeholder' => 'placeholder TEXT',
                                ),
                            ),
                        ),
                    ),
                ),
                'set_2' => array(
                    'group_args' => array(
                        'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                        'id'    => 'site-name',
                        'class' => '',
                        'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                    ),
                    'fields' => array(
                        'set_1' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'id'    => 'site-name',
                                'class' => '',
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'number',
                                    'name'  => 'set_2_set_1',
                                    'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                    'id'    => 'blogname',
                                    'class' => 'option-item bg-grey-input ',
                                    'placeholder' => 'placeholder TEXT',
                                    'default' => 100,
                                    'min'  => 0,
                                    'max'  => 200,
                                    'step' => 0.01,
                                ),
                            ),
                        ),
                        'set_2' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'id'    => 'site-name',
                                'class' => '',
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'select',
                                    'name'  => 'set_2_set_2',
                                    'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                    'id'    => 'blogname',
                                    'class' => 'option-item bg-grey-input ',
                                    'placeholder' => 'placeholder TEXT',
                                    'default' => 'x03',
                                    'data' => array(
                                        'x01' => '01',
                                        'x02' => '02',
                                        'x03' => '03',
                                        'x04' => '04',
                                        'x05' => '05',
                                    ),
                                ),
                            ),
                        ),
                        'set_3' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'id'    => 'site-name',
                                'class' => '',
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'checkbox',
                                    'name'  => 'set_2_set_3',
                                    'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                    'id'    => 'blogname',
                                    'class' => 'option-item bg-grey-input ',
                                    'placeholder' => 'placeholder TEXT',
                                    'default' => array('x02', 'x05'),
                                    'data' => array(
                                        'x01' => '01',
                                        'x02' => '02',
                                        'x03' => '03',
                                        'x04' => '04',
                                        'x05' => '05',
                                    ),
                                ),
                            ),
                        ),
                        'set_4' => array(
                            'field_args' => array(
                                'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                'id'    => 'site-name',
                                'class' => '',
                                'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
                            ),
                            'fields' => array(
                                array(
                                    'type'  => 'radio',
                                    'name'  => 'set_2_set_4',
                                    'title' => __("Website Title", WPTS_PLUGIN_SLUG),
                                    'id'    => 'blogname',
                                    'class' => 'option-item bg-grey-input ',
                                    'placeholder' => 'placeholder TEXT',
                                    'default' => 'x02',
                                    'data' => array(
                                        'x01' => '01',
                                        'x02' => '02',
                                        'x03' => '03',
                                        'x04' => '04',
                                        'x05' => '05',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
            ),
        ),
        //------------------------------------------------------------------
        //  TEST
        //------------------------------------------------------------------
        'test' => array(
            'args' => array(
                'title'   => __("Test", WPTS_PLUGIN_SLUG),
                'id'      => 'test01',
                'fa-icon' => 'fa-plus',
            ),
            'groups' => array(),
        ),
        //------------------------------------------------------------------
        //  TEST 2
        //------------------------------------------------------------------
        'test2' => array(
            'args' => array(
                'title'   => __("Test2", WPTS_PLUGIN_SLUG),
                'id'      => 'test02',
                'fa-icon' => 'fa-pencil',
            ),
            'groups' => array(),
        ),
    ));
});
