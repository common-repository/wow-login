<?php
/**
* Emails
*
* @package     
* @subpackage  Settings
* @copyright   Copyright (c) 2017, Dmytro Lobov
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/



/* Login Email */

$login_user_from = array(
	'id'   => 'login_user_from',
	'name' => 'login_user_from',	
	'type' => 'text',
	'val' => isset($param['login_user_from']) ? $param['login_user_from'] : get_option( 'blogname' ),	
);

$login_user_from_email = array(
	'id'   => 'login_user_from_email',
	'name' => 'login_user_from_email',	
	'type' => 'text',
	'val' => isset($param['login_user_from_email']) ? $param['login_user_from_email'] : get_option( 'admin_email' ),	
);

$login_user_email_subject = array(
	'id'   => 'login_user_email_subject',
	'name' => 'login_user_email_subject',	
	'type' => 'text',
	'val' => isset($param['login_user_email_subject']) ? $param['login_user_email_subject'] : 'Login at '.get_bloginfo( 'name' ),	
);

$login_user_email_content = array(
	'id'   => 'login_user_email_content',
	'name' => 'login_user_email_content',	
	'type' => 'editor',
	'val' => isset($param['login_user_email_content']) ? $param['login_user_email_content'] : 'Hello ! <p/>Login at '.get_bloginfo( 'name' ).' by visiting this url: {link}',	
);

?>