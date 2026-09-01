<?php
$blogarise_default = blogarise_get_default_theme_options();

// Setting banner_advertisement_section.
$wp_customize->add_setting('banner_advertisement_section',
    array(
        'default' => $blogarise_default['banner_advertisement_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
    )
);
$wp_customize->add_control(
    new WP_Customize_Cropped_Image_Control($wp_customize, 'banner_advertisement_section',
        array(
            'label' => esc_html__('Banner Section Advertisement', 'blogarise'),
            'description' => sprintf(esc_html__('Recommended Size %1$s px X %2$s px', 'blogarise'), 930, 100),
            'section' => 'frontpage_advertisement_settings',
            'width' => 930,
            'height' => 100,
            'flex_width' => true,
            'flex_height' => true,
        )
    )
);

/*banner_advertisement_section_url*/
$wp_customize->add_setting('banner_advertisement_section_url',
    array(
        'default' => $blogarise_default['banner_advertisement_section_url'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw',
        'default' => '#',
    )
);
$wp_customize->add_control('banner_advertisement_section_url',
    array(
        'label' => esc_html__('URL Link', 'blogarise'),
        'section' => 'frontpage_advertisement_settings',
        'type' => 'url',
    )
);
$wp_customize->add_setting('blogarise_open_on_new_tab',
    array(
        'default' => true,
        'sanitize_callback' => 'blogarise_sanitize_checkbox',
    )
);
$wp_customize->add_control(new blogarise_Toggle_Control( $wp_customize, 'blogarise_open_on_new_tab', 
    array(
        'label' => esc_html__('Open link in a new tab', 'blogarise'),
        'type' => 'toggle',
        'section' => 'frontpage_advertisement_settings',
    )
));