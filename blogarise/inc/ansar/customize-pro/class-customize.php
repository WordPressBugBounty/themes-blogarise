<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Blogarise_Customize {
	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {
		static $instance = null;
		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}
		return $instance;
	}
	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}
	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {
		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Loads Customizer helper functions.
		add_action( 'after_setup_theme', array( $this, 'customizer_helpers' ) );
		
		add_action( 'customize_register', array( $this, 'customize_controls' ), 10 );

		add_action( 'customize_register', array( $this, 'customize_options' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}
	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {
		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . '/inc/ansar/customize-pro/section-pro.php' );
		// Register custom section types.
		$manager->register_section_type( 'Blogarise_Customize_Section_Pro' );
		// Register sections.
		$manager->add_section(
			new Blogarise_Customize_Section_Pro(
				$manager,
				'blogarise_pro_upsell',
				array(
					'title'    => esc_html__( 'BlogArise Pro Available!', 'blogarise' ),
					'pro_text' => esc_html__( 'Go Pro','blogarise' ),
					'pro_url'  => 'https://themeansar.com/themes/blogarise-pro/',
					'priority'	=> 1
				)
			)
		);
	}
	/**
	 * Sets up the customizer Controls.
	*/
	public function customize_controls( $wp_customize ) {
		// Load customize controls.
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/controls/customize-control-helper.php';
		require BLOGARISE_THEME_DIR . 'inc/ansar/customizer-repeater/customizer-repeater-control.php';

    }
	/**
	 * Loads Customizer helper functions and sanitization callbacks.
	 *
	 * @since 1.0.0
	 */
	public function customizer_helpers() {

		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/customizer-callback.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/selective-refresh-and-partial.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/customizer-default.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/customizer-sanitize.php';
	}
	/**
	 * Sets up the customizer options.
	*/
	public function customize_options( $wp_customize ) {

		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/settings/header-options.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/settings/theme-options.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/settings/theme-layout.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/settings/frontpage-featured.php';
		require BLOGARISE_THEME_DIR . '/inc/ansar/customize/settings/frontpage-options.php';
	}
	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {
		wp_enqueue_script( 'blogarise-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/ansar/customize-pro/customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'blogarise-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/ansar/customize-pro/customize-controls.css' );
	}
}
// Doing this customizer thang!
Blogarise_Customize::get_instance();