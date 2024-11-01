<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Email
		*
		* @package     
		* @subpackage  Settings
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
?>


<div class="itembox">
	<div class="item-title">
		<h3>Email</h3>
	</div>		
	
	<div class="wow-admin-col wow-wrap">
		<div class="wow-admin-col-12"> 
			<h3>Message</h3>															
		</div>
		
		<div class="wow-admin-col-12"> 
			<b>Success text</b>:<br/>
			<?php echo self::create_option($email_success_text);?> 												
		</div>
		<div class="wow-admin-col-12"> 
			<b>Invalid token</b>:<br/>
			<?php echo self::create_option($email_invalid_token);?> 												
		</div>	
		<div class="wow-admin-col-12"> 
			<b>Error sending</b>:<br/>
			<?php echo self::create_option($email_error_sending);?> 												
		</div>
		<div class="wow-admin-col-12"> 
			<b>Error email</b>:<br/>
			<?php echo self::create_option($email_error_email);?> 												
		</div>
	</div>
	
</div>