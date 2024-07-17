<?php
require_once('include/class-wp-bootstrap-navwalker.php');
require_once('include/crumbs.php');
require_once('include/post_types.php');
require_once('include/functions-common.php');
require_once('include/functions-ajax.php');


/**
 * Main theme class
 *
 * Initialise all filter and actions, implement theme functions
 */
class AaseyaWP
{

    /**
     * Site version. Use it for static files.
     */
    public static $site_version;

    /**
     * Create a new theme object.
     */
    static function init()
    {
        self::$site_version = '1.0.8';
        self::manage_actions();
        self::manage_filters();
    }

    /**
     * Manage with WordPress actions
     */
    static function manage_actions()
    {
        // Add css and js
        add_action('wp_enqueue_scripts', array(
            'AaseyaWP',
            'include_css_and_js'
        ));
        // Remove Wordpress emoji
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        // Manage theme features
        add_action('after_setup_theme', array(
            'AaseyaWP',
            'manage_theme_features'
        ));
        //Remove the REST API endpoint.
        remove_action('rest_api_init', 'wp_oembed_register_route');
        //Remove oEmbed discovery links.
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        //Remove oEmbed JavaScript from the front-end and back-end.
        remove_action('wp_head', 'wp_oembed_add_host_js');
    }

    /**
     * Manage with WordPress filters
     */
    static function manage_filters()
    {
        // Add classes to body
        add_filter('body_class', array(
            'AaseyaWP',
            'custom_body_classes'
        ));
        // Filter mime types
        add_filter('upload_mimes', array(
            'AaseyaWP',
            'custom_mime_types'
        ));
        // Turn off oEmbed auto discovery.
        add_filter('embed_oembed_discover', '__return_false');
        // Don't filter oEmbed results.
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    }

    /**
     * Manage with WordPress mime types
     *
     * @return array with possible mime types
     */
    static function custom_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    }

    /**
     * Implement addition default WordPress theme features
     */
    static function manage_theme_features()
    {
        // Activate featured images for posts
        // Addition image sizes
        add_theme_support('post-thumbnails');
        // Create menus
        register_nav_menus(
            array(
                'menu_primary' => __('Top menu', 'lumikast')
            )
        );
        // Let WordPress manage the document title.
        add_theme_support('title-tag');
        // Add ACF option page
        acf_add_options_page(array(
            'page_title' => 'Theme options',
            'icon_url' => 'dashicons-admin-settings',
            'redirect' => false,
            'position' => 197
        ));
    }

    /**
     * Manage with theme static files and they context
     */
    static function include_css_and_js()
    {
        wp_deregister_script('wp-embed');
        wp_dequeue_style('wp-block-library');
        wp_enqueue_style(
            'mainStyle',
            get_template_directory_uri().'/static/dist/main.css',
            array(),
            self::$site_version
        );
        wp_enqueue_script(
            'libs-app',
            get_template_directory_uri().'/libs/libs.js',
            array(),
            '',
            true
        );
        wp_enqueue_script(
            'mainScript',
            get_template_directory_uri().'/static/dist/main.js',
            array(),
            self::$site_version,
            true
        );


    }

    /**
     * Added new classes to body tag on front end part
     *
     * @return array with class names
     */
    static function custom_body_classes($classes)
    {
        $browsers = [
            'is_iphone',
            'is_chrome',
            'is_safari',
            'is_NS4',
            'is_opera',
            'is_macIE',
            'is_winIE',
            'is_gecko',
            'is_lynx',
            'is_IE',
            'is_edge'
        ];
        $classes[] = join(' ', array_filter($browsers, function ($browser) {
            return $GLOBALS[$browser];
        }));
        if (stristr($_SERVER['HTTP_USER_AGENT'],"mac")) {
            $classes[] = 'osx';
        } elseif (stristr( $_SERVER['HTTP_USER_AGENT'],"linux")) {
            $classes[] = 'linux';
        } elseif (stristr( $_SERVER['HTTP_USER_AGENT'],"windows")) {
            $classes[] = 'windows';
        }
        $classes[] = 'fixed-header';
        return $classes;
    }

}


AaseyaWP::init();
