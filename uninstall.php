<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 27/03/15
 * Time: 13:26
 */

if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

function wp_smb_plugin_uninstall(){

    $option_names =  array('wp_smb_general_settings', 'wp_smb_options_settings');

    foreach($option_names as $option_name) {
        delete_option($option_name);
    }
}