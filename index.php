<?php

/**
 * Plugin Name: EIC - The Glow Squad
 * Plugin URI: http://gabecode.com
 * Description: a Simple block that contains an slider customly made for EIC (with love <3 ) by Your Dev Apps Manager Gabriel. Use the shortcode [eic-glow-squad] in the page you want to display the block
 * Version: 1.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Gabriel Coronado
 * Author URI: http://gabecode.com
 * Text Domain: eic-glowsquad   
 * Domain Path: /languages
 */

if (!function_exists('add_action')) {
    echo 'You are on my spot (Sheldon Cooper)';
    exit;
}

// Setup
define('EIC_GLOW_PATH', plugin_dir_path(__FILE__));
define('EIC_GLOW_DIR', plugin_dir_url(__FILE__));

// Includes
include(EIC_GLOW_PATH . 'includes/front/enqueue.php');
include(EIC_GLOW_PATH . 'includes/front/glow-squad.php');
include(EIC_GLOW_PATH . 'includes/admin/squad-cpt.php');


// Hooks
add_action('wp_enqueue_scripts', 'eic_glowsquad_enqueue', 5);
add_action('init', 'eic_glow_squad_cpt');
add_action('add_meta_boxes', 'eic_glowsquad_custom_metabox');
add_action('save_post', 'eic_save_meta_data_position');
add_action('save_post', 'eic_save_meta_data_bio');
add_shortcode('eic-glow-squad', 'eic_glow_squad_slider');
