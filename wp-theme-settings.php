<?php
/**
 * Plugin Name: WP Theme Settings
 * Plugin URI: http://devdiamond.com/
 * Description: Plugin intended only for DEVELOPERS. Creates a page with the settings for the installed WordPress theme. A very useful tool for developers who work with WordPress Themes.
 * Version: 1.0.0
 * Author: DevDiamond <me@devdiamond.com>
 * Author URI: http://devdiamond.com/
 * License: GPLv3 or later - http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: wp-theme-settings
 * Domain Path: languages
 *
 * Copyright (C) 2016 DevDiamond. (email : me@devdiamond.com)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * WP_ThemeSettings Core (Main Class)
 *
 * @class    WP_ThemeSettings
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_ThemeSettings
 * @version  1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

if ( ! defined('WPTS_VERSION') )         define('WPTS_VERSION',         '1.0.0');
if ( ! defined('WPTS_PLUGIN_SLUG') )     define('WPTS_PLUGIN_SLUG',     'wp-theme-settings');
if ( ! defined('WPTS_PLUGIN_FILE') )     define('WPTS_PLUGIN_FILE',     __FILE__);
if ( ! defined('WPTS_PLUGIN_DIR') )      define('WPTS_PLUGIN_DIR',      plugin_dir_path( WPTS_PLUGIN_FILE ));
if ( ! defined('WPTS_PLUGIN_URL') )      define('WPTS_PLUGIN_URL',      plugin_dir_url( WPTS_PLUGIN_FILE ));
if ( ! defined('WPTS_PLUGIN_BASENAME') ) define('WPTS_PLUGIN_BASENAME', plugin_basename( WPTS_PLUGIN_FILE ));
if ( ! defined('WPTS_AJAX_URL') )        define('WPTS_AJAX_URL',        admin_url( 'admin-ajax.php', 'relative' ));

// Load Main WP_ThemeSettings Class
if ( ! class_exists( 'WP_ThemeSettings' ) ) :

/**
 * Class WP_ThemeSettings - Main Class (Core).
 */
final class WP_ThemeSettings
{
	/**
	 * The single instance of the class.
	 *
	 * @var WP_ThemeSettings
	 */
	protected static $_instance = null;

	/**
	 * Main WP_ThemeSettings Instance.
	 *
	 * Ensures only one instance of WP_ThemeSettings is loaded or can be loaded.
	 *
	 * @static
	 * @see WPTS()
	 * @return WP_ThemeSettings - Main instance.
	 */
	public static function instance()
	{
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 */
	public function __clone(){}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup(){}

	/**
	 * WP_ThemeSettings Constructor.
	 */
	public function __construct()
	{
		$this->includes();
		$this->init_hooks();

		do_action('wpts_loaded');
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks()
	{
		// activation and deactivation hook
		register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
		register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivation' ) );

		// init action
		add_action('init', array( $this, 'init' ), 0 );
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes()
	{
		if ( $this->is_request('admin') )
			require_once('includes/admin/class.wpts-admin.php');
	}

	/**
	 * Check the type of request
	 *
	 * @param  string $type  - admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type )
	{
		switch ( $type )
		{
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
		return false;
	}

	/**
	 * Init WP_ThemeSettings when WordPress Initialises.
	 */
	public function init()
	{
		// Set up localisation.
		$this->load_plugin_textdomain();

		// Init action.
		do_action( 'wpts_init' );
	}

	/**
	 * Load Localisation files.
	 */
	public function load_plugin_textdomain()
	{
		if ( ! is_textdomain_loaded( WPTS_PLUGIN_SLUG ) )
			load_plugin_textdomain( WPTS_PLUGIN_SLUG, false, basename( WPTS_PLUGIN_BASENAME ) . '/languages' );
	}

	public function plugin_activation()
	{
		//
	}

	public function plugin_deactivation()
	{
		//
	}
}

endif;

/**
 * Main instance of WP_ThemeSettings.
 *
 * @return WP_ThemeSettings
 */
function WPTS()
{
	return WP_ThemeSettings::instance();
}

// Global for backwards compatibility.
$GLOBALS['wpts'] = WPTS();
