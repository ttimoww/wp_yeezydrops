<?php
    add_theme_support( 'post-thumbnails' );
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'homepage' => __('Home Page')
    ));   

    function theme_scripts(){
        wp_enqueue_style('bundle', get_template_directory_uri() . '/dist/css/bundle.css', false, '1.1', 'all' );
        wp_enqueue_script('bundle', get_template_directory_uri() . '/dist/js/bundle.js', array('jquery'), '1.1', true);
    }

    add_action('wp_enqueue_scripts', 'theme_scripts');
?>
