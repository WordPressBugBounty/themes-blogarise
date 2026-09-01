<?php
$blogarise_default = blogarise_get_default_theme_options();
$wp_customize->add_setting('blogarise_search_icon_setting',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Blogarise_Section_Title(
        $wp_customize,
        'blogarise_search_icon_setting',
        array(
            'label' => __('Search', 'blogarise'),
            'section' => 'header_search_section',
        )
    )
);

$wp_customize->add_setting('blogarise_menu_search',
    array(
        'default' => true,
        'sanitize_callback' => 'blogarise_sanitize_checkbox',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(new Blogarise_Toggle_Control( $wp_customize, 'blogarise_menu_search', 
    array(
        'label' => esc_html__('Hide/Show', 'blogarise'),
        'type' => 'toggle',
        'section' => 'header_search_section',
    )
));