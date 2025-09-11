<?php
/**
	Plugin Name: Flexible Shipping Import/Export Add-on
	Plugin URI: https://octol.io/fsie-plugin-site
	Description: Use the CSV files to import or export your shipping methods. Edit, update, move or backup the ready configurations and shipping scenarios.
	Version: 1.5.11
	Author: Octolize
	Author URI: https://octol.io/fsie-author
	Text Domain: flexible-shipping-import-export
	Domain Path: /lang/
	Requires at least: 6.4
	Tested up to: 6.8
	WC requires at least: 9.7
	WC tested up to: 10.2
	Requires PHP: 7.4

	@package Flexible Shipping Import Export

	Copyright 2016 WP Desk Ltd.

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/* THIS VARIABLE CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '1.5.11';

$plugin_name        = 'Flexible Shipping Import/Export for WooCommerce';
$plugin_class_name  = 'WPDesk\FS\TableRate\ImportExport\Plugin';
$plugin_text_domain = 'flexible-shipping-import-export';
$product_id         = 'Flexible Shipping Import/Export for WooCommerce';
$plugin_file        = __FILE__;
$plugin_dir         = __DIR__;
$plugin_shops       = [
	'pl_PL'   => 'https://www.wpdesk.pl/',
	'default' => 'https://octolize.com',
];


define( 'FLEXIBLE_SHIPPING_IMPORT_EXPORT_VERSION', $plugin_version );
define( $plugin_class_name, $plugin_version );

$requirements = [
	'php'          => '7.4',
	'wp'           => '4.5',
	'repo_plugins' => [
		[
			'name'      => 'flexible-shipping/flexible-shipping.php',
			'nice_name' => 'Flexible Shipping',
			'version'   => '4.1',
		],
	],
	'plugins'      => [
		[
			'name'      => 'flexible-shipping/flexible-shipping.php',
			'nice_name' => 'Flexible Shipping',
			'version'   => '4.1',
		],
	],
];

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/plugin-init-php52.php';
