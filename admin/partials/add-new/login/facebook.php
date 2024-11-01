<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Facebook
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
		<h3>Facebook</h3>
	</div>
	<div class="wow-admin-col">
		<div class="wow-admin-col-6">
			Facebook App ID:<br/>
			<?php echo self::create_option($facebook_api_id);?>						
		</div>	
		<div class="wow-admin-col-6">
			Facebook App Secret:<br/>
			<?php echo self::create_option($facebook_secret);?>						
		</div>			
	</div>	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Background:<br/>
			<?php echo self::create_option($facebook_background);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Background hover:<br/>
			<?php echo self::create_option($facebook_hover);?> 												
		</div>	
		<div class="wow-admin-col-4"> 
			Text color:<br/>
			<?php echo self::create_option($facebook_text_color);?> 												
		</div>					
	</div>
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Icon color:<br/>
			<?php echo self::create_option($facebook_icon_color);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Border color:<br/>
			<?php echo self::create_option($facebook_border_color);?> 												
		</div>	
		<div class="wow-admin-col-4"> 																		
		</div>					
	</div>
	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-12">
			<b>Note:</b> <p />
			You need to create a new facebook API Applitation to setup facebook login. Please follow the instructions to create new app.
			<br />
			<ul class="wow-futures">
				<li>Go to <a href='https://developers.facebook.com/apps' target='_blank'>https://developers.facebook.com/apps</a>.</li>
				<li>Click on 'Add a New App' button. A popup will open. Then choose website.</li>
				<li>Add the required informations and don't forget to make your app live. This is very important otherwise your app will not work for all users.</li>
				<li>Then Click the "Create App" button and follow the instructions, your new app will be created. </li>
				<li>Copy and Paste "App ID" and "App Secret" here.</li>
				<li>Click 'Add Product' and select 'Facebook login'.</li>
				<li>Enter site url in 'Valid OAuth redirect URIs'. Site url: <input type='text' value='<?php echo site_url(); ?>' readonly='readonly' /></li>
			</ul>
		</div>
	</div>
	
	
</div>