<?php
/**
 * Bike Rental Shop Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Bike Rental Shop
 */

if ( ! defined( 'BIKE_RENTAL_SHOP_URL' ) ) {
    define( 'BIKE_RENTAL_SHOP_URL', esc_url( 'https://www.themagnifico.net/themes/bike-rental-wordpress-theme/', 'bike-rental-shop') );
}

if ( ! defined( 'BIKE_RENTAL_SHOP_BUY_TEXT' ) ) {
    define( 'BIKE_RENTAL_SHOP_BUY_TEXT', __( 'Buy Bike Rental Shop Pro','bike-rental-shop' ));
}

use WPTRT\Customize\Section\Bike_Rental_Shop_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Bike_Rental_Shop_Button::class );

    $manager->add_section(
        new Bike_Rental_Shop_Button( $manager, 'bike_rental_shop_pro', [
            'title'       => __( 'Bike Rental Shop Pro', 'bike-rental-shop' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'bike-rental-shop' ),
            'button_url'  => 'https://www.themagnifico.net/themes/bike-rental-wordpress-theme/'
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'bike-rental-shop-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'bike-rental-shop-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bike_rental_shop_customize_register($wp_customize){

    // Pro Version
    class Bike_Rental_Shop_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( BIKE_RENTAL_SHOP_BUY_TEXT,'bike-rental-shop' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Bike_Rental_Shop_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    //Logo
    $wp_customize->add_setting('bike_rental_shop_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'bike_rental_shop_sanitize_number_absint'
    ));
    $wp_customize->add_control('bike_rental_shop_logo_max_height',array(
        'label' => esc_html__('Logo Width','bike-rental-shop'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('bike_rental_shop_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'bike-rental-shop' ),
        'section'        => 'title_tagline',
        'settings'       => 'bike_rental_shop_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('bike_rental_shop_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'bike-rental-shop' ),
        'section'        => 'title_tagline',
        'settings'       => 'bike_rental_shop_theme_description',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('bike_rental_shop_logo_title_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bike_rental_shop_logo_title_color', array(
        'label'    => __('Site Title Color', 'bike-rental-shop'),
        'section'  => 'title_tagline'
    )));

    $wp_customize->add_setting('bike_rental_shop_logo_tagline_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bike_rental_shop_logo_tagline_color', array(
        'label'    => __('Site Tagline Color', 'bike-rental-shop'),
        'section'  => 'title_tagline'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_logo', array(
        'section'     => 'title_tagline',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
        'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
        'priority'    => 100
    )));

    // General Settings
     $wp_customize->add_section('bike_rental_shop_general_settings',array(
        'title' => esc_html__('General Settings','bike-rental-shop'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('bike_rental_shop_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'bike-rental-shop' ),
        'section'        => 'bike_rental_shop_general_settings',
        'settings'       => 'bike_rental_shop_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('bike_rental_shop_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'bike_rental_shop_sanitize_choices'
    ));
    $wp_customize->add_control('bike_rental_shop_scroll_top_position',array(
        'type' => 'radio',
        'section' => 'bike_rental_shop_general_settings',
        'choices' => array(
            'Right' => __('Right','bike-rental-shop'),
            'Left' => __('Left','bike-rental-shop'),
            'Center' => __('Center','bike-rental-shop')
        ),
    ) );

    $wp_customize->add_setting('bike_rental_shop_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'bike-rental-shop' ),
        'section'        => 'bike_rental_shop_general_settings',
        'settings'       => 'bike_rental_shop_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'bike_rental_shop_preloader_bg_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bike_rental_shop_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','bike-rental-shop'),
        'section' => 'bike_rental_shop_general_settings',
        'settings' => 'bike_rental_shop_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'bike_rental_shop_preloader_dot_1_color', array(
        'default' => '#ff7111',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bike_rental_shop_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','bike-rental-shop'),
        'section' => 'bike_rental_shop_general_settings',
        'settings' => 'bike_rental_shop_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'bike_rental_shop_preloader_dot_2_color', array(
        'default' => '#18191e',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bike_rental_shop_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','bike-rental-shop'),
        'section' => 'bike_rental_shop_general_settings',
        'settings' => 'bike_rental_shop_preloader_dot_2_color'
    )));

     $wp_customize->add_setting('bike_rental_shop_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));

    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'bike-rental-shop' ),
        'section'        => 'bike_rental_shop_general_settings',
        'settings'       => 'bike_rental_shop_sticky_header',
        'type'           => 'checkbox',
    )));

   $wp_customize->add_setting('bike_rental_shop_product_per_page',array(
       'default'   => '9',
       'sanitize_callback' => 'bike_rental_shop_sanitize_float'
   ));
   $wp_customize->add_control('bike_rental_shop_product_per_page',array(
       'label' => __('Product per page','bike-rental-shop'),
       'section'   => 'bike_rental_shop_general_settings',
       'type'      => 'number'
   ));

   //Woocommerce shop page Sidebar
    $wp_customize->add_setting('bike_rental_shop_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'bike-rental-shop' ),
        'section'        => 'bike_rental_shop_general_settings',
        'settings'       => 'bike_rental_shop_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('bike_rental_shop_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'bike_rental_shop_sanitize_choices'
    ));
    $wp_customize->add_control('bike_rental_shop_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','bike-rental-shop'),
        'section' => 'bike_rental_shop_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','bike-rental-shop'),
            'Right Sidebar' => __('Right Sidebar','bike-rental-shop'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('bike_rental_shop_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'bike-rental-shop' ),
        'section'        => 'bike_rental_shop_general_settings',
        'settings'       => 'bike_rental_shop_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('bike_rental_shop_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'bike_rental_shop_sanitize_choices'
    ));
    $wp_customize->add_control('bike_rental_shop_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','bike-rental-shop'),
        'section' => 'bike_rental_shop_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','bike-rental-shop'),
            'Right Sidebar' => __('Right Sidebar','bike-rental-shop'),
        ),
    ) );

    $wp_customize->add_setting('bike_rental_shop_woocommerce_product_sale',array(
        'default' => 'Left',
        'sanitize_callback' => 'bike_rental_shop_sanitize_choices'
    ));
    $wp_customize->add_control('bike_rental_shop_woocommerce_product_sale',array(
        'type' => 'radio',
        'section' => 'bike_rental_shop_general_settings',
        'choices' => array(
            'Right' => __('Right','bike-rental-shop'),
            'Left' => __('Left','bike-rental-shop'),
            'Center' => __('Center','bike-rental-shop')
        ),
    ) );

    // Related Product
    $wp_customize->add_setting('bike_rental_shop_woocommerce_related_product_show_hide', array(
        'default' => true,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'bike_rental_shop_woocommerce_related_product_show_hide',array(
        'label'          => __( 'Show / Hide Related product', 'bike-rental-shop' ),
        'section'        => 'bike_rental_shop_general_settings',
        'settings'       => 'bike_rental_shop_woocommerce_related_product_show_hide',
        'type'           => 'checkbox',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'bike_rental_shop_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
        'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
        'priority'    => 100
    )));

    // Post Settings
     $wp_customize->add_section('bike_rental_shop_post_settings',array(
        'title' => esc_html__('Post Settings','bike-rental-shop'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('bike_rental_shop_post_page_title',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_post_page_meta',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_post_page_thumb',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'bike-rental-shop'),
    ));

     $wp_customize->add_setting( 'bike_rental_shop_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'bike_rental_shop_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'bike_rental_shop_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Post Page Image Border Radius','bike-rental-shop' ),
        'section'     => 'bike_rental_shop_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('bike_rental_shop_post_page_btn',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_post_page_btn',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Button', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable button on post page.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_thumb',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_meta',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_single_post_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Meta', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable single post meta such as post date, author, category, comment etc.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_title',array(
            'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_tags',array(
            'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_single_post_tags',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Tags', 'bike-rental-shop'),
        'section'     => 'bike_rental_shop_post_settings',
        'description' => esc_html__('Check this box to enable tags on single post.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_navigation_show_hide',array(
        'default' => true,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control('bike_rental_shop_single_post_navigation_show_hide',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Post Navigation','bike-rental-shop'),
        'section' => 'bike_rental_shop_post_settings',
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_comment_title',array(
        'default'=> 'Leave a Reply',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('bike_rental_shop_single_post_comment_title',array(
        'label' => __('Add Comment Title','bike-rental-shop'),
        'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'bike-rental-shop' ),
        ),
        'section'=> 'bike_rental_shop_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('bike_rental_shop_single_post_comment_btn_text',array(
        'default'=> 'Post Comment',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('bike_rental_shop_single_post_comment_btn_text',array(
        'label' => __('Add Comment Button Text','bike-rental-shop'),
        'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'bike-rental-shop' ),
        ),
        'section'=> 'bike_rental_shop_post_settings',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_post_setting', array(
                'section'     => 'bike_rental_shop_post_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

    // Page Settings
    $wp_customize->add_section('bike_rental_single_page_settings',array(
        'title' => esc_html__('Page Settings','bike-rental-shop'),
        'priority'   =>50,
    ));

    $wp_customize->add_setting('bike_rental_shop_single_page_title',array(
            'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_single_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Title', 'bike-rental-shop'),
        'section'     => 'bike_rental_single_page_settings',
        'description' => esc_html__('Check this box to enable title on single page.', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_single_page_thumb',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('bike_rental_shop_single_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Thumbnail', 'bike-rental-shop'),
        'section'     => 'bike_rental_single_page_settings',
        'description' => esc_html__('Check this box to enable page thumbnail on single page.', 'bike-rental-shop'),
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_single_page_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_single_page_setting', array(
        'section'     => 'bike_rental_single_page_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
        'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
        'priority'    => 100
    )));

    //Header
    $wp_customize->add_section('bike_rental_shop_header',array(
        'title' => esc_html__('Header Option','bike-rental-shop')
    ));

    $wp_customize->add_setting('bike_rental_shop_phone',array(
        'default' => '',
        'sanitize_callback' => 'bike_rental_shop_sanitize_phone_number'
    ));
    $wp_customize->add_control('bike_rental_shop_phone',array(
        'label' => esc_html__('Phone Number','bike-rental-shop'),
        'section' => 'bike_rental_shop_header',
        'setting' => 'bike_rental_shop_phone',
        'type'  => 'text'
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
                'section'     => 'bike_rental_shop_header',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

    // Social Link
    $wp_customize->add_section('bike_rental_shop_social_link',array(
        'title' => esc_html__('Social Links','bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('bike_rental_shop_facebook_url',array(
        'label' => esc_html__('Facebook Link','bike-rental-shop'),
        'section' => 'bike_rental_shop_social_link',
        'setting' => 'bike_rental_shop_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('bike_rental_shop_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('bike_rental_shop_twitter_url',array(
        'label' => esc_html__('Twitter Link','bike-rental-shop'),
        'section' => 'bike_rental_shop_social_link',
        'setting' => 'bike_rental_shop_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('bike_rental_shop_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('bike_rental_shop_intagram_url',array(
        'label' => esc_html__('Intagram Link','bike-rental-shop'),
        'section' => 'bike_rental_shop_social_link',
        'setting' => 'bike_rental_shop_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('bike_rental_shop_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('bike_rental_shop_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','bike-rental-shop'),
        'section' => 'bike_rental_shop_social_link',
        'setting' => 'bike_rental_shop_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('bike_rental_shop_youtube_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('bike_rental_shop_youtube_url',array(
        'label' => esc_html__('YouTube Link','bike-rental-shop'),
        'section' => 'bike_rental_shop_social_link',
        'setting' => 'bike_rental_shop_pintrest_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
                'section'     => 'bike_rental_shop_social_link',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

    // Slider
    $wp_customize->add_section('bike_rental_shop_top_slider',array(
        'title' => esc_html__('Slider Option','bike-rental-shop')
    ));

    for ( $count = 1; $count <= 3; $count++ ) {
        $wp_customize->add_setting( 'bike_rental_shop_top_slider_page' . $count, array(
            'default'           => '',
            'sanitize_callback' => 'bike_rental_shop_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'bike_rental_shop_top_slider_page' . $count, array(
            'label'    => __( 'Select Slide Page', 'bike-rental-shop' ),
            'section'  => 'bike_rental_shop_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Slider Image Opacity
    $wp_customize->add_setting('bike_rental_shop_slider_opacity_color',array(
      'default' => '',
      'sanitize_callback' => 'bike_rental_shop_sanitize_choices'
    ));

    $wp_customize->add_control( 'bike_rental_shop_slider_opacity_color', array(
    'label'       => esc_html__( 'Slider Image Opacity','bike-rental-shop' ),
    'section'     => 'bike_rental_shop_top_slider',
    'type'        => 'select',
    'choices' => array(
      '0' =>  esc_attr('0','bike-rental-shop'),
      '0.1' =>  esc_attr('0.1','bike-rental-shop'),
      '0.2' =>  esc_attr('0.2','bike-rental-shop'),
      '0.3' =>  esc_attr('0.3','bike-rental-shop'),
      '0.4' =>  esc_attr('0.4','bike-rental-shop'),
      '0.5' =>  esc_attr('0.5','bike-rental-shop'),
      '0.6' =>  esc_attr('0.6','bike-rental-shop'),
      '0.7' =>  esc_attr('0.7','bike-rental-shop'),
      '0.8' =>  esc_attr('0.8','bike-rental-shop'),
      '0.9' =>  esc_attr('0.9','bike-rental-shop')
    ),
    ));

    //Slider height
    $wp_customize->add_setting('bike_rental_shop_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('bike_rental_shop_slider_img_height',array(
        'label' => __('Slider Height','bike-rental-shop'),
        'description'   => __('Add the slider height in px(eg. 500px).','bike-rental-shop'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'bike-rental-shop' ),
        ),
        'section'=> 'bike_rental_shop_top_slider',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
                'section'     => 'bike_rental_shop_top_slider',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

    // Slider Product
    $wp_customize->add_section('bike_rental_shop_slider_product',array(
        'title' => esc_html__('Slider Porduct Option','bike-rental-shop')
    ));

    $wp_customize->add_setting('bike_rental_shop_new_product_number',array(
        'default' => '',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('bike_rental_shop_new_product_number',array(
        'label' => esc_html__('No of Product','bike-rental-shop'),
        'section' => 'bike_rental_shop_slider_product',
        'setting' => 'bike_rental_shop_new_product_number',
        'type'  => 'number'
    ));

    $bike_rental_shop_args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $bike_rental_shop_args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('bike_rental_shop_new_product_category',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_select',
    ));
    $wp_customize->add_control('bike_rental_shop_new_product_category',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','bike-rental-shop'),
        'section' => 'bike_rental_shop_slider_product',
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_product_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_slider_product_setting', array(
                'section'     => 'bike_rental_shop_slider_product',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

    // Recent Product
    $wp_customize->add_section('bike_rental_shop_recent_product',array(
        'title' => esc_html__('Recent Product Option','bike-rental-shop')
    ));

    $wp_customize->add_setting('bike_rental_shop_recent_product_number',array(
        'default' => '',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('bike_rental_shop_recent_product_number',array(
        'label' => esc_html__('No of Product','bike-rental-shop'),
        'section' => 'bike_rental_shop_recent_product',
        'setting' => 'bike_rental_shop_recent_product_number',
        'type'  => 'number'
    ));

    $bike_rental_shop_args = array(
        'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $bike_rental_shop_args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('bike_rental_shop_recent_product_category',array(
        'sanitize_callback' => 'bike_rental_shop_sanitize_select',
    ));
    $wp_customize->add_control('bike_rental_shop_recent_product_category',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','bike-rental-shop'),
        'section' => 'bike_rental_shop_recent_product',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_recent_product_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_recent_product_setting', array(
                'section'     => 'bike_rental_shop_recent_product',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('bike_rental_shop_site_footer_section', array(
        'title' => esc_html__('Footer', 'bike-rental-shop'),
    ));

    $wp_customize->add_setting('bike_rental_shop_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'bike_rental_shop_footer_bg_image',array(
        'label' => __('Footer Background Image','bike-rental-shop'),
        'section' => 'bike_rental_shop_site_footer_section',
        'priority' => 1,
    )));

    $wp_customize->add_setting('bike_rental_shop_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('bike_rental_shop_footer_text_setting', array(
        'label' => __('Replace the footer text', 'bike-rental-shop'),
        'section' => 'bike_rental_shop_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

    $wp_customize->add_setting('bike_rental_shop_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'bike_rental_shop_sanitize_checkbox'
    ));
    $wp_customize->add_control('bike_rental_shop_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','bike-rental-shop'),
        'section' => 'bike_rental_shop_site_footer_section',
    ));

    $wp_customize->add_setting('bike_rental_shop_copyright_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bike_rental_shop_copyright_background_color', array(
        'label'    => __('Copyright Background Color', 'bike-rental-shop'),
        'section'  => 'bike_rental_shop_site_footer_section',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Bike_Rental_Shop_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Bike_Rental_Shop_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
                'section'     => 'bike_rental_shop_site_footer_section',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'bike-rental-shop' ),
                'description' => esc_url( BIKE_RENTAL_SHOP_URL ),
                'priority'    => 100
    )));

}
add_action('customize_register', 'bike_rental_shop_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function bike_rental_shop_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function bike_rental_shop_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function bike_rental_shop_customize_preview_js(){
    wp_enqueue_script('bike-rental-shop-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'bike_rental_shop_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function bike_rental_shop_panels_js() {
    wp_enqueue_style( 'bike-rental-shop-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'bike-rental-shop-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'bike_rental_shop_panels_js' );
