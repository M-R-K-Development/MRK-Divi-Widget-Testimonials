<?php
/*
 * Plugin Name: MRK Divi Widget Testimonials Divi Widget
 * Plugin URI: https://mrkdevelopment.com
 * Description: Addon for Divi Widget for MRK Divi Widget Testimonials.
 * Version: 1.0
 * Author: M R K Development
 * Author URI: https://mrkdevelopment.com
 * License: GPLv2 or later
 */
if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $mrk_divi_custom_widgets_enabler;

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// DiviCustomWidget

/**
 * Defines variables for
 * @return [type] [description]
 */
function mrk_divi_widget_testimonials()
{
    global $mrk_divi_custom_widgets_enabler;
    $files = glob(__DIR__.'/src/widgets/*');
    $mrk_divi_custom_widgets_enabler->addCustomWidgets(array(__DIR__ => $files));
}

add_filter('mrk_divi_widgets_load', 'mrk_divi_widget_testimonials');

// Check if Divi Module is installed.
if (!function_exists('check_mrk_module_builder_present_for_mrk_divi_widget_testimonials')) {
    function admin_error_notice_mrk_custom_widget_absent_for_mrk_divi_widget_testimonials()
    {
        ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'MRK Divi Widget Testimonials requires MRK Divi Builder Custom Widget active plugin.', 'sample-text-domain' );
        ?></p>
    </div>
    <?php

    }

    function check_mrk_module_builder_present_for_mrk_divi_widget_testimonials()
    {
        if (!class_exists('\\MRKDiviCustomWidgetsEnabler')) { // MRK Custom Widget plugin not installed.
            add_action( 'admin_notices', 'admin_error_notice_mrk_custom_widget_absent_for_mrk_divi_widget_testimonials' );
        }
    }
}

add_action('init', 'check_mrk_module_builder_present_for_mrk_divi_widget_testimonials');

// add_action( 'admin_head', 'clear_testimonials_widget' );

function clear_testimonials_widget()
{
    echo '<script>
            localStorage.clear();
        </script>';
}

// Register Custom Post Type - Testimonial
function custom_post_type_testimonials()
{
    $labels = array(
        'name'                  => _x( 'Testimonials', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'Testimonials', 'text_domain' ),
        'name_admin_bar'        => __( 'Testimonial', 'text_domain' ),
        'archives'              => __( 'Item Archives', 'text_domain' ),
        'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Items', 'text_domain' ),
        'add_new_item'          => __( 'Add New Item', 'text_domain' ),
        'add_new'               => __( 'Add New', 'text_domain' ),
        'new_item'              => __( 'New Item', 'text_domain' ),
        'edit_item'             => __( 'Edit Item', 'text_domain' ),
        'update_item'           => __( 'Update Item', 'text_domain' ),
        'view_item'             => __( 'View Item', 'text_domain' ),
        'search_items'          => __( 'Search Item', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                  => 'testimonial',
        'with_front'            => true,
        'pages'                 => true,
        'feeds'                 => true,
    );
    $args = array(
        'label'                 => __( 'Testimonial', 'text_domain' ),
        'description'           => __( 'Testimonial Post Type', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array('title', 'editor'),
        'taxonomies'            => array( 'testimonial_category' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'rewrite'               => $rewrite,
        'capability_type'       => 'post',
    );
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'custom_post_type_testimonials', 0 );

// Register Custom Taxonomy
function custom_testimonial_taxonomy()
{
    $labels = array(
        'name'                       => _x( 'Testimonial Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Testimonial', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Taxonomy', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'view_item'                  => __( 'View Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
        'popular_items'              => __( 'Popular Items', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
        'no_terms'                   => __( 'No items', 'text_domain' ),
        'items_list'                 => __( 'Items list', 'text_domain' ),
        'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
    );
    $rewrite = array(
        'slug'                       => 'testimonial_categories',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewrite,
    );
    register_taxonomy( 'testimonial_category', array( 'testimonial' ), $args );
}

add_action( 'init', 'custom_testimonial_taxonomy', 0 );
add_action( 'init', 'testimonials_acf', 20 );

function testimonials_acf()
{
    if ( function_exists('acf_add_local_field_group') ) {
        acf_add_local_field_group(array (
    'key'    => 'group_574ff07099083',
    'title'  => 'Testimonial',
    'fields' => array (
        array (
            'key'               => 'field_574ff0953d339',
            'label'             => 'Author',
            'name'              => 'author',
            'type'              => 'text',
            'instructions'      => '',
            'required'          => 1,
            'conditional_logic' => 0,
            'wrapper'           => array (
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'maxlength'     => '',
            'readonly'      => 0,
            'disabled'      => 0,
        ),
        array (
            'key'               => 'field_574ff0ab3d33a',
            'label'             => 'Job Title',
            'name'              => 'job_title',
            'type'              => 'text',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array (
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'maxlength'     => '',
            'readonly'      => 0,
            'disabled'      => 0,
        ),
        array (
            'key'               => 'field_574ff0b83d33b',
            'label'             => 'Company Name',
            'name'              => 'company_name',
            'type'              => 'text',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array (
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'default_value' => '',
            'placeholder'   => '',
            'prepend'       => '',
            'append'        => '',
            'maxlength'     => '',
            'readonly'      => 0,
            'disabled'      => 0,
        ),
        array (
            'key'               => 'field_574ff0ce3d33c',
            'label'             => 'Author Or Company URL',
            'name'              => 'author_or_company_url',
            'type'              => 'url',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array (
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'default_value' => '',
            'placeholder'   => '',
        ),
        array (
            'key'               => 'field_574ff2473d33d',
            'label'             => 'Portrait Image',
            'name'              => 'portrait_image',
            'type'              => 'image',
            'instructions'      => '',
            'required'          => 0,
            'conditional_logic' => 0,
            'wrapper'           => array (
                'width' => '',
                'class' => '',
                'id'    => '',
            ),
            'return_format' => 'array',
            'preview_size'  => 'thumbnail',
            'library'       => 'all',
            'min_width'     => '',
            'min_height'    => '',
            'min_size'      => '',
            'max_width'     => '',
            'max_height'    => '',
            'max_size'      => '',
            'mime_types'    => '',
        ),
    ),
    'location' => array (
        array (
            array (
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'testimonial',
            ),
        ),
    ),
    'menu_order'            => 0,
    'position'              => 'normal',
    'style'                 => 'default',
    'label_placement'       => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen'        => '',
    'active'                => 1,
    'description'           => '',
));
    }
}
