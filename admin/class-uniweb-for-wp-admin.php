<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://ssec.shop/
 * @since      1.0.1
 *
 * @package    Uniweb_For_Wp
 * @subpackage Uniweb_For_Wp/admin
 * @author     Shohei Tanaka <shoheit@ssec.shop>
 */

class Uniweb_For_Wp_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {
		$page = 'uniweb-setting';
		$section = 'uniweb-setting-basic';
		add_submenu_page( 
			'tools.php', 
			__( 'UniWeb Setting', 'uniweb-for-wp' ), 
			__( 'UniWeb Setting', 'uniweb-for-wp' ), 
			'manage_options', 
			$page, 
			array( $this, 'uniweb_setting' )
		);
		// Activation settings
		register_setting(
			$section, 
			$section, 
			array( $this, 'wp_uniweb_validate_options' )
		);
		// Add section
		add_settings_section(
			$section,
			__( 'Basic setting', 'uniweb-for-wp' ),
			'',
			$page
		);
		// Add field
		add_settings_field( 
			'uniweb_code', 
			__( 'Uniweb code', 'uniweb-for-wp' ), 
			array( $this, 'uniweb_code_input' ),
			$page, 
			$section, 
			array( 'label_for' => '')
		);

		if( isset( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'] ) ){
			$uniweb_code = isset( $_REQUEST['uniweb-code'] )?trim( $_REQUEST['uniweb-code'] ):'';
			// Should match the settings_fields() value
			if (isset( $_REQUEST['option_page'] ) && sanitize_text_field( $_REQUEST[ 'option_page' ] ) == 'uniweb-setting' ) {
				update_option( 'uniweb-code', sanitize_text_field( $uniweb_code ) );
			}
		}

	}

	public function uniweb_setting(){
		echo '<form method="post" action="">';
		settings_fields( 'uniweb-setting' );
		do_settings_sections( 'uniweb-setting' );
		submit_button( 
			__( 'Save', 'uniweb-for-wp' ),
			'primary',
			'save_uniweb_setting',
			false
		);
		echo '</form>';
		echo '<hr />';
		$uniweb_apply_url = esc_url('https://studio.ssec.shop/uniweb/?utm_source=wporg&utm_medium=plugins&utm_campaign=wp_admin');
		echo '<div><a href="'.$uniweb_apply_url.'">'.__( 'Apply UniWeb from here.', 'uniweb-for-wp' ).'</a></div>';
	}

	// Sanitizes and validates all input and output for Dashboard
	function wp_uniweb_validate_options( $input ){
	}

	public function uniweb_code_input(){
		$uniweb_code = '';
		if(get_option( 'uniweb-code' )){
			$uniweb_code = get_option( 'uniweb-code' );
		}
		echo '<input type="text" name="uniweb-code" value="'.wp_filter_post_kses($uniweb_code).'" />';
	}
}
