<?php

// Enregistrement - Menu Principal
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_my_menu' );

// Enregistrement - Menu pied de page
function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Menu du pied de page', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );

// Ajout - Styles 
function enqueue_custom_styles() {
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/theme.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-single-photo-css', get_template_directory_uri() . '/css/single-photo.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-index-css', get_template_directory_uri() . '/css/index.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-photoblock-css', get_template_directory_uri() . '/css/photo-block.css', array(), '1.0', 'all');
    wp_enqueue_style('lightbox-single-photo', get_template_directory_uri() . '/css/lightbox-single-photo.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Ajout - Scripts (Modales Accueil)
function enqueue_custom_scripts() {
    wp_enqueue_script('header-scripts', get_template_directory_uri() . '/js/header-scripts.js', array('jquery'), '1.1.1', true);
    wp_enqueue_script('modal-scripts-index', get_template_directory_uri() . '/js/modal-scripts.js', array('jquery'), '1.0', true);
    wp_enqueue_script('modal-scripts-photo', get_template_directory_uri() . '/js/modal-scripts-photo.js', array('jquery'), '1.0', true);
    wp_enqueue_script('lightbox-single-photo', get_template_directory_uri() . '/js/lightbox-single-photo.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

?>
