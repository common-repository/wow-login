<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Twitter
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
		<h3>Twitter</h3>
	</div>
	<div class="wow-admin-col">
		<div class="wow-admin-col-6">
			Consumer Key (API Key):<br/>
			<?php echo self::create_option($twitter_api_key);?>						
		</div>			
		<div class="wow-admin-col-6">
			Consumer Secret (API Secret):<br/>
			<?php echo self::create_option($twitter_api_secret);?>						
		</div>			
	</div>	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Background:<br/>
			<?php echo self::create_option($twitter_background);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Background hover:<br/>
			<?php echo self::create_option($twitter_hover);?> 												
		</div>	
		<div class="wow-admin-col-4"> 
			Text color:<br/>
			<?php echo self::create_option($twitter_text_color);?> 												
		</div>					
	</div>
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Icon color:<br/>
			<?php echo self::create_option($twitter_icon_color);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Border color:<br/>
			<?php echo self::create_option($twitter_border_color);?> 												
		</div>	
		<div class="wow-admin-col-4"> 																		
		</div>					
	</div>
	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-12">
			<b>Note:</b> <p />
			You need to create new twitter API application to setup the twitter login. Please follow the instructions to create new app.
			<br />
			<ul class="wow-futures">
				<li>Go to <a href='https://apps.twitter.com/' target='_blank'>https://apps.twitter.com/</a></li>
				<li>Click on Create New App button. A new application details form will appear. Please fill up the application details and click on "create your twitter application" button.</li>
				<li>Please note that before creating twiiter API application, You must add your mobile phone to your Twitter profile.</li>
				<li>After successful creation of the app. Please go to "Keys and Access Tokens" tabs and get Consumer key(API Key) and Consumer secret(API secret).</li>
				<li>To get a user email, go to 'Settings' and enter 'Privacy Policy URL' and 'Terms of Service URL'. After go to 'Permissions' and check 'Request email addresses from users' .</li>
				<li>Website: <input type='text' value='<?php echo site_url(); ?>' readonly='readonly'/></li>
				<li>Callback URL: <input type='text' value='<?php echo site_url(); ?>' readonly='readonly'/></li>
			</ul>
		</div>
	</div>
	
	
</div>