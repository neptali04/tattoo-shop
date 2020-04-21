<?php
/**
 * Ultra Blog theme functions.
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since	1.0.0
 * @package ultra-lite-blog
 */

// Exit if accessed directly.


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'ultra_lite_blog_enqueue_styles' ) ) {
	/**
	 * Enqueue Styles.
	 *
	 * Enqueue parent style and child styles where parent are the dependency
	 * for child styles so that parent styles always get enqueued first.
	 *
	 * @since 1.0.0
	 */

	function ultra_lite_blog_enqueue_styles() {

		// Enqueue Parent theme's stylesheet.

		wp_enqueue_style( 'ultra-lite-blog-parent-style', get_template_directory_uri() . '/style.css' );
		
		wp_enqueue_style( 'ultra-lite-blog-parent-main', get_template_directory_uri() . '/assets/dist/css/main.css' );

		wp_enqueue_style( 'ultra-lite-blog-child-main', get_stylesheet_directory_uri() . '/assets/dist/css/main.css' );
        
        wp_enqueue_style( 'ultra-lite-blog-child-fonts', ultra_lite_blog_fonts_url() );
        
        wp_enqueue_script( 'ultra-lite-blog-child-main', get_stylesheet_directory_uri() . '/assets/dist/js/bundle.min.js', array( 'jquery' ), '1.0.0', true );
		
	}
}

// Add enqueue function to the desired action.

add_action( 'wp_enqueue_scripts', 'ultra_lite_blog_enqueue_styles', 20 );

if( ! function_exists( 'ultra_lite_blog_setup' ) ) {
    
    function ultra_lite_blog_setup() {
        
        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        
        add_theme_support( 'post-thumbnails' );
        add_image_size( 'ultra-lite-blog-thubmnail-4', 1140, 500, true ); //Banner Three
        
        // This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'header-menu' => esc_html__( 'Top Header Menu', 'ultra-lite-blog' ),
		) );
        
    }
}

add_action( 'after_setup_theme', 'ultra_lite_blog_setup' );

if( !function_exists( 'ultra_lite_blog_header_menu_action' ) ) {
	/**
     * Hook - Header Menu
     *
     * @since 1.0.0
     */
	function ultra_lite_blog_header_menu_action() {
		if( has_nav_menu( 'header-menu' ) ) :
			?>
			<div class="col nav_col">
				<div class="secondary_nav">
		            <?php
		            	wp_nav_menu( array( 
		        			'theme_location' 	=> 'header-menu',
		        			'container'			=> '',
                            'depth'             => 1,
		        		 ) );
		            ?>
		        </div><!-- .secondary_nav -->
		    </div><!-- .col.nav_col -->
			<?php
		endif;
	}
}
add_action( 'ultra_lite_blog_header_menu', 'ultra_lite_blog_header_menu_action', 1 );

function ultra_lite_blog_read_time() {
    
    $post_id = get_the_ID();
    $post_object = get_post( $post_id );
    $content = $post_object->post_content;
    $word_count = str_word_count( strip_tags( $content ) );
    
    $per_min_words = absint( 240 );
    $total_time = round( ($word_count)/($per_min_words) );
    
    if( $total_time > 1 ) {
        $time_unit = 'minutes';
    } else {
        $time_unit = 'minute';
    }
    /* translators: 1: Total Time 2: Time Unit */
    printf( esc_html__( 'Read Time: %1$s %2$s', 'ultra-lite-blog' ), $total_time, $time_unit );
    
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ultra_lite_blog_customize_register( $wp_customize ) {

    // Option - Enable Child Header
    $wp_customize->add_setting( 'ultra_lite_blog_enable_child_header', array(
        'sanitize_callback'	=> 'viable_blog_sanitize_checkbox',
        'default'			=> 1,
    ) );

    $wp_customize->add_control( 'ultra_lite_blog_enable_child_header', array(
        'label'				=> esc_html__( 'Enable Child Header', 'ultra-lite-blog' ),
        'description'       => esc_html__( 'On enabling this option, header of parent theme will not be shown.', 'ultra-lite-blog' ),
        'section'			=> 'viable_blog_header_options',
        'type'				=> 'checkbox',
    ) );
    
    // Option - Enable Child Banner
    $wp_customize->add_setting( 'ultra_lite_blog_enable_child_banner', array(
        'sanitize_callback'	=> 'viable_blog_sanitize_checkbox',
        'default'			=> 1,
    ) );

    $wp_customize->add_control( 'ultra_lite_blog_enable_child_banner', array(
        'label'				=> esc_html__( 'Enable Child Banner', 'ultra-lite-blog' ),
        'description'       => esc_html__( 'On enabling this option, banner of parent theme will not be shown.', 'ultra-lite-blog' ),
        'section'			=> 'viable_blog_banner_options',
        'type'				=> 'checkbox',
        'active_callback'   => 'ultra_lite_blog_is_banner_active',
    ) );
    
}
add_action( 'customize_register', 'ultra_lite_blog_customize_register', 20 );

/**
 * Active callback function for child banner
 */
if( ! function_exists( 'ultra_lite_blog_is_banner_active' ) ) {

    function ultra_lite_blog_is_banner_active( $control ) {

        if( $control->manager->get_setting( 'viable_blog_enable_banner' )->value() == 1 ) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Load Template functions
 */
require get_stylesheet_directory() . '/inc/functions/template-functions.php';

/**
 * Load Extras
 */
require get_stylesheet_directory() . '/inc/functions/extras.php';