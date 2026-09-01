<?php
// section title
$wp_customize->add_setting(
'top_bar_tabs',
array(
    'default'           => '',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'top_bar_tabs',
    array(
        'label'                 => '',
        'type' => 'custom-tab-control',
        'section'               => 'topbar_options',
        'controls_general'      => json_encode( array( '#customize-control-breaking_news_settings', 
                                                        '#customize-control-brk_news_enable',
                                                        '#customize-control-breaking_news_title',
        ) ),
        'controls_design'       => json_encode( array( 
                                                        '#customize-control-top_bar_header_background_color',
        ) ),
    ) 
));

$wp_customize->add_setting('breaking_news_settings',
    array(
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(
    new Blogarise_Section_Title(
        $wp_customize,
        'breaking_news_settings',
        array(
            'label' => esc_html__('Breaking', 'blogarise'),
            'section' => 'topbar_options',
        )
    )
);
$wp_customize->add_setting('brk_news_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'blogarise_sanitize_checkbox',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(new Blogarise_Toggle_Control( $wp_customize, 'brk_news_enable', 
    array(
        'label' => esc_html__('Hide/Show', 'blogarise'),
        'type' => 'toggle',
        'section' => 'topbar_options',
    )
));

$wp_customize->add_setting(
'breaking_news_title',
    array(
        'default' => esc_html__('Breaking','blogarise'),
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ) 
);
$wp_customize->add_control(
'breaking_news_title',
    array(
        'label' => __('Title','blogarise'),
        'section' => 'topbar_options',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
    'top_bar_header_background_color', array( 
        'sanitize_callback' => 'blogarise_sanitize_alpha_color',
        'transport' => 'postMessage',
    ) 
);
$wp_customize->add_control( 'top_bar_header_background_color', array(
    'label'      => __('Background Color', 'blogarise' ),
    'type' => 'color',
    'section' => 'topbar_options')
);