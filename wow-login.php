<?php
	/**
		* Plugin Name:       Wow Login
		* Plugin URI:        https://ru.wordpress.org/plugins/wow-login/
		* Description:       Easy login and registration of a user through a social network and email
		* Version:           1.0
		* Author:            Wow-Company		
		* License:           GPL-2.0+
		* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt		
	*/	
	
	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) exit;	
	
	if( !class_exists( 'Wow_Company' )) {
		require_once plugin_dir_path( __FILE__ ) . 'asset/class-wow-company.php';				
	}
	
		
	// Uninstall plugin
	
	
	if( !class_exists( 'Wow_Login' ) ) {
		final class Wow_Login {
			
			private static $instance;
			
			const PREF = 'wow_login';			
						
			function __construct() {
				$this->name = 'Wow Login';
				$this->pluginname = dirname(plugin_basename(__FILE__));
				$this->version = '1.0';	
			}
			
			public static function instance() {
				
				if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Wow_Login ) ) {					
					$arg = array(
						'plugin_name'      => 'Wow Login',
						'plugin_menu'      => 'Wow Login',
						'plugin_home_url'  => 'wow-login',
						'version'          => '1.0',
						'base_file'        => basename(__FILE__),
						'slug'             => dirname(plugin_basename(__FILE__)),
						'plugin_dir'       => plugin_dir_path( __FILE__ ),
						'plugin_url'       => plugin_dir_url( __FILE__ ),
						'pref'             => self::PREF,					
					);				
					self::$instance = new Wow_Login;
					
					register_activation_hook( __FILE__, array(self::$instance, 'plugin_activate' ) );
								
					
					self::$instance->includes();
					self::$instance->adminlinks = new Wow_Login_ADMIN_LINKS($arg);
					self::$instance->admin      = new Wow_Login_ADMIN($arg);
					self::$instance->shortcodes = new Wow_Login_Shortcodes($arg);					
					self::$instance->social     = new Wow_Login_Networks($arg);
					
					
					
				}
				return self::$instance;
			}
			
			public function __clone() {
				// Cloning instances of the class is forbidden.
				_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'ems-integration' ), '1.0' );
			}
			
			public function __wakeup() {
				// Unserializing instances of the class is forbidden.
				_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'ems-integration' ), '1.0' );
			}
			
			private function includes() {			
				require_once plugin_dir_path( __FILE__ ) . 'includes/class-admin-links.php';			
				require_once plugin_dir_path( __FILE__ ) . 'admin/class-admin.php';
				require_once plugin_dir_path( __FILE__ ) . 'shortcodes/class-shortcodes.php';				
				require_once plugin_dir_path( __FILE__ ) . 'integrations/class-intagration.php';
										
			}
			
			
			// Activate & diactivate
			function plugin_activate() {
				require_once plugin_dir_path( __FILE__ ) . 'includes/activator.php';	
			}
			
						
		}
	}
	
	function wow_login() {
		return Wow_Login::instance();
	}	
	// Get Running.
	wow_login();
	
	add_filter('widget_text', 'do_shortcode');