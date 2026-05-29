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

function my_sidebar()
{
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

function my_first_post_type()
{
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

function my_first_taxonomy()
{
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


add_action('wp_ajax_enquiry', 'handle_enquiry');
add_action('wp_ajax_nopriv_enquiry', 'handle_enquiry');

function handle_enquiry()
{
    if(!wp_verify_nonce(($_POST['nonce']), 'ajax-nonce')) {
        wp_send_json_error('Invalid nonce. Please refresh the page and try again.',401);
        die();
    }

    $formData = [];

    parse_str($_POST['enquiry'], $formData);

    // Admin email address
    $admin_email = get_option('admin_email');

    // Email headers
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: ' . $admin_email;
    $headers[] = 'Reply-To: ' . $formData['email'];

    // Email sending to?
    $send_to = $admin_email;

    // Email subject
    $subject = 'New Enquiry from ' . $formData['name'];

    // Email body
    $message = '';

    foreach ($formData as $index => $field) {
        $message .= '<p><strong>' . $index . ':</strong> ' . $field . '</p>' . '<br />';
    }

    // Send the email
    try {
        if (wp_mail($send_to, $subject, $message, $headers)) {
            wp_send_json_success('Your enquiry has been sent successfully!');
        } else {
            wp_send_json_error('Failed to send your enquiry. Please try again later.');
        }
    } catch (Exception $e) {
        wp_send_json_error($e->getMessage());
    }

    wp_send_json_success($formData['name'] . ', your enquiry has been received! We will get back to you shortly.');
}

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
	require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );
