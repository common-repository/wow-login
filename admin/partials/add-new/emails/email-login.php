<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Email for Login to User
		*
		* @package     Settings
		* @subpackage  Emails
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
?>


<div class="itembox">
	<div class="item-title">
		<h3>Email for Login</h3>
	</div>
	<div class="wow-admin-col wow-wrap">		
		<div class="wow-admin-col-12">
			From Name:<br/>
			<?php echo self::create_option($login_user_from);?>
		</div>
		<div class="wow-admin-col-12">
			From Email:<br/>
			<?php echo self::create_option($login_user_from_email);?>
		</div>
		<div class="wow-admin-col-12">
			Email Subject:<br/>
			<?php echo self::create_option($login_user_email_subject);?>
		</div>
		<div class="wow-admin-col-12">
			Email Content:<br/>
			<?php echo self::create_option($login_user_email_content);?>
		</div>
	</div>
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-12">			
			Enter the text that is sent to email to users with link for login. HTML is accepted. Available template tags.
			<p />
			<i>{email} - User email</i><br/>
			<i>{link} - Link for login </i><br/>
			
		</div>
	</div>
	
	
</div>