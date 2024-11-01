<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* LinkedIn
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
		<h3>LinkedIn</h3>
	</div>
	<div class="wow-admin-col">
		<div class="wow-admin-col-6">
			Client ID:<br/>
			<?php echo self::create_option($linkedin_client_id);?>						
		</div>			
		<div class="wow-admin-col-6">
			Client Secret:<br/>
			<?php echo self::create_option($linkedin_client_secret);?>						
		</div>			
	</div>	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Background:<br/>
			<?php echo self::create_option($linkedin_background);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Background hover:<br/>
			<?php echo self::create_option($linkedin_hover);?> 												
		</div>	
		<div class="wow-admin-col-4"> 
			Text color:<br/>
			<?php echo self::create_option($linkedin_text_color);?> 												
		</div>					
	</div>
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Icon color:<br/>
			<?php echo self::create_option($linkedin_icon_color);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Border color:<br/>
			<?php echo self::create_option($linkedin_border_color);?> 												
		</div>	
		<div class="wow-admin-col-4"> 																		
		</div>					
	</div>
	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-12">
			<b>Note:</b> <p />
			You need to create a new linkedin API application to setup the linkedin login. Please follow the instrcutions to create new application.
			<br />
			<ul class="wow-futures">
				<li>Go to <a href='https://www.linkedin.com/developer/apps' target='_blank'>https://www.linkedin.com/developer/apps</a></li>
				<li>Click on "Create Application" button.</li>
				<li>Please enter the application details here. and click create app</li>
				<li>Get the Client ID and Client secret.</li>
				<li>Authorized Redirect URLs: <?php echo site_url(); ?></li>
				<li>OAuth 1.0a <br />
					Default "Accept" Redirect URL: <input type='text' value='<?php echo site_url(); ?>' readonly='readonly' /> <br />
					Default "Cancel" Redirect URL: <input type='text' value='<?php echo site_url(); ?>' readonly='readonly' /> <br />
				</li>
			</ul>
		</div>
	</div>
	
	
</div>