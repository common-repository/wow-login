<?php
/**
* Social Networks
*
* @package     
* @subpackage  Settings
* @copyright   Copyright (c) 2017, Dmytro Lobov
* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
* @since       1.0
*/

/* Facebook */


$facebook_api_id = array(
'id'   => 'facebook_api_id',
	'name' => 'facebook_api_id',	
	'type' => 'text',
	'val' => isset($param['facebook_api_id']) ? $param['facebook_api_id'] : '',	
);

$facebook_secret = array(
	'id'   => 'facebook_secret',
	'name' => 'facebook_secret',	
	'type' => 'text',
	'val' => isset($param['facebook_secret']) ? $param['facebook_secret'] : '',	
);

$facebook_background = array(
	'id'   => 'facebook_background',
	'name' => 'facebook_background',	
	'type' => 'color',
	'val' => isset($param['facebook_background']) ? $param['facebook_background'] : '#3b5998',	
);

$facebook_hover = array(
	'id'   => 'facebook_hover',
	'name' => 'facebook_hover',	
	'type' => 'color',
	'val' => isset($param['facebook_hover']) ? $param['facebook_hover'] : '#8b9dc3',	
);

$facebook_text_color = array(
	'id'   => 'facebook_text_color',
	'name' => 'facebook_text_color',	
	'type' => 'color',
	'val' => isset($param['facebook_text_color']) ? $param['facebook_text_color'] : '#ffffff',	
);
$facebook_icon_color = array(
	'id'   => 'facebook_icon_color',
	'name' => 'facebook_icon_color',	
	'type' => 'color',
	'val' => isset($param['facebook_icon_color']) ? $param['facebook_icon_color'] : '#ffffff',	
);
$facebook_border_color = array(
	'id'   => 'facebook_border_color',
	'name' => 'facebook_border_color',	
	'type' => 'color',
	'val' => isset($param['facebook_border_color']) ? $param['facebook_border_color'] : '#ffffff',	
);

/* Google */

$google_api_key = array(
	'id'   => 'google_api_key',
	'name' => 'google_api_key',	
	'type' => 'text',
	'val' => isset($param['google_api_key']) ? $param['google_api_key'] : '',	
);

$google_client_id = array(
	'id'   => 'google_client_id',
	'name' => 'google_client_id',	
	'type' => 'text',
	'val' => isset($param['google_client_id']) ? $param['google_client_id'] : '',	
);

$google_client_secret = array(
	'id'   => 'google_client_secret',
	'name' => 'google_client_secret',	
	'type' => 'text',
	'val' => isset($param['google_client_secret']) ? $param['google_client_secret'] : '',	
);

$google_background = array(
	'id'   => 'google_background',
	'name' => 'google_background',	
	'type' => 'color',
	'val' => isset($param['google_background']) ? $param['google_background'] : '#F44336',	
);

$google_hover = array(
	'id'   => 'google_hover',
	'name' => 'google_hover',	
	'type' => 'color',
	'val' => isset($param['google_hover']) ? $param['google_hover'] : '#EF5350',	
);

$google_text_color = array(
	'id'   => 'google_text_color',
	'name' => 'google_text_color',	
	'type' => 'color',
	'val' => isset($param['google_text_color']) ? $param['google_text_color'] : '#ffffff',	
);
$google_icon_color = array(
	'id'   => 'google_icon_color',
	'name' => 'google_icon_color',	
	'type' => 'color',
	'val' => isset($param['google_icon_color']) ? $param['google_icon_color'] : '#ffffff',	
);
$google_border_color = array(
	'id'   => 'google_border_color',
	'name' => 'google_border_color',	
	'type' => 'color',
	'val' => isset($param['google_border_color']) ? $param['google_border_color'] : '#ffffff',	
);

/* Twitter */

$twitter_api_key = array(
	'id'   => 'twitter_api_key',
	'name' => 'twitter_api_key',	
	'type' => 'text',
	'val' => isset($param['twitter_api_key']) ? $param['twitter_api_key'] : '',	
);

$twitter_api_secret = array(
	'id'   => 'twitter_api_secret',
	'name' => 'twitter_api_secret',	
	'type' => 'text',
	'val' => isset($param['twitter_api_secret']) ? $param['twitter_api_secret'] : '',	
);

