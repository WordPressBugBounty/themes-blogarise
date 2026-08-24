<?php
/**
 * Blogarise Theme Customizer
 *
 * @package Blogarise
 */

if (!function_exists('blogarise_get_option')):
/**
 * Get theme option.
 *
 * @since 1.0.0
 *
 * @param string $key Option key.
 * @return mixed Option value.
 */
function blogarise_get_option($key) {

	if (empty($key)) {
		return;
	}

	$value = '';

	$default       = blogarise_get_default_theme_options();
	$default_value = null;

	if (is_array($default) && isset($default[$key])) {
		$default_value = $default[$key];
	}

	if (null !== $default_value) {
		$value = get_theme_mod($key, $default_value);
	} else {
		$value = get_theme_mod($key);
	}

	return $value;
}
endif;


function banner_slider_option($control) {
    $banner_slider_option = $control->manager->get_setting('banner_options_main')->value();
    if($banner_slider_option == 'banner_slider_section_option'){
        return true;
    } else{
        return false;
    }
}

function banner_slider_category_function($control){
    $no_option = $control->manager->get_setting('banner_options_main')->value();
    $banner_slider_category_option = $control->manager->get_setting('banner_slider_section_option')->value();
    if ($banner_slider_category_option == 'banner_slider_category_option' && $no_option == 'banner_slider_section_option') {
        return true;
    } else { return false;}
}

function header_video_act_call($control){
    $video_banner_section = $control->manager->get_setting('banner_options_main')->value();

    if($video_banner_section == 'header_video'){
        return true;
    } else {
        return false;
    }
}

function video_banner_section_function($control){
    $video_banner_section = $control->manager->get_setting('banner_options_main')->value();

    if($video_banner_section == 'video_banner_section'){
        return true;
    } else {
        return false;
    }
}

function slider_callback($control){
    $banner_slider_option = $control->manager->get_setting('banner_options_main')->value();
    $banner_slider_section_option = $control->manager->get_setting('banner_slider_section_option')->value();
    if ($banner_slider_option == 'banner_slider_section_option' && $banner_slider_section_option == 'latest_post_show') {
        return true;
    } else {
        return false;
    }
}

