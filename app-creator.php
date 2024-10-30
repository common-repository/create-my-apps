<?php

/*
Plugin Name: Create my Apps
Plugin URI: https://create-my-apps.com
Description: Connect easily your app with your Wordpress and WooCommerce site.
Version: 1.2.5
Author: Create my Apps
*/

/**
 * @package     app-creator
 * @author      Create my Apps
 * @copyright   2013-2017 Create my Apps
 * @version     1.2.4
 */

define('APP_CREATOR_BASE_PATH', dirname(__FILE__));
@include_once APP_CREATOR_BASE_PATH."/models/default.php";
@include_once APP_CREATOR_BASE_PATH."/models/connector.php";

function app_creator_init() {

    if (phpversion() < 5) {
        add_action('admin_notices', 'app_creator_php_version_warning');
        return;
    }

    new App_Creator_Connector();
}

function app_creator_php_version_warning() {
    echo "<div id=\"app-creator-warning\" class=\"updated fade\"><p>Sorry, App Creator requires PHP version 5.0 or greater.</p></div>";
}

function app_creator_activation() {
    // Add the rewrite rule on activation
    global $wp_rewrite;
    add_filter('rewrite_rules_array', 'app_creator_rewrites');
    $wp_rewrite->flush_rules();
}

function app_creator_deactivation() {
    // Remove the rewrite rule on deactivation
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}

add_action('init', 'app_creator_init');
register_activation_hook(APP_CREATOR_BASE_PATH."/app-creator.php", 'app_creator_activation');
register_deactivation_hook(APP_CREATOR_BASE_PATH."/app-creator.php", 'app_creator_deactivation');
?>
