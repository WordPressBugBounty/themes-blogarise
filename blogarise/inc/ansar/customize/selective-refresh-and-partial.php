<?php
function blogarise_selective_refresh( $wp_customize ) {
	
	
	if (isset($wp_customize->selective_refresh)) {
		// site logo
		$wp_customize->selective_refresh->add_partial('custom_logo', array(
			'selector'        => '.site-logo', 
			'render_callback' => 'custom_logo_selective_refresh'
		));
		// site title
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector'        => '.site-title a, .site-title-footer a',
            'render_callback' => 'blogarise_customize_partial_blogname',
        ));
		// site tagline
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector'        => '.site-description, .site-description-footer',
            'render_callback' => 'blogarise_customize_partial_blogdescription',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_header_social_icons', array(
            'selector'        => '.bs-head-detail .bs-social'
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_footer_social_icons', array(
            'selector'        => 'footer .bs-social ',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_scrollup_enable', array(
            'selector'        => '.bs_upscr',
        ));
        $wp_customize->selective_refresh->add_partial('you_missed_title', array(
            'selector'        => '.missed .bs-widget-title .title',
            'render_callback' => 'blogarise_customize_partial_you_missed_title',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_related_post_title', array(
            'selector'        => '.single-class .col-lg-9 .bs-widget-title .title',
            'render_callback' => 'blogarise_customize_partial_blogarise_related_post_title',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_menu_search', array(
            'selector'        => '.bs-default .desk-header .msearch',
            'render_callback' => 'blogarise_customize_partial_blogarise_menu_search',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_lite_dark_switcher', array(
            'selector'        => '.bs-menu-full .desk-header.right-nav',
            'render_callback' => 'blogarise_customize_partial_right_nav',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_subsc_link', array(
            'selector'        => '.bs-menu-full .desk-header.right-nav',
            'render_callback' => 'blogarise_customize_partial_right_nav',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_subsc_open_in_new', array(
            'selector'        => '.bs-menu-full .desk-header.right-nav',
            'render_callback' => 'blogarise_customize_partial_right_nav',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_menu_search', array(
            'selector'        => '.bs-menu-full .desk-header.right-nav',
            'render_callback' => 'blogarise_customize_partial_right_nav',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_menu_subscriber', array(
            'selector'        => '.bs-menu-full .desk-header.right-nav',
            'render_callback' => 'blogarise_customize_partial_right_nav',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_footer_copyright', array(
            'selector'        => '.bs-footer-copyright .copyright-text', 
            'render_callback' => 'blogarise_customize_partial_footer_copyright',
        ));
        $wp_customize->selective_refresh->add_partial('hide_copyright', array(
            'selector'        => '.bs-footer-copyright', 
            'render_callback' => 'blogarise_customize_partial_hide_copyright',
        ));
        $wp_customize->selective_refresh->add_partial('header_social_icon_enable', array(
            'selector'        => '.bs-head-detail .col-md-4.col-xs-12, .bs-header-main .container > .row > .col-lg-4:not(.navbar-header, .d-lg-flex)',
            'render_callback' => 'blogarise_customize_partial_head_social_icon',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_header_social_icons', array(
            'selector'        => '.bs-head-detail .col-md-4.col-xs-12, .bs-header-main .container > .row > .col-lg-4:not(.navbar-header, .d-lg-flex)',
            'render_callback' => 'blogarise_customize_partial_head_social_icon',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_drop_caps_enable', array(
            'selector'        => '.content-right .bs-blog-post .bs-blog-meta, .content-full .bs-blog-post .bs-blog-meta', 
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_single_post_admin_details', array(
            'selector'        => '.bs-blog-post .bs-header .bs-blog-meta ',
        ));  
        $wp_customize->selective_refresh->add_partial('banner_advertisement_section_url', array(
            'selector'        => '.bs-header-main .attachment-full.size-full ',
        )); 
        $wp_customize->selective_refresh->add_partial('breaking_news_title', array(
            'selector'        => '.mg-latest-news .bn_title .title',
            'render_callback' => 'blogarise_customize_partial_breaking_news_title',
        ));
        $wp_customize->selective_refresh->add_partial('brk_news_enable', array(
            'selector'        => '.bs-head-detail',
            'render_callback' => 'blogarise_customize_partial_brk_news_enable',
        ));
        $wp_customize->selective_refresh->add_partial('blogarise_content_layout', array(
            'selector'        => '.index-class .container > .row, .archive-class > .container > .row', 
			'render_callback' => 'blogarise_customize_partial_content_layout',
        ));		
        $wp_customize->selective_refresh->add_partial('blogarise_page_layout', array(
			'selector'        => '.page-class > .container > .row',
			'render_callback' => 'blogarise_customize_partial_page_layout',
		));
		$wp_customize->selective_refresh->add_partial('you_missed_enable', array(
			'selector'        => 'div.missed',
			'render_callback' => 'blogarise_customize_partial_you_missed_enable',
		));
	}
}
add_action( 'customize_register', 'blogarise_selective_refresh' );

/**
 * Render the selective refresh partial.
 *
 * @return void
 */
function custom_logo_selective_refresh() {
    if( get_theme_mod( 'custom_logo' ) === "" ) return;
    echo '<div class="site-logo">'.the_custom_logo().'</div>';
}
function blogarise_customize_partial_blogname() {
	bloginfo('name');
}
function blogarise_customize_partial_blogdescription() {
	bloginfo('description');
}
function blogarise_customize_partial_header_data_enable() {
    return get_theme_mod( 'header_data_enable' );
}
function blogarise_customize_partial_footer_social_icon_enable() {
    return get_theme_mod( 'blogarise_footer_social_icons' ); 
}
function blogarise_customize_partial_right_nav() {
	blogarise_menu_btns();
}
function blogarise_customize_partial_sidebar_menu() {
    return get_theme_mod( 'sidebar_menu' ); 
}
function blogarise_customize_partial_blogarise_menu_subscriber() {
    return get_theme_mod( 'blogarise_menu_subscriber' ); 
}
function blogarise_customize_partial_you_missed_enable() {
	return do_action('blogarise_action_footer_missed_section');
}
function blogarise_customize_partial_brk_news_enable() {
    return do_action('blogarise_action_header_top_section'); 
}
function blogarise_customize_partial_breaking_news_title() {
    return get_theme_mod( 'breaking_news_title' ); 
}
function blogarise_customize_partial_footer_copyright() {
    return get_theme_mod( 'blogarise_footer_copyright' ); 
}
function blogarise_customize_partial_blogarise_related_post_title() {
    return get_theme_mod( 'blogarise_related_post_title' ); 
}
function blogarise_customize_partial_you_missed_title() {
    return get_theme_mod( 'you_missed_title' ); 
}
function blogarise_customize_partial_content_layout() {
	return do_action('blogarise_action_main_content_layouts');
}
function blogarise_customize_partial_hide_copyright() {
	return do_action('blogarise_action_footer_copyright');
}
function blogarise_customize_partial_head_social_icon() {
	return do_action('blogarise_action_header_social_section');
}
function blogarise_customize_partial_page_layout() {
	return get_template_part('template-parts/content', 'page');
}