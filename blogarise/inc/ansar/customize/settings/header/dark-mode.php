<?php
$blogarise_default = blogarise_get_default_theme_options();
$wp_customize->add_setting('blogarise_dark_mode_setting',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new blogarise_Section_Title(
        $wp_customize,
        'blogarise_dark_mode_setting',
        array(
            'label' => __('Dark and Light Mode Switcher', 'blogarise'),
            'section' => 'header_dark_mode_section',

        )
    )
);

$wp_customize->add_setting('blogarise_lite_dark_switcher',
    array(
        'default' => true,
        'sanitize_callback' => 'blogarise_sanitize_checkbox',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(new Blogarise_Toggle_Control( $wp_customize, 'blogarise_lite_dark_switcher', 
    array(
        'label' => esc_html__('Hide/Show', 'blogarise'),
        'type' => 'toggle',
        'section' => 'menu_options',
    )
));