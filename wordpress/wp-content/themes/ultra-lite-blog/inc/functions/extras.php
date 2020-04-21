<?php
/**
 * Extra Functions
 *
 * @package ultra-lite-blog
 */

/**
 * Funtion To Get Google Fonts
 */
if ( !function_exists( 'ultra_lite_blog_fonts_url' ) ) :

    /**
     * Return Font's URL.
     *
     * @since 1.0.0
     * @return string Fonts URL.
     */
    function ultra_lite_blog_fonts_url()
    {

        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

        if ('off' !== _x('on', 'Poppins font: on or off', 'ultra-lite-blog')) {
            $fonts[] = 'Poppins:400,400i,500,500i,600,600i,700,700i';
        }
        
        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */

        if ('off' !== _x('on', 'Crimson Text font: on or off', 'ultra-lite-blog')) {
            $fonts[] = 'Crimson Text:400,600,600i,700';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), '//fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;