function overlay_text($control){
    $banner_slider_option = $control->manager->get_setting('banner_options_main')->value();
    if($banner_slider_option == 'header_video' || $banner_slider_option == 'video_banner_section'){
        return true;
    } else {
       return false;
    }
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Blogarise_Customize_register($wp_customize) {


    $wp_customize->get_setting( 'custom_logo')->sanitize_callback  	= 'esc_url_raw';
    $wp_customize->get_setting( 'custom_logo')->transport  			= 'postMessage';
	$wp_customize->get_setting('blogname')->transport               = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport        = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport       = 'postMessage';

    // use get control
    $wp_customize->get_control( 'header_textcolor')->label      = __( 'Site Info Color', 'blogarise' );
    $wp_customize->get_control( 'header_textcolor')->section    = 'colors';   
    $wp_customize->get_control( 'header_textcolor')->priority   = 1;   
    $wp_customize->get_control( 'header_textcolor')->default    = '#000';
    $wp_customize->get_setting('background_color')->transport   = 'refresh';


    $default = blogarise_get_default_theme_options();
}
add_action('customize_register', 'Blogarise_Customize_register');


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Blogarise_Customize_preview_js() {
	wp_enqueue_script('blogarise-customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20151215', true);

    // Pass the PHP variable to the JavaScript file
    wp_localize_script( 'blogarise-customizer', 'php_obj', array(
        'current_theme' => get_stylesheet(),
    ) );
}
add_action('customize_preview_init', 'Blogarise_Customize_preview_js');


/************************* Related Post Callback function *********************************/

    function blogarise_rt_post_callback ( $control ) {
        if( true == $control->manager->get_setting ('blogarise_enable_related_post')->value()){
            return true;
        }
        else {
            return false;
        }       
    }

/************************* Theme Customizer with Sanitize function *********************************/
function blogarise_theme_option( $wp_customize ) {

    function blogarise_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    $blogarise_default = blogarise_get_default_theme_options();

    $wp_customize->add_setting('side_main_logo_width', array(
        'default' => $blogarise_default['side_main_logo_width'],
        'transport'         => 'postMessage',
        'sanitize_callback' => 'blogarise_sanitize_range',
    ));
    $wp_customize->add_control(new Blogarise_Range_Control( $wp_customize, 'side_main_logo_width', array(
        'label'       => esc_html__('Logo Width', 'blogarise'),
        'section'     => 'title_tagline',
        'media_query' => true,
        'size_unit'   => array( 'px', '%', 'em', 'rem' ),
        'input_attr'  => array('min'  => 0,'max'  => 400,'step' => 1,),
        'priority' => 9,
    )));
    
    $wp_customize->get_control( 'display_header_text')->label = __('Display Site Title', 'blogarise');

    $wp_customize->add_setting('display_header_tagline',
        array(
            'default' => false,
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogarise_sanitize_checkbox',
        )
    );
    $wp_customize->add_control('display_header_tagline',
        array(
            'label' => __('Display Tagline', 'blogarise'),
            'section' => 'title_tagline',
            'type' => 'checkbox',
            'priority' => 50,

        )
    );
    /*--- Site title Font size **/
    $wp_customize->add_setting('blogarise_title_font_size',
        array(
            'default'           => 60,
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'absint'
        )
    );

    $wp_customize->add_control('blogarise_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'blogarise'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );

    $wp_customize->add_setting('blogarise_center_logo_title',
        array(
            'default' => false,
            'transport' => 'postMessage',
            'sanitize_callback' => 'blogarise_sanitize_checkbox',
        )
    );
    $wp_customize->add_control('blogarise_center_logo_title',
        array(
            'label' => esc_html__('Display Center Site Title and Tagline', 'blogarise'),
            'section' => 'title_tagline',
            'type' => 'checkbox',
            'priority' => 55,
        )
    );

    $wp_customize->add_setting('header_textcolor_dark_layout',
        array(
            'default' => '#fff',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'blogarise_sanitize_alpha_color',
        )
    );
    $wp_customize->add_control('header_textcolor_dark_layout',
        array(
            'label' => esc_html__('Site Title/Tagline Color (Dark Mode)', 'blogarise'),
            'section' => 'colors',
            'type' => 'color',
            'priority' => 2,
        )
    );

    $wp_customize->add_setting('blogarise_skin_mode_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Blogarise_Section_Title(
            $wp_customize,
            'blogarise_skin_mode_title',
            array(
                'label' => esc_html__('Theme Layout', 'blogarise'),
                'section' => 'colors',
                'priority' => 10,

            )
        )
    );

    $wp_customize->add_setting(
        'blogarise_skin_mode', array(
        'default'           => 'defaultcolor',
        'sanitize_callback' => 'blogarise_sanitize_radio'
    ) );
    $wp_customize->add_control(
        new Blogarise_Custom_Radio_Default_Image_Control( 
            // $wp_customize object
            $wp_customize,
            // $id
            'blogarise_skin_mode',
            // $args
            array(
                'settings'      => 'blogarise_skin_mode',
                'section'       => 'colors',
                'priority' => 20,
                'choices'       => array(
                    'defaultcolor'    => get_template_directory_uri() . '/images/color/white.png',
                    'dark' => get_template_directory_uri() . '/images/color/black.png',
                )
            )
        )
    );

    $wp_customize->add_setting('blogarise_primary_menu_color',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control(
        new Blogarise_Section_Title(
            $wp_customize,
            'blogarise_primary_menu_color',
            array(
                'label' => esc_html__('Primary Menu Color', 'blogarise'),
                'section' => 'colors',
                'priority' => 30,

            )
        )
    );

    $wp_customize->add_setting('primary_menu_bg_color',
        array(
            'default' => '',
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'blogarise_sanitize_alpha_color',
        )
    );
    $wp_customize->add_control('primary_menu_bg_color',
    array(
        'label' => esc_html__('Background Color', 'blogarise'),
        'section' => 'colors',
        'type' => 'color',
        'priority' => 40,
    ));

}
add_action('customize_register','blogarise_theme_option');