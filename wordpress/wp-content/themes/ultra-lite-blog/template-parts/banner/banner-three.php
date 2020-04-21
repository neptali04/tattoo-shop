<?php
/**
 * Template part for displaying banner one
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ultra-lite-blog
 */
$banner_query = viable_blog_banner_posts_query();
if( $banner_query->have_posts() ) :
    ?>
    <section class="vb_banner">
        <div class="vb_container">
            <div class="owl-carousel vb_banner_style_1">
                <?php while( $banner_query->have_posts() ) : $banner_query->the_post(); ?>
                <?php if( has_post_thumbnail() ) : ?>
                <div class="item">
                    <div class="card">
                        <div class="post_thumb">
                            <?php the_post_thumbnail( 'ultra-lite-blog-thubmnail-4', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) ); ?>
                            <div class="card_content">
                                <?php viable_blog_post_categories(); ?>
                                <div class="post_title">
                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                </div><!-- .title -->
                                <?php
                                $button_title = get_theme_mod( 'viable_blog_banner_button_title', '' );
                                if( !empty( $button_title ) ) {
                                    ?>
                                    <div class="the_permalink">
                                        <a class="btn_general" href="<?php the_permalink(); ?>"><?php echo esc_html( $button_title ); ?></a>
                                    </div><!-- .the_permalink -->
                                    <?php
                                }
                                ?>
                            </div><!-- .card_content -->
                            <div class="mask"></div><!-- .mask -->
                        </div><!-- .post_thumb -->
                    </div><!-- .card -->
                </div><!-- .item -->
                <?php endif; ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div><!-- .owl-carousel -->
        </div><!-- .vb_container -->
    </section><!-- .vb_banner -->
    <?php
endif;