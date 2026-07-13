<?php
if( ! function_exists( 'blogarise_register_custom_controls' ) ) :
/**
 * Register Custom Controls
*/
function blogarise_register_custom_controls( $wp_customize ) {
    $blogarise_control_path = get_template_directory() . '/inc/ansar/custom-control/';

    require_once $blogarise_control_path . 'toggle/class-toggle-control.php';
    require_once $blogarise_control_path . 'customizer-alpha-color-picker/class-blogarise-customize-alpha-color-control.php';

    require_once  $blogarise_control_path . 'custom_tab_control/custom_tab_control_class.php';
    require_once  $blogarise_control_path . 'range/class-range.php';

    $wp_customize->register_control_type( 'Blogarise_Range_Control' );

    $wp_customize->register_control_type( 'Blogarise_Toggle_Control' );

}
endif;
add_action( 'customize_register', 'blogarise_register_custom_controls' );