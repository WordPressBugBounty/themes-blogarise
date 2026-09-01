<?php
$wp_customize->add_panel('header_option_panel',
    array(
        'title' => esc_html__('Header Options', 'blogarise'),
        'priority' => 30,
    )
);
    $wp_customize->get_section('header_image')->panel = 'header_option_panel';
    $wp_customize->add_section( 'topbar_options' , array(
        'title' => __('Top Bar', 'blogarise'),
        'panel' => 'header_option_panel',
    ) );
    $wp_customize->add_section( 'social_options' , array(
        'title' => __('Social icons', 'blogarise'),
        'panel' => 'header_option_panel',
    ) );
    $wp_customize->add_section( 'frontpage_advertisement_settings' , array(
        'title' => __('Banner Advertisement', 'blogarise'),
        'panel' => 'header_option_panel',
    ) );
    $wp_customize->add_section( 'header_search_section' , array(
        'title' => __('Search', 'blogarise'),
        'panel' => 'header_option_panel',
    ) );
    $wp_customize->add_section( 'header_subscribe_section' , array(
        'title' => __('Subscribe Button', 'blogarise'),
        'panel' => 'header_option_panel',
    ) );
    $wp_customize->add_section( 'header_dark_mode_section' , array(
        'title' => __('Dark and Light Mode Switcher', 'blogarise'),
        'panel' => 'header_option_panel',
    ) );