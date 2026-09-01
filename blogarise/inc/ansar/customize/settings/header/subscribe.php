<?php

$blogarise_default = blogarise_get_default_theme_options();
$wp_customize->add_setting('blogarise_subscribe_icon_setting',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new blogarise_Section_Title(
        $wp_customize,
        'blogarise_subscribe_icon_setting',
        array(
            'label' => __('Subscribe Button', 'blogarise'),
            'section' => 'header_subscribe_section',
        )
    )
);
$wp_customize->add_setting('blogarise_menu_subscriber',
    array(
        'default' => true,
        'sanitize_callback' => 'blogarise_sanitize_checkbox',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(new Blogarise_Toggle_Control( $wp_customize, 'blogarise_menu_subscriber', 
    array(
        'label' => esc_html__('Hide/Show', 'blogarise'),
        'type' => 'toggle',
        'section' => 'header_subscribe_section',
    )
));

$wp_customize->add_setting('blogarise_subsc_link',
    array(
        'default' => '#',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control('blogarise_subsc_link',
    array(
        'label' => esc_html__('Button Link', 'blogarise'),
        'section' => 'header_subscribe_section',
        'type' => 'url',
    )
);

$wp_customize->add_setting('blogarise_subsc_open_in_new',
    array(
        'default' => true,
        'sanitize_callback' => 'blogarise_sanitize_checkbox',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(new Blogarise_Toggle_Control( $wp_customize, 'blogarise_subsc_open_in_new', 
    array(
        'label' => esc_html__('Open link in new tab', 'blogarise'),
        'type' => 'toggle',
        'section' => 'header_subscribe_section',
    )
));