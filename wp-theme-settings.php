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
 * Domain Path: /languages/
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

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

# Defines
if ( ! defined('WPTS_VERSION') )         define('WPTS_VERSION',         '1.0.0');
if ( ! defined('WPTS_PLUGIN_SLUG') )     define('WPTS_PLUGIN_SLUG',     'wp-theme-settings');
if ( ! defined('WPTS_PLUGIN_FILE') )     define('WPTS_PLUGIN_FILE',     __FILE__);
if ( ! defined('WPTS_PLUGIN_DIR') )      define('WPTS_PLUGIN_DIR',      plugin_dir_path( WPTS_PLUGIN_FILE ));
if ( ! defined('WPTS_PLUGIN_URL') )      define('WPTS_PLUGIN_URL',      plugin_dir_url( WPTS_PLUGIN_FILE ));
if ( ! defined('WPTS_PLUGIN_BASENAME') ) define('WPTS_PLUGIN_BASENAME', plugin_basename( WPTS_PLUGIN_FILE ));
if ( ! defined('WPTS_AJAX_URL') )        define('WPTS_AJAX_URL',        admin_url( 'admin-ajax.php', 'relative' ));

# Require Core files
require_once('includes/class.wpts.php');
require_once('includes/functions.php');

# Global for backwards compatibility.
$GLOBALS['wpts'] = WPTS();