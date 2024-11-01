<?php
	/**
		* Wow Login
		*
		* @package     
		* @subpackage  User Login & Registration
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	$param = $this->option;
	global $wpdb;
	$ID = $wpdb->get_var($wpdb->prepare('SELECT ID FROM ' . $wpdb->prefix . 'wow_login WHERE email = "%s"', $data['EMAIL']));
	
	if (!get_user_by('id', $ID)) { 
		$wpdb->query($wpdb->prepare('DELETE FROM ' . $wpdb->prefix . 'wow_login WHERE ID = "%d" ', $ID));
		$ID = null;
	}
	
	if (!is_user_logged_in()) {
		
		if ($ID == NULL) { // Register
			$random_password = wp_generate_password($length = 12, $include_standard_special_chars = false);	
			$ID = wp_create_user($data['EMAIL'], $random_password, $data['EMAIL']);
			if (!is_wp_error($ID)) {
				
				$user_info = get_userdata($ID);
				wp_update_user(array(
				'ID'           => $ID,
				'display_name' => $data['name'],
				'first_name'   => $data['FNAME'],
				'last_name'    => $data['LNAME'],
				'user_email'   => $data['EMAIL'],
				'role' 	       => $param['user_roles'],
				));
				
								
			} 
			else {
				return;
			}
			if ($ID) {				
				$wpdb->insert($wpdb->prefix . 'wow_login', array(
				'ID'         => $ID,
				'type'       => $data['type'],
				'identifier' => $data['identifier'],
				'first_name' => $data['FNAME'],
				'last_name'  => $data['LNAME'],
				'email'      => $data['EMAIL'],
				'link'       => $data['link'],				
				) , array(
				'%d',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',				
				));
			}
			
		}
		
		if ($ID) { // Login			
			
			$secure_cookie = is_ssl();
			$secure_cookie = apply_filters('secure_signon_cookie', $secure_cookie, array());			
			wp_set_auth_cookie($ID, true, $secure_cookie);	
			
			$avatar = $data['avatar'];					
			
			update_user_meta($ID, 'wow_user_avatar', $avatar);
			
		}
		
	}
	
?>	