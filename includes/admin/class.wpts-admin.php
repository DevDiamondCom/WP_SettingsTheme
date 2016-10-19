<?php
/**
 * WP_ThemeSettings Admin
 *
 * @class    WPTS_Admin
 * @author   DevDiamond <me@devdiamond.com>
 * @package  WP_ThemeSettings/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class WPTS_Admin - Admin Panel set.
 */
class WPTS_Admin
{
	/**
	 * WPTS_Admin constructor.
	 */
	public function __construct()
	{
		add_action( 'init', array( $this, 'includes_init' ) );
		add_action( 'admin_init', array( $this, 'includes_admin_init' ) );
	}

	/**
	 * Include the necessary classes for the admin panel.
	 */
	public function includes_init()
	{
		require_once('class.wpts-admin-menus.php');
		require_once('class.wpts-admin-pages.php');
	}

	/**
	 * Include the necessary classes for the admin panel.
	 */
	public function includes_admin_init()
	{
		//
	}
}

new WPTS_Admin();
