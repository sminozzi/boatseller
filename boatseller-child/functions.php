<?php
if ( !defined( 'ABSPATH' ) ) exit;
if ( !function_exists( 'boatseller_cfg_parent_css' ) ):
    function boatseller_cfg_parent_css() {
        wp_enqueue_style( 'boatseller_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'genericons' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'boatseller_cfg_parent_css', 10 );
