<?php
/**
 * Bike Rental Shop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bike Rental Shop
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Bike_Rental_Shop_Loader.php' );

$Bike_Rental_Shop_Loader = new \WPTRT\Autoload\Bike_Rental_Shop_Loader();

$Bike_Rental_Shop_Loader->bike_rental_shop_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Bike_Rental_Shop_Loader->bike_rental_shop_register();

if ( ! function_exists( 'bike_rental_shop_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bike_rental_shop_setup() {

		load_theme_textdomain( 'bike-rental-shop', get_template_directory() . '/languages' );
		
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        add_image_size('bike-rental-shop-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','bike-rental-shop' ),
	        'footer'=> esc_html__( 'Footer Menu','bike-rental-shop' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'bike_rental_shop_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_bike_rental_shop_dismissable_notice', 'bike_rental_shop_dismissable_notice');
	}
endif;
add_action( 'after_setup_theme', 'bike_rental_shop_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bike_rental_shop_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bike_rental_shop_content_width', 1170 );
}
add_action( 'after_setup_theme', 'bike_rental_shop_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bike_rental_shop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'bike-rental-shop' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'bike-rental-shop' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Shop Page Sidebar', 'bike-rental-shop' ),
		'id'            => 'woocommerce-shop-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Single Product Page Sidebar', 'bike-rental-shop' ),
		'id'            => 'woocommerce-single-product-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'bike-rental-shop' ),
		'id'            => 'bike-rental-shop-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'bike-rental-shop' ),
		'id'            => 'bike-rental-shop-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'bike-rental-shop' ),
		'id'            => 'bike-rental-shop-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'bike_rental_shop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bike_rental_shop_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'noto',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'bike-rental-shop-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'bike-rental-shop-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'bike-rental-shop-style',$bike_rental_shop_theme_css );

	wp_style_add_data('bike-rental-shop-basic-style', 'rtl', 'replace');

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('bike-rental-shop-theme-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bike_rental_shop_scripts' );

/**
 * Enqueue theme color style.
 */
function bike_rental_shopg_theme_color() {

    $bike_rental_shopg_theme_color_css = '';
    $bike_rental_shopg_preloader_bg_color = get_theme_mod('bike_rental_shopg_preloader_bg_color');
    $bike_rental_shopg_preloader_dot_1_color = get_theme_mod('bike_rental_shopg_preloader_dot_1_color');
    $bike_rental_shopg_preloader_dot_2_color = get_theme_mod('bike_rental_shopg_preloader_dot_2_color');
    $bike_rental_shop_logo_max_height = get_theme_mod('bike_rental_shop_logo_max_height');

  	if(get_theme_mod('bike_rental_shop_logo_max_height') == '') {
		$bike_rental_shop_logo_max_height = '24';
	}

    if(get_theme_mod('bike_rental_shopg_preloader_bg_color') == '') {
			$bike_rental_shopg_preloader_bg_color = '#fff';
	}
	if(get_theme_mod('bike_rental_shopg_preloader_dot_1_color') == '') {
		$bike_rental_shopg_preloader_dot_1_color = '#ff7111';
	}
	if(get_theme_mod('bike_rental_shopg_preloader_dot_2_color') == '') {
		$bike_rental_shopg_preloader_dot_2_color = '#18191e';
	}

	$bike_rental_shopg_theme_color_css = '
		.custom-logo-link img{
			max-height: '.esc_attr($bike_rental_shop_logo_max_height).'px;
	 	}
		.loading{
			background-color: '.esc_attr($bike_rental_shopg_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($bike_rental_shopg_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($bike_rental_shopg_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'bike-rental-shop-style',$bike_rental_shopg_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'bike_rental_shopg_theme_color' );

/**
 * Enqueue S Header.
 */
function bike_rental_shop_sticky_header() {

  $bike_rental_shop_sticky_header = get_theme_mod('bike_rental_shop_sticky_header');

  $bike_rental_shop_custom_style= "";

  if($bike_rental_shop_sticky_header != true){

    $bike_rental_shop_custom_style .='.stick_header{';

      $bike_rental_shop_custom_style .='position: static;';

    $bike_rental_shop_custom_style .='}';
  }

  wp_add_inline_style( 'bike-rental-shop-style',$bike_rental_shop_custom_style );

}
add_action( 'wp_enqueue_scripts', 'bike_rental_shop_sticky_header' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/*dropdown page sanitization*/
function bike_rental_shop_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

//SELECT
function bike_rental_shop_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

function bike_rental_shop_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

//Float
function bike_rental_shop_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

/*radio button sanitization*/
function bike_rental_shop_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function bike_rental_shop_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function bike_rental_shop_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

if (!function_exists('bike_rental_shop_loop_columns')) {
		function bike_rental_shop_loop_columns() {
		return 3;
	}
}
add_filter('loop_shop_columns', 'bike_rental_shop_loop_columns');

function bike_rental_shop_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'bike_rental_shop_shop_per_page', 9 );
function bike_rental_shop_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'bike_rental_shop_product_per_page', 9 );
	return $cols;
}

