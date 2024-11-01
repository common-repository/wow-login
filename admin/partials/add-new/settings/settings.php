<?php
/**
* Settings
*
* @package     
* @subpackage  Settings
* @copyright   Copyright (c) 2017, Dmytro Lobov
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/

$admin_bar = array(
	'id'   => 'admin_bar',
	'name' => 'admin_bar',	
	'type' => 'checkbox',
	'val' => isset($param['admin_bar']) ? $param['admin_bar'] : 0,	
);

$hide_login_button = array(
	'id'   => 'hide_login_button',
	'name' => 'hide_login_button',	
	'type' => 'checkbox',
	'val' => isset($param['hide_login_button']) ? $param['hide_login_button'] : 0,	
);

$all_roles = wp_roles()->role_names;

$user_roles = array(
	'id'   => 'user_roles',
	'name' => 'user_roles',	
	'type' => 'select',
	'val' => isset($param['user_roles']) ? $param['user_roles'] : 'subscriber',	
	'option' => $all_roles,
);