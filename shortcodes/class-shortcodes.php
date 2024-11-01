<?php
	/**
		* Shortcodes
		*
		* @package     Social
		* @subpackage  Shortcodes
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	// Exit if accessed directly
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	class Wow_Login_Shortcodes { 
	
		private $arg;
		
		public function __construct($arg) {	
			$this->plugin_name      = $arg['plugin_name'];
			$this->plugin_menu      = $arg['plugin_menu'];
			$this->version          = $arg['version'];
			$this->pref             = $arg['pref'];			
			$this->slug             = $arg['slug'];
			$this->plugin_dir       = $arg['plugin_dir'];
			$this->plugin_url       = $arg['plugin_url'];
			$this->plugin_home_url  = $arg['plugin_home_url'];
					
			$this->option = get_option($this->pref);
			
			add_shortcode('Wow-Login', array($this, 'shortcode') );	
			
			add_action( 'init', array($this, 'autologin_via_url' ) );		
			
		}	
		
		
		// Registration Shortcode		
		public function shortcode($atts) { 
			$param = $this->option;
			extract(shortcode_atts(array('login' => "", 'redirect' => "", 'text' => "", 'button' => "",), $atts));
			ob_start();			
			if ($login == 'email'){
				include ('email-shortcode.php');
			}
			else{
				include ('social-shortcode.php');
			}										
			$form = ob_get_contents();
			ob_end_clean();		
			ob_start();
			include( 'css/style.php' );
			$style=ob_get_contents();
			ob_end_clean();			
			wp_enqueue_style( $this->slug.'-icon', $this->plugin_url . 'asset/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
			wp_enqueue_style( $this->slug.'-style', plugin_dir_url( __FILE__ ) . 'css/style.css');
			wp_add_inline_style( $this->slug.'-style',$style );
			
			if (!empty($param['hide_login_button'])){
				$form = null;
			}			
			return $form;
		}
		
				
		/**
			* Sends an email with the unique login link.
			*
			* @since v.1.0
			*
			* @return bool / WP_Error
		*/
		function send_link( $email_account = false, $nonce = false, $redirect = false){
			if ( $email_account  == false ){
				return false;
			}
			$valid_email = self::valid_account( $email_account  );
			$errors = new WP_Error;
			if (is_wp_error($valid_email)){
				$errors->add('invalid_email', $valid_email->get_error_message());
			} 
			else{				
				$param = $this->option;
				
				$unique_link = self::generate_url( $valid_email , $nonce, $redirect );
				$unique_url = '<a href="'. esc_url( $unique_link ) .'" target="_blank">'. esc_url( $unique_link ) .'</a>';
				
				$from_name = !empty($param['login_user_from']) ? $param['login_user_from'] : get_option( 'blogname' );
				$admin_email = !empty($param['login_user_from_email']) ? $param['login_user_from_email'] : get_option( 'admin_email' );	
				$subject = !empty($param['login_user_email_subject']) ? $param['login_user_email_subject'] : 'Login at '.get_bloginfo( 'name' );
				$message = !empty($param['login_user_email_content']) ? $param['login_user_email_content'] : 'Hello ! <p/>Login at '.get_bloginfo( 'name' ).' by visiting this url: {link}';	
				
				$headers=null;
				$headers.="content-type: text/html; charset=utf-8\r\n";
				$headers.="From: ".$from_name." <".$admin_email.">\r\n";
				$headers.="X-Mailer: PHP/".phpversion()."\r\n";
				
				$message = str_replace( '{email}', $valid_email, $message );
				$message = str_replace( '{link}', $unique_url, $message );									
				$sent_mail = wp_mail($valid_email, $subject, $message, $headers );
				
				
				if ( !$sent_mail ){
					$errors->add('email_not_sent', $param['email_error_sending']);
				}
			}
			$error_codes = $errors->get_error_codes();
			
			if (empty( $error_codes  )){
				return false;
				}else{
				return $errors;
			}
		}
		
		
		/**
			* Checks to see if an account is valid. Either email or username
			*
			* @since v.1.0
			*
			* @return bool / WP_Error
		*/
		function valid_account( $account ){
			if( is_email( $account ) ) {
				$account = sanitize_email( $account );
			}		
			
			if( is_email( $account ) && email_exists( $account ) ) {
				return $account;
			}
			
			if( is_email( $account ) && ! email_exists( $account ) ) {
				$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
				$user_id = wp_create_user( $account, $random_password, $account );
				global $wpdb;
				$wpdb->insert($wpdb->prefix . 'wow_login', array(
				'ID'         => $user_id,
				'type'       => 'email',
				'identifier' => '',
				'first_name' => '',
				'last_name'  => '',
				'email'      => $account,
				'link'       => 'mailto:'.$account,				
				) , array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',				
				));
				
				$data = array(				
				'EMAIL'      => $account,
				'FNAME'      => '',
				'LNAME'      => '',	
				'link'      => '',
				'login'      => '',
				);
				
				do_action('wow_emsi_integration', $data);
				do_action('wow_login_email', $data);
				
				return $account;
			}
			$param = $this->option;
			return new WP_Error( 'invalid_email', $param['email_error_email'] );
		}
		
		
		/**
			* Generates unique URL based on UID and nonce
			*
			* @since v.1.0
			*
			* @return string
		*/
		function generate_url( $email = false, $nonce = false, $redirect = false ){
			if ( $email  == false ){
				return false;
			}
			/* get user id */
			$user = get_user_by( 'email', $email );
			
			$token = self::create_onetime_token( 'wow_'.$user->ID, $user->ID  );
			
			$arr_params = array( 'wow_error_token', 'uid', 'token', 'nonce' );
			
			if ($redirect == false) {
				$redirect_uri = self::curpageurl();
			}
			else {
				$redirect_uri = $redirect;
			}
			
			$url = remove_query_arg( $arr_params, $redirect_uri );
			
			$url_params = array('uid' => $user->ID, 'token' => $token, 'nonce' => $nonce);
			$url = add_query_arg($url_params, $url);
			
			return $url;
		}
		
		/**
			* Create a nonce like token that you only use once based on transients
			*
			*
			* @since v.1.0
			*
			* @return string
		*/
		function create_onetime_token( $action = -1, $user_id = 0 ) {
			$time = time();
			
			// random salt
			$key = wp_generate_password( 20, false );
			
			require_once( ABSPATH . 'wp-includes/class-phpass.php');
			$wp_hasher = new PasswordHash(8, TRUE);
			$string = $key . $action . $time;
			
			// we're sending this to the user
			$token  = wp_hash( $string );
			$expiration = apply_filters('wow_change_link_expiration', $time + 60*10);
			$expiration_action = $action . '_expiration';
			
			// we're storing a combination of token and expiration
			$stored_hash = $wp_hasher->HashPassword( $token . $expiration );
			
			update_user_meta( $user_id, $action , $stored_hash ); // adjust the lifetime of the token. Currently 10 min.
			update_user_meta( $user_id, $expiration_action , $expiration );
			return $token;
		}
		
		/**
			* Returns the current page URL
			*
			* @since v.1.0
			*
			* @return string
		*/
		function curpageurl() {
			$pageURL = 'http';
			
			if ((isset($_SERVER["HTTPS"])) && ($_SERVER["HTTPS"] == "on"))
			$pageURL .= "s";
			
			$pageURL .= "://";
			
			if ($_SERVER["SERVER_PORT"] != "80")
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			
			else
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			
			$pageURL = esc_url_raw( $pageURL );
			
			return $pageURL;
		}
		
		/**
			* Automatically logs in a user with the correct nonce
			*
			* @since v.1.0
			*
			* @return string
		*/
		
		function autologin_via_url(){
			if( isset( $_GET['token'] ) && isset( $_GET['uid'] ) && isset( $_GET['nonce'] ) ){
				$uid = sanitize_key( $_GET['uid'] );
				$token  =  sanitize_key( $_REQUEST['token'] );
				$nonce  = sanitize_key( $_REQUEST['nonce'] );
				
				$hash_meta = get_user_meta( $uid, 'wow_' . $uid, true);
				$hash_meta_expiration = get_user_meta( $uid, 'wow_' . $uid . '_expiration', true);
				$arr_params = array( 'uid', 'token', 'nonce' );
				$current_page_url = remove_query_arg( $arr_params, self::curpageurl() );
				
				require_once( ABSPATH . 'wp-includes/class-phpass.php');
				$wp_hasher = new PasswordHash(8, TRUE);
				$time = time();
				
				if ( ! $wp_hasher->CheckPassword($token . $hash_meta_expiration, $hash_meta) || $hash_meta_expiration < $time || ! wp_verify_nonce( $nonce, 'wow_login_request' ) ){
					wp_redirect( $current_page_url . '?wow_error_token=true' );
					exit;
					} else {
					wp_set_auth_cookie( $uid );
					delete_user_meta($uid, 'wow_' . $uid );
					delete_user_meta($uid, 'wow_' . $uid . '_expiration');
					
					// $total_logins = get_option( 'wow_total_logins', 0);
					// update_option( 'wow_total_logins', $total_logins + 1);
					wp_redirect( $current_page_url );
					exit;
				}
			}
		}
		
	}
	
