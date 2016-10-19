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
 * General Menu Tab - Main
 * ----------------------------------------------- */
WPTS()->tabs['wpts'][] = array(
	'args' => array(
		'title'   => __("Main", WPTS_PLUGIN_SLUG),
		'id'      => 'main-settings',
		'fa-icon' => 'fa-main',
		'class'   => ''
	),
	'groups' => array(
		'set_1' => array(
			'args' => array(
				'title' => __("Website Title", WPTS_PLUGIN_SLUG),
				'id'    => 'site-name',
				'class' => '',
				'desc'  => __("Enter your website title.", WPTS_PLUGIN_SLUG),
			),
			'fields' => array(
				array(
					'type'  => 'text', // switch,
					'title' => __("Website Title", WPTS_PLUGIN_SLUG),
					'name'  => 'blogname',
					'id'    => 'blogname',
					'class' => 'option-item bg-grey-input ',
					'placeholder' => 'placeholder TEXT',
					'default' => 100,
					'min' => 0,
					'max' => 200,
					'data' => array(),
				),
			),
		),
	),
);
