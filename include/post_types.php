<?php
add_action('init', 'create_bright_and_shiny' );
add_action('init', 'create_tax_category_bright_and_shiny');

add_action('init', 'create_event');
add_action('init', 'create_tax_location_event');

add_action('init', 'create_newsroom');
add_action('init', 'create_tax_category_newsroom');

add_action('init', 'create_vacancies');
add_action('init', 'create_tax_location_vacancies');

add_action('init', 'create_testimonials');
function create_bright_and_shiny(){
    register_post_type('bright_and_shiny',
        array(
            'labels' => array(
                'name'          => __('Bright and shiny'),
                'singular_name' => __('Bright and shiny'),
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-admin-post',
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            //'exclude_from_search' => true,
            'supports' => array('title', 'editor', 'thumbnail','page-attributes', 'revisions'), // Go to Dashboard Custom HTML5 Blank post for supports
        ));
}
function create_tax_category_bright_and_shiny(){
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'           => $taxonomy,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('category_bright', array('bright_and_shiny'), $args );
}

function create_event(){
    register_post_type('events',
        array(
            'labels' => array(
                'name'          => __('Events'),
                'singular_name' => __('Event'),
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-calendar',
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            //'exclude_from_search' => true,
            'supports' => array('title', 'editor', 'thumbnail','page-attributes', 'revisions'), // Go to Dashboard Custom HTML5 Blank post for supports
        ));
}
function create_tax_location_event(){
    $labels = array(
        'name'              => 'Location',
        'singular_name'     => 'Location',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'           => $taxonomy,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('location_event', array('events'), $args );
}


function create_newsroom(){
    register_post_type('newsroom',
        array(
            'labels' => array(
                'name'          => __('Newsroom'),
                'singular_name' => __('Newsroom'),
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-media-document',
            'hierarchical' => true,
            'has_archive' => true,
            //'exclude_from_search' => true,
            'supports' => array('title', 'editor', 'thumbnail','page-attributes', 'revisions'),
        ));
}
function create_tax_category_newsroom(){
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'           => $taxonomy,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('category_news', array('newsroom'), $args );
}

function create_vacancies(){
    register_post_type('vacancies',
        array(
            'labels' => array(
                'name'          => __('Current Vacancies'),
                'singular_name' => __('Vacancy'),
            ),
            'public' => true,
            'menu_icon'  => 'dashicons-universal-access',
            'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
            'has_archive' => true,
            //'exclude_from_search' => true,
            'supports' => array('title', 'editor', 'thumbnail','page-attributes', 'revisions'), // Go to Dashboard Custom HTML5 Blank post for supports
        ));
}
function create_tax_location_vacancies(){
    $labels = array(
        'name'              => 'Location',
        'singular_name'     => 'Location',
    );
    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => false,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'           => $taxonomy,
        'capabilities'          => array(),
        'meta_box_cb'           => 'post_categories_meta_box',
        'show_admin_column'     => true,
    );
    register_taxonomy('location_vacancy', array('vacancies'), $args );
}

function create_testimonials(){
    register_post_type('testimonials',
        array(
            'labels' => array(
                'name'          => __('Testimonials'),
                'singular_name' => __('Testimonial'),
            ),
            'public' => true,
            'publicly_queryable' => false,
            'menu_icon'  => 'dashicons-admin-post',
            'hierarchical' => false,
            'has_archive' => false,
            'exclude_from_search' => true,
            'supports' => array('title', 'editor'),
        ));
}


