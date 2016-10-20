# WP_ThemeSettings
WP Theme Settings

/**
 * Add Sub Menu
 * ----------------------------------------------- */
WPTS()->submenu['test'] = array(
	'menu_title' => 'TEST',       // required
	'page_title' => 'TEST Title', // optional
	'capability' => 'TEST',       // optional
);

/**
 * General Menu Tab - General
 * ----------------------------------------------- */
WPTS()->tabs['wpts']['general'] = array(
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
							'name'  => 'test01',
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
							'name'  => 'test02',
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
							'name'  => 'test03',
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
							'name'  => 'blogname',
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
							'name'  => 'blogname',
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
							'name'  => 'blogname',
							'title' => __("Website Title", WPTS_PLUGIN_SLUG),
							'id'    => 'blogname',
							'class' => 'option-item bg-grey-input ',
							'placeholder' => 'placeholder TEXT',
							'default' => 'x04',
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
							'name'  => 'blogname',
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
);
