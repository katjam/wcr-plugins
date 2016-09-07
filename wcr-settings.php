<?php
/*
Plugin Name: West Country Rural setup
Description: Provides default settings and pages for WCR.
Author: Katja Mordaunt
 */

define( 'WCR_PATH', plugin_dir_path( __FILE__ ) );
define( 'WCR_LOCATION', plugin_basename( __FILE__ ) );
define( 'WCR_URL', plugins_url( '' ,  __FILE__ ) );
require_once ( WCR_PATH . 'wcr-init-settings.php' );

