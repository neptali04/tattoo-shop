<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Viable_Blog
 */

get_header();
?>
	<div class="vb_container">
        <div class="mid_portion_wrap post_page_mid_wrap">
            <?php 
                /**
                 * Hook - viable_blog_breadcrumb.
                 *
                 * @hooked viable_blog_breadcrumb_action - 1
                 */
                do_action( 'viable_blog_breadcrumb' );
            ?>
            <div class="row">
            	<?php
            	$container_class = viable_blog_post_page_container_class();

                $sidebar_position = get_theme_mod( 'viable_blog_global_sidebar_position', 'right' );
                if( $sidebar_position === 'left' && is_active_sidebar( 'sidebar' )) {
                    get_sidebar();
                }
            	?>
                <div class="<?php echo esc_attr( $container_class ); ?>">
                    <div id="primary" class="content-area">
                        <main id="main" class="site-main">
                            <?php
							while ( have_posts() ) :

								the_post();

								get_template_part( 'template-parts/content', 'single' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
							?>
                        </main><!-- .site-main -->
                    </div><!-- #primary.content-area -->
                </div>
                <?php
                $sidebar_position = get_theme_mod( 'viable_blog_global_sidebar_position', 'right' );
                if( $sidebar_position === 'right' && is_active_sidebar( 'sidebar' )) {
                    get_sidebar();
                }
                ?>
            </div><!-- .row -->
        </div><!-- .mid_portion_wrap.post_page_mid_wrap -->
    </div><!-- .vb_container -->
<?php
get_footer();
