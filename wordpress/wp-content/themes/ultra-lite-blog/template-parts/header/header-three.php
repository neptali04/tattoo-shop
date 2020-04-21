<?php
/**
 * Template part for displaying header three
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ultra-lite-blog
 */
?>
<header id="mastheader" class="mastheader header_style3 <?php if( !empty( $header_style ) ) { echo esc_attr( $header_style ); } ?>">
    <div class="header_top">
        <div class="vb_container">
            <div class="header_top_entry">
                <div class="row">
                    <?php 
                    /**
                     * Hook - ultra_lite_blog_header_menu.
                     *
                     * @hooked ultra_lite_blog_header_menu_action - 1
                     */
                    do_action( 'ultra_lite_blog_header_menu' ); 

                    /**
                     * Hook - viable_blog_header_social_links.
                     *
                     * @hooked viable_blog_header_social_links_action - 1
                     */
                    do_action( 'viable_blog_header_social_links' ); 
                    ?>
                </div><!-- .row -->
            </div><!-- .header_top_entry -->
        </div><!-- .vb_container -->
    </div><!-- .header_top -->
    <div class="site_idty_wrap">
        <div class="vb_container">
           <?php 
            /**
             * Hook - viable_blog_logo.
             *
             * @hooked viable_blog_logo_action - 1
             */
            do_action( 'viable_blog_logo' ); 
            ?>
        </div><!-- .vb_container -->
    </div><!-- .site_idty_wrap -->
    <nav class="main_navigation">
        <div class="vb_container">
            <?php 
            /**
             * Hook - viable_blog_main_menu.
             *
             * @hooked viable_blog_main_menu_action - 1
             */
            do_action( 'viable_blog_main_menu' ); 
            ?>
            <?php 
            /**
             * Hook - viable_blog_menu_search.
             *
             * @hooked viable_blog_menu_search_action - 1
             */
            do_action( 'viable_blog_menu_search' ); 
            ?>
        </div><!-- .vb_container -->
    </nav><!-- .main_navigation -->
</header><!-- #mastheader.mastheader.header_style3 -->