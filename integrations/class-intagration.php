<?php
	/**
		* Interation Class
		*
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	class Wow_Login_Networks {
		
		private $arg;
		
		function __construct( $arg ) {	
			$this->plugin_name      = $arg['plugin_name'];
			$this->plugin_menu      = $arg['plugin_menu'];
			$this->version          = $arg['version'];
			$this->pref             = $arg['pref'];			
			$this->slug             = $arg['slug'];
			$this->plugin_dir       = $arg['plugin_dir'];
			$this->plugin_url       = $arg['plugin_url'];
			$this->plugin_home_url  = $arg['plugin_home_url'];
			
			$this->option = get_option($this->pref);
			add_action( 'init', array($this, 'session_init') );
			add_action('init', array($this,'login_compat'));
			
			
			// add_action('wow_login', array($this,'wow_login'));
			
			add_filter('bp_core_fetch_avatar', array($this, 'bp_insert_avatar'), 3, 5);
			
			add_filter('get_avatar', array($this, 'insert_avatar'), 5, 5);
		}	
		
		function session_init() {
            if( !session_id() && !headers_sent()) {
                session_start();
            }
        }
		
		public function login_compat( ) {			
			if(isset($_GET['wowLogin']) && !empty($_GET['wowLogin'])){
				self::login_check();
			}						
		}
		
		public function login_check( ) {
			$network = $_GET['wowLogin'];			
			switch( $network ) {
				case 'facebook':
				if( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
					echo 'The Facebook SDK requires PHP version 5.4 or higher. Please notify about this error to site admin.';
					die();
				}
				self::Facebook();
				break;				
				case 'google':								
				self::Google();
				break;				
				case 'twitter':				
				self::Twitter();
				break;
				case 'linkedin':				
				self::LinkedIn();
				break;
				
			}
			
		}
		
		public function Facebook(){
			include ('facebook.php');
			
		}
		public function Google(){
			include ('google.php');			
		}
		public function Twitter(){
			include ('twitter.php');
			
		}
		public function LinkedIn(){
			include ('linkedin.php');
		}
		
		public function wow_login($data){
			include ('wow_login.php');
		}
		
		function callBackUrl() {
			$connection = !empty( $_SERVER['HTTPS'] ) ? 'https://' : 'http://';
			$url = $connection . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"];
			if( strpos( $url, '?' ) === false ) {
				$url.= '?';
			} 
			else {
				$url.= '&';
			}
			return $url;
		}
		
		
		function insert_avatar($avatar = '', $id_or_email, $size = 96, $default = '', $alt = false) {
			
			$id = 0;
			if (is_numeric($id_or_email)) {
				$id = $id_or_email;
				} else if (is_string($id_or_email)) {
				$u  = get_user_by('email', $id_or_email);
				$id = $u->id;
				} else if (is_object($id_or_email)) {
				$id = $id_or_email->user_id;
			}
			if ($id == 0) return $avatar;
			$pic = get_user_meta($id, 'wow_user_avatar', true);
			if (!$pic || $pic == '') return $avatar;
			$avatar = preg_replace('/src=("|\').*?("|\')/i', 'src=\'' . $pic . '\'', $avatar);
			
			return $avatar;
		}
		
		function bp_insert_avatar($avatar = '', $params, $id) {
			if (!is_numeric($id) || strpos($avatar, 'gravatar') === false) return $avatar;
			$pic = get_user_meta($id, 'wow_user_avatar', true);
			if (!$pic || $pic == '') return $avatar;
			$avatar = preg_replace('/src=("|\').*?("|\')/i', 'src=\'' . $pic . '\'', $avatar);
			
			return $avatar;
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
		
		static function access_protected($obj, $prop) { 
			$reflection = new ReflectionClass($obj); 
			$property = $reflection->getProperty($prop); 
			$property->setAccessible(true); 
			return $property->getValue($obj); 
		} 
		
		
		
	}
?>