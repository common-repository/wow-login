<?php if ( ! defined( 'ABSPATH' ) ) exit;
	/**
		* Admin Page Class
		*
		* @package     Wow_Login_ADMIN
		* @subpackage  
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	class Wow_Login_ADMIN {	
		
		private $arg;		
		
		public function __construct( $arg ) {
			$this->plugin_name      = $arg['plugin_name'];
			$this->plugin_menu      = $arg['plugin_menu'];
			$this->version          = $arg['version'];
			$this->pref             = $arg['pref'];			
			$this->slug             = $arg['slug'];
			$this->plugin_dir       = $arg['plugin_dir'];
			$this->plugin_url       = $arg['plugin_url'];
			$this->plugin_home_url  = $arg['plugin_home_url'];
			
			
			
			// admin pages
			add_action( 'admin_menu', array($this, 'add_menu_page') );
			add_action( 'admin_init', array($this, 'update_option') );
			add_action( 'admin_notices', array($this, 'admin_messages') );	
			
			// Export users
			add_action( 'admin_init', array($this, 'users_action') );
			
		}
		function add_menu_page() {
			add_submenu_page('wow-company', $this->plugin_name, $this->plugin_menu, 'manage_options', $this->slug, array( $this, 'plugin_admin' ));
		}
		
		function plugin_admin() {				
			global $wow_company_plugin;	
			$wow_company_plugin = true;		
			$license = get_option( 'wow_license_key_'.$this->pref );
			$status = get_option( 'wow_license_status_'.$this->pref );
			include_once( $this->plugin_dir.'admin/partials/index.php' );
			self:: plugin_admin_style_script();				
		}			
		function plugin_admin_style_script() {
			// plugin sctyle & script		
			wp_enqueue_style( $this->slug.'-style', $this->plugin_url . 'admin/css/style.css',false, $this->version);			
			wp_enqueue_style( $this->slug.'-icon', $this->plugin_url . 'asset/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );		
			wp_enqueue_script($this->slug.'-script', $this->plugin_url . 'admin/js/script.js', array('jquery'), $this->version);
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker');
			wp_enqueue_script( 'wp-color-picker-alpha', $this->plugin_url . 'admin/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ));
		}	
		
		// Update an option
		public function update_option(){			
			if ( !empty($_POST['wow_'.$this->pref.'_nonce_field']) && wp_verify_nonce($_POST['wow_'.$this->pref.'_nonce_field'],'wow_'.$this->pref.'_update') ){
				$new_option = wp_unslash($_POST[''.$this->pref.'']);				
				$options = get_option( $this->pref );
				if (empty($options)){
					$result = $new_option;
				}
				else {					
					$result = array_merge($options, $new_option);					
				}				
				update_option( $this->pref, $result );				
				$reffer = $_POST['_wp_http_referer'];
				$url = add_query_arg( array('ss-message' => 'update'), $reffer );
				wp_redirect($url);
				exit;					
			}			
		}
		
		// Admin Messages
		public function admin_messages(){			
			if ( isset( $_GET['wow-login-message'] ) ){
				if($_GET['wow-login-message'] == 'update')
				add_settings_error( 'wow-login-notices', 'wow-login-option-update', 'Settings updated.', 'updated' );
				if($_GET['wow-login-message'] == 'delete')
				add_settings_error( 'wow-login-notices', 'wow-login-option-delete', 'User was delete.', 'updated' );
			} 
			
			settings_errors( 'wow-login-notices' );
		}
		
		function users_action() { 
			if(isset($_GET['info']) && isset($_GET['tab']) && isset($_GET['page'])){				
				if ($_GET['info'] == "delete" && $_GET['tab'] == 'wow-users' && $_GET['page'] == $this->slug) {
					if( wp_verify_nonce( $_GET['_wpnonce'], 'wow_href_nonce' ) ){						
						$id = absint($_GET["id"]);
						global $wpdb;
						$table = $wpdb->prefix . "wow_login";						
						$wpdb->query("delete from " . $table . " where id=" . $id);
						$user = get_user_by( 'ID', $id );
						if ($user != false){
							wp_delete_user( $id );
						}						
						$reffer = admin_url( '/admin.php?page='.$this->slug.'&tab=wow-users' ) ;
						$url = add_query_arg( array('wow-login-message' => 'delete'), $reffer );
						self::redirect($url);
						
						
					}
				}
				
			}
			
			if( isset($_POST['action'] )) {
				if ($_POST['action'] === 'wow-users-export') {
					if( wp_verify_nonce($_POST['wow_login_export_field'],'wow_login_export_action') && current_user_can('manage_options') ){
						$ids = isset( $_POST['ID'] ) ? $_POST['ID'] : false;
						if ( ! is_array( $ids ) )
						$ids = array( $ids );									
						$filename = "wow-users.csv";
						$fp = fopen('php://output', 'w');					
						header('Content-type: application/csv');
						header('Content-Disposition: attachment; filename='.$filename);					
						fputcsv($fp, array('Email','First Name', 'Last Name', 'Role', 'Date'));	
						foreach ( $ids as $id ) {
							$user = get_userdata( $id );
							$roles = implode(', ', $user->roles);
							fputcsv($fp, array($user->user_email, $user->first_name, $user->last_name, $roles,  $user->user_registered));
						}
						exit;
					}
				}				
			}
			
		}
		
		static function redirect( $redirect ) {
            if( headers_sent() ) {
                
                // Use JavaScript to redirect if content has been previously sent (not recommended, but safe)
                echo '<script language="JavaScript" type="text/javascript">window.location=\'';
                echo $redirect;
                echo '\';</script>';
			} 
            else {
                
                // Default Header Redirect
                header( 'Location: ' . $redirect );
			}
            exit;
		}
		
		function create_option ($arg){
			$id        = isset($arg['id']) ? $arg['id'] : null;
			$name      = isset($arg['name']) ? $arg['name'] : '';
			$type      = isset($arg['type']) ? $arg['type'] : '';
			$func      = !empty($arg['func']) ? ' onchange="'.$arg['func'].'();"'  : '';
			$options   = isset($arg['option']) ? $arg['option'] : '';
			$val       = $arg['val'];
			$separator = isset($arg['sep']) ? $arg['sep'] : '';
			// create radio fields
			if ($type == 'radio'){									
				$option = '';
				foreach ($options as $key => $value){
					$select = ($key == $val) ? 'checked="checked"' : '';				
					$option .= '<input name="'.$this->pref.'['.$name.']" type="radio" value="'.$key.'" id="wow_'.$id.'_'.$key.'" '.$select.'><label for="wow_'.$id.'_'.$key.'"> '.$value.'</label>'.$separator;					
				}
				$field = $option;
			}
			
			// create checkbox field
			if ($type == 'checkbox'){							
				$select = !empty($val) ? 'checked="checked"' : '';
				$field = '<input type="checkbox" '.$select.$func.' id="wow_'.$id.'">'.$separator;	
				$field .= '<input type="hidden" name="'.$this->pref.'['.$name.']" value="">';
			}
			
			// create text field
			if ($type == 'text'){							
				$field = '<input name="'.$this->pref.'['.$name.']" type="text" value="'.$val.'" id="wow_'.$id.'"'.$func.'>'.$separator;
			}
			
			// create number field
			if ($type == 'number'){							
				$field = '<input name="'.$this->pref.'['.$name.']" type="number" value="'.$val.'" id="wow_'.$id.'"'.$func.'>'.$separator;
			}
			
			// create color field
			if ($type == 'color'){							
				$field = '<input name="'.$this->pref.'['.$name.']" type="text" value="'.$val.'" class="wp-color-picker-field" data-alpha="true">'.$separator;
			}
			
			// create select field
			if ($type == 'select'){													
				$option = '';
				foreach ($options as $key => $value){
					$select = ($key == $val) ? 'selected="selected"' : '';
					$option .= '<option value="'.$key.'" '.$select.'>'.$value.'</option>';
				}
				$field = '<select name="'.$this->pref.'['.$name.']"'.$func.' id="wow_'.$id.'">';
				$field .= $option;
				$field .= '</select>';
			}
			
			// create editor field
			if ($type == 'editor'){
				$settings = array(
				'wpautop'       => 0,
				'textarea_name' => ''.$this->pref.'['.$name.']',				
				);
				$field = wp_editor( $val, $id, $settings );
				
			}
			
			// create editor min field
			if ($type == 'editor_min'){
				$settings_min = array(
				'wpautop'       => 0,
				'media_buttons' => 0,
				'textarea_name' => ''.$this->pref.'['.$name.']',				
				);
				$field = wp_editor( $val, $id, $settings_min );
				
			}
			
			// create textarea field
			if ($type == 'textarea'){
				$field = '<textarea name="'.$this->pref.'['.$name.']" id="wow_'.$id.'">'.$val.'</textarea>'.$separator;	
			}
			return $field;
		}
		
	}								