<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Email to User
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
		<h3>Email to User <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a></h3>
	</div>
	<div class="wow-admin-col wow-wrap">
		<div class="wow-admin-col-12">
			<input type="checkbox" disabled> Include email to admin <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>
			
			
		</div>
		<div class="wow-admin-col-12">
			From Name: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
			<input type="text" disabled value="Wow-Company"> 			
		</div>
		<div class="wow-admin-col-12">
			From Email: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
			<input type="text" disabled value="email@example.com">
		</div>
		<div class="wow-admin-col-12">
			Email Subject: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
			<input type="text" disabled value="Congratulations, you have successfully subscribed">
		</div>
		<div class="wow-admin-col-12">
			Email Content: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
			<textarea disabled></textarea>
		</div>
	</div>
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-12">			
			Enter the text that is sent to email to users after subscribing. HTML is accepted. Available template tags.
			<p />
			<i>{email} - User email</i><br/>
			<i>{fname} - User First Name </i><br/>
			<i>{lname} - User Last Name </i><br/>
		</div>
	</div>
	
	
</div>