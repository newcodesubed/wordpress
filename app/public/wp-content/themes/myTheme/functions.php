<?php


// Enqueue Styles 

function load_css()
{
    wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all');
    wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all');
    wp_enqueue_style('main');
}

add_action('wp_enqueue_scripts', 'load_css');


// Enqueue JS

function load_js()
{
    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true);
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js');


// Theme Options

    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('widgets');



// Menu
register_nav_menus(
    array(
        'top-menu' => 'Top Menu Location',
        'mobile-menu' => 'Mobile Menu Location'
    )
);

// custom image size
add_image_size('blog-small', 300, 200, true);
add_image_size('blog-large', 800, 400, true);

// sidebar

function my_sidebar(){
    register_sidebar(
        array(
            'name' => 'Page Sidebar',
            'id' => 'page-sidebar',
            'before_widget' => '<h4 class="widget-title">',
            'after_widget' => "</h4>",
            
        )
    );
    register_sidebar(
        array(
            'name' => 'Blog Sidebar',
            'id' => 'blog-sidebar',
            'before_widget' => '<h4 class="widget-title">',
            'after_widget' => "</h4>",
            
        )
    );
}
add_action('widgets_init', 'my_sidebar');

// custom post type

function my_first_post_type(){
    $args = array(
        'labels' => array(
            'name' => 'Cars',
            'singular_name' => 'Car'
        ),
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-car',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields')
    );
    register_post_type('cars', $args);
}
add_action('init', 'my_first_post_type');

//taxonomy

function my_first_taxonomy(){
    $args = array(
        'labels' => array(
            'name' => 'Brands',
            'singular_name' => 'Brand'
        ),
        'hierarchical' => true,
        'public' => true,
        'has_archive' => true,
    );
    register_taxonomy('brands', array('cars'), $args);
}
add_action('init', 'my_first_taxonomy');  