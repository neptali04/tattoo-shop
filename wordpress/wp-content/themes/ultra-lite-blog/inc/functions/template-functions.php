<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ultra-lite-blog
 */

/**
 * Selects header template according to the customizer's header option
 */
if( !function_exists( 'ultra_lite_blog_header_template' ) ) {

	function ultra_lite_blog_header_template() {
        
        $enable_child_header = get_theme_mod( 'ultra_lite_blog_enable_child_header', 1 );
        
        if( $enable_child_header == 1 ) {
            
            get_template_part( 'template-parts/header/header', 'three' );
            
        } else {
            
            $header_layout = get_theme_mod( 'viable_blog_header_layout', 'header_one' );

            if( $header_layout == 'header_one' ) {
                get_template_part( 'template-parts/header/header', 'one' );
            }

            if( $header_layout == 'header_two' ) {
                get_template_part( 'template-parts/header/header', 'two' );
            } 
        }
	}
}

/**
 * Selects banner template according to the customizer's banner option
 */
if( !function_exists( 'ultra_lite_blog_banner_template' ) ) {

	function ultra_lite_blog_banner_template() {

		$enable_banner = get_theme_mod( 'viable_blog_enable_banner', 0 );
        
        $enable_child_banner = get_theme_mod( 'ultra_lite_blog_enable_child_banner', 1 );

		$banner_layout = get_theme_mod( 'viable_blog_banner_layout', 'banner_one' );

		if( $enable_banner == 1 ) {
            
            if( $enable_child_banner == 1 ) {
                
                get_template_part( 'template-parts/banner/banner', 'three' );
                
            } else {
                
                if( $banner_layout == 'banner_one' ) {
				    get_template_part( 'template-parts/banner/banner', 'one' );
                }

                if( $banner_layout == 'banner_two' ) {
                    get_template_part( 'template-parts/banner/banner', 'two' );
                }
            }
		}
	}
}