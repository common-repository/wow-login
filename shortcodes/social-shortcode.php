<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Shortcode
		*
		* @package     
		* @subpackage  Shortcode
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	
	if(empty($login)){
		$shortcode = '<u style="color:red;">Please, check Wow Login shortcode!!!</u>';
	}
	else {
		$text = !empty($text) ? $text : '';
		$redirect = !empty($redirect) ? $redirect : get_permalink();
		$url = site_url() . '?wowLogin='.$login;		
		$shortcode = '<a href="'.$url.'&redirect_to='.$redirect.'&action=login" rel="nofollow" class="wow-button wow-'.$login.'">'.$text.'</a>';		
		}
	echo $shortcode;
?>