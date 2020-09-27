<?php
/*
Plugin Name: WooCommerce Cart Gifts
Plugin URI: 
Description: WooCommerce Cart Gifts
Version: 0.0.1
Author: Jony Hayama
Author URI: https://jony.dev
*/

define( 'WC_CART_GIFTS_PLUGIN_FILE', __FILE__ );
define( 'WC_CART_GIFTS_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WC_CART_GIFTS_PLUGIN_URL', plugins_url('', __FILE__ ) );
define( 'WC_CART_GIFTS_ASSETS_URL', WC_CART_GIFTS_PLUGIN_URL . '/app/assets' );
define( 'WC_CART_GIFTS_APP_PATH', WC_CART_GIFTS_DIR_PATH . 'app' . DIRECTORY_SEPARATOR );

require_once( WC_CART_GIFTS_APP_PATH . 'application.class.php' );

function wc_cart_gifts( $module = '' ){
	static $_wcCartGifts_obj = null;
	if( !$_wcCartGifts_obj ){
		$_wcCartGifts_obj = new wcCartGifts();
	} 
	if( $module ){
		return $_wcCartGifts_obj->getModule( $module );
	}
	return $_wcCartGifts_obj;
}
wc_cart_gifts();