$twitter_background = array(
	'id'   => 'twitter_background',
	'name' => 'twitter_background',	
	'type' => 'color',
	'val' => isset($param['twitter_background']) ? $param['twitter_background'] : '#00aced',	
);

$twitter_hover = array(
	'id'   => 'twitter_hover',
	'name' => 'twitter_hover',	
	'type' => 'color',
	'val' => isset($param['twitter_hover']) ? $param['twitter_hover'] : '#0084b4',	
);

$twitter_text_color = array(
	'id'   => 'twitter_text_color',
	'name' => 'twitter_text_color',	
	'type' => 'color',
	'val' => isset($param['twitter_text_color']) ? $param['twitter_text_color'] : '#ffffff',	
);
$twitter_icon_color = array(
	'id'   => 'twitter_icon_color',
	'name' => 'twitter_icon_color',	
	'type' => 'color',
	'val' => isset($param['twitter_icon_color']) ? $param['twitter_icon_color'] : '#ffffff',	
);
$twitter_border_color = array(
	'id'   => 'twitter_border_color',
	'name' => 'twitter_border_color',	
	'type' => 'color',
	'val' => isset($param['twitter_border_color']) ? $param['twitter_border_color'] : '#ffffff',	
);

/* LinkedIn */

$linkedin_client_id = array(
	'id'   => 'linkedin_client_id',
	'name' => 'linkedin_client_id',	
	'type' => 'text',
	'val' => isset($param['linkedin_client_id']) ? $param['linkedin_client_id'] : '',	
);

$linkedin_client_secret = array(
	'id'   => 'linkedin_client_secret',
	'name' => 'linkedin_client_secret',	
	'type' => 'text',
	'val' => isset($param['linkedin_client_secret']) ? $param['linkedin_client_secret'] : '',	
);

$linkedin_background = array(
	'id'   => 'linkedin_background',
	'name' => 'linkedin_background',	
	'type' => 'color',
	'val' => isset($param['linkedin_background']) ? $param['linkedin_background'] : '#0e76a8',	
);

$linkedin_hover = array(
	'id'   => 'linkedin_hover',
	'name' => 'linkedin_hover',	
	'type' => 'color',
	'val' => isset($param['linkedin_hover']) ? $param['linkedin_hover'] : '#0a587d',	
);

$linkedin_text_color = array(
	'id'   => 'linkedin_text_color',
	'name' => 'linkedin_text_color',	
	'type' => 'color',
	'val' => isset($param['linkedin_text_color']) ? $param['linkedin_text_color'] : '#ffffff',	
);
$linkedin_icon_color = array(
	'id'   => 'linkedin_icon_color',
	'name' => 'linkedin_icon_color',	
	'type' => 'color',
	'val' => isset($param['linkedin_icon_color']) ? $param['linkedin_icon_color'] : '#ffffff',	
);
$linkedin_border_color = array(
	'id'   => 'linkedin_border_color',
	'name' => 'linkedin_border_color',	
	'type' => 'color',
	'val' => isset($param['linkedin_border_color']) ? $param['linkedin_border_color'] : '#ffffff',	
);

/* Email */

$email_success_text = array(
	'id'   => 'email_success_text',
	'name' => 'email_success_text',	
	'type' => 'editor_min',
	'val' => isset($param['email_success_text']) ? $param['email_success_text'] : '<p class="wow-box wow-success">Please check your email. You will soon receive an email with a login link.</p>',	
);

$email_invalid_token = array(
	'id'   => 'email_invalid_token',
	'name' => 'email_invalid_token',	
	'type' => 'editor_min',
	'val' => isset($param['email_invalid_token']) ? $param['email_invalid_token'] : '<p class="wow-box wow-error">Your token has probably expired. Please try again.</p>',	
);

$email_error_sending = array(
	'id'   => 'email_error_sending',
	'name' => 'email_error_sending',	
	'type' => 'editor_min',
	'val' => isset($param['email_error_sending']) ? $param['email_error_sending'] : '<p class="wow-box wow-error">There was a problem sending your email. Please try again or contact an admin.</p>',	
);

$email_error_email = array(
	'id'   => 'email_error_email',
	'name' => 'email_error_email',	
	'type' => 'editor_min',
	'val' => isset($param['email_error_email']) ? $param['email_error_email'] : '<p class="wow-box wow-error">The email you provided does not correct. Please try again.</p>',	
);


?>