<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Cream_Blog
 */

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function viable_blog_woocommerce_loop_columns() {
	$sidebar_position = get_theme_mod( 'viable_blog_woocommerce_sidebar_position', 'right' );
	if( $sidebar_position != 'none' && is_active_sidebar( 'woocommerce-sidebar' ) ) {
		return 3;
	} else {
		return 4;
	}
}
add_filter( 'loop_shop_columns', 'viable_blog_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function viable_blog_woocommerce_related_products_args( $args ) {
	$columns = '';
	$sidebar_position = get_theme_mod( 'viable_blog_woocommerce_sidebar_position', 'right' );
	if( $sidebar_position != 'none' && is_active_sidebar( 'woocommerce-sidebar' ) ) {
		$columns = 3;
		$posts_per_page = 3;
	} else {
		$posts_per_page = 4;
		$columns = 4;
	}
	$defaults = array(
		'posts_per_page' => $posts_per_page,
		'columns'        => $columns,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'viable_blog_woocommerce_related_products_args' );

if ( ! function_exists( 'viable_blog_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function viable_blog_woocommerce_product_columns_wrapper() {
		$columns = viable_blog_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'viable_blog_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'viable_blog_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function viable_blog_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'viable_blog_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

if ( ! function_exists( 'viable_blog_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function viable_blog_woocommerce_wrapper_before() {
		?>
		<div class="vb_container">
	        <div class="mid_portion_wrap standard_page_mid_wrap">
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
	            	$sidebar_position = get_theme_mod( 'viable_blog_woocommerce_sidebar_position', 'right' );
					if( $sidebar_position == 'left' && is_active_sidebar( 'woocommerce-sidebar' ) ) {
						viable_blog_get_woocommerce_sidebar();
					}
	            	?>
	                <div class="<?php echo esc_attr( $container_class ); ?>">
	                    <div id="primary" class="content-area">
	                        <main id="main" class="site-main">
                            	<?php
	}
}
add_action( 'woocommerce_before_main_content', 'viable_blog_woocommerce_wrapper_before', 20 );

if ( ! function_exists( 'viable_blog_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function viable_blog_woocommerce_wrapper_after() {
								?>
	                        </main><!-- #main.site-main -->
	                    </div><!-- #primary.content-area -->
	                </div>
	                <?php
	                $sidebar_position = get_theme_mod( 'viable_blog_woocommerce_sidebar_position', 'right' );
					if( $sidebar_position == 'right' && is_active_sidebar( 'woocommerce-sidebar' ) ) {
						viable_blog_get_woocommerce_sidebar();
					}
					?>
	            </div><!-- .row -->
	        </div><!-- .mid_portion_wrap.standard_page_mid_wrap -->
	    </div><!-- .vb_container -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'viable_blog_woocommerce_wrapper_after', 20 );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'viable_blog_woocommerce_header_cart' ) ) {
			viable_blog_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'viable_blog_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function viable_blog_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		viable_blog_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'viable_blog_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'viable_blog_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function viable_blog_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'viable-blog' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'viable-blog' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'viable_blog_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function viable_blog_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php viable_blog_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}