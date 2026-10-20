<?php
/*--------------------------------------------------------------------*/
/*     Register Google Fonts
/*--------------------------------------------------------------------*/

function blogarise_fonts_url() {

    $fonts = array(
        'Outfit' => array('400','500','600','700','800'),
        'Rubik'        => array('300','400','500','600'),
    );

    $title_font   = get_theme_mod( 'site_title_fontfamily', '' );
    $title_weight = get_theme_mod( 'site_title_fontweight', '400' );
    $menu_font    = get_theme_mod( 'blogarise_menu_fontfamily', '' );

    foreach ( array( $title_font => $title_weight, $menu_font => '400' ) as $font => $weight ) {
        $font = trim( explode( ',', $font )[0] );

        if ( $font ) {
            $fonts[ $font ][] = $weight;
        }
    }

    $families = array();

    foreach ( $fonts as $font => $weights ) {
        $families[] = 'family=' . rawurlencode(
            $font . ':wght@' . implode( ';', array_unique( $weights ) )
        );
    }

    return 'https://fonts.googleapis.com/css2?' . implode( '&', $families ) . '&display=swap';
}

function blogarise_scripts_styles() {
    wp_enqueue_style( 'blogarise-fonts', blogarise_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'blogarise_scripts_styles' );