/**
 * Get CSS
 */

function bike_rental_shop_getpage_css($hook) {
	wp_enqueue_script( 'bike-rental-shop-admin-script', get_template_directory_uri() . '/inc/admin/js/bike-rental-shop-admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script( 'bike-rental-shop-admin-script', 'bike_rental_shop_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_bike-rental-shop-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'bike-rental-shop-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'bike_rental_shop_getpage_css' );

if ( ! defined( 'BIKE_RENTAL_SHOP_CONTACT_SUPPORT' ) ) {
define('BIKE_RENTAL_SHOP_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/bike-rental-shop','bike-rental-shop'));
}
if ( ! defined( 'BIKE_RENTAL_SHOP_REVIEW' ) ) {
define('BIKE_RENTAL_SHOP_REVIEW',__('https://wordpress.org/support/theme/bike-rental-shop/reviews/#new-post','bike-rental-shop'));
}
if ( ! defined( 'BIKE_RENTAL_SHOP_LIVE_DEMO' ) ) {
define('BIKE_RENTAL_SHOP_LIVE_DEMO',__('https://www.themagnifico.net/demo/bike-rental-shop/','bike-rental-shop'));
}
if ( ! defined( 'BIKE_RENTAL_SHOP_GET_PREMIUM_PRO' ) ) {
define('BIKE_RENTAL_SHOP_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/bike-rental-wordpress-theme/','bike-rental-shop'));
}
if ( ! defined( 'BIKE_RENTAL_SHOP_PRO_DOC' ) ) {
define('BIKE_RENTAL_SHOP_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/bike-rental-shop-pro-doc/','bike-rental-shop'));
}
if ( ! defined( 'BIKE_RENTAL_SHOP_FREE_DOC' ) ) {
define('BIKE_RENTAL_SHOP_FREE_DOC',__('https://themagnifico.net/eard/wathiqa/bike-rental-shop-free-doc/','bike-rental-shop'));
}

add_action('admin_menu', 'bike_rental_shop_themepage');
function bike_rental_shop_themepage(){

	$bike_rental_shop_theme_test = wp_get_theme();

	$bike_rental_shop_theme_info = add_theme_page( __('Theme Options','bike-rental-shop'), __('Theme Options','bike-rental-shop'), 'manage_options', 'bike-rental-shop-info.php', 'bike_rental_shop_info_page' );
}

function bike_rental_shop_info_page() {
	$bike_rental_shop_user = wp_get_current_user();
	$bike_rental_shop_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap bike-rental-shop-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','bike-rental-shop'); ?><?php echo esc_html( $bike_rental_shop_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "bike-rental-shop"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Bike Rental Shop , feel free to contact us for any support regarding our theme.", "bike-rental-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "bike-rental-shop"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "bike-rental-shop"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "bike-rental-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
							<?php esc_html_e("Get Premium", "bike-rental-shop"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "bike-rental-shop"); ?></h3>
						<p><?php esc_html_e("If You love Bike Rental Shop theme then we would appreciate your review about our theme.", "bike-rental-shop"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "bike-rental-shop"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","bike-rental-shop"); ?></h2>
		<div class="bike-rental-shop-button-container">
			<a target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "bike-rental-shop"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "bike-rental-shop"); ?>
			</a>
		</div>

		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "bike-rental-shop"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "bike-rental-shop"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "bike-rental-shop"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "bike-rental-shop"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "bike-rental-shop"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "bike-rental-shop"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "bike-rental-shop"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="bike-rental-shop-button-container">
			<a target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
				<?php esc_html_e("Go Premium", "bike-rental-shop"); ?>
			</a>
		</div>
	</div>
	<?php
}

//Admin Notice For Getstart
function bike_rental_shop_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function bike_rental_shop_deprecated_hook_admin_notice() {

    $dismissed = get_user_meta(get_current_user_id(), 'bike_rental_shop_dismissable_notice', true);
    if ( !$dismissed) { ?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'bike-rental-shop'); ?><?php echo wp_get_theme(); ?><h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php _e('Get Started With Theme By Clicking On Getting Started.', 'bike-rental-shop'); ?><p>
	        	<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=bike-rental-shop-info.php' )); ?>"><?php esc_html_e( 'Get started', 'bike-rental-shop' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero" target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_FREE_DOC ); ?>"><?php esc_html_e( 'Documentation', 'bike-rental-shop' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span class="dashicons dashicons-admin-links"></span>
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( BIKE_RENTAL_SHOP_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'bike-rental-shop' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'bike_rental_shop_deprecated_hook_admin_notice' );

function bike_rental_shop_switch_theme() {
    delete_user_meta(get_current_user_id(), 'bike_rental_shop_dismissable_notice');
}
add_action('after_switch_theme', 'bike_rental_shop_switch_theme');
function bike_rental_shop_dismissable_notice() {
    update_user_meta(get_current_user_id(), 'bike_rental_shop_dismissable_notice', true);
    die();
}