<?php
/*
Plugin Name: Divi Fireworks Button
Plugin URI: https://plains.digital/divi-fireworks
Description: Make clicking your CTAs exciting with a great fireworks effect! 
Version: .01a
Author: JD Michell @ Plains.Digital Inc.
Author URI: https://plains.digital
License: GPLv2 or later
Text Domain: custom-divi-modules
*/

function divi_fireworks_init() {
    if (!class_exists('ET_Builder_Module')) {
        return;
    }
    require_once plugin_dir_path( __FILE__ ) . '/divi-fireworks-button-module.php';
}

add_action('et_builder_ready', 'divi_fireworks_init');