<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Google
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
		<h3>Google</h3>
	</div>
	<div class="wow-admin-col">		
		<div class="wow-admin-col-6">
			Client ID:<br/>
			<?php echo self::create_option($google_client_id);?>						
		</div>	
		<div class="wow-admin-col-6">
			Client Secret:<br/>
			<?php echo self::create_option($google_client_secret);?>						
		</div>			
	</div>	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Background:<br/>
			<?php echo self::create_option($google_background);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Background hover:<br/>
			<?php echo self::create_option($google_hover);?> 												
		</div>	
		<div class="wow-admin-col-4"> 
			Text color:<br/>
			<?php echo self::create_option($google_text_color);?> 												
		</div>					
	</div>
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-4"> 
			Icon color:<br/>
			<?php echo self::create_option($google_icon_color);?> 												
		</div>
		<div class="wow-admin-col-4"> 
			Border color:<br/>
			<?php echo self::create_option($google_border_color);?> 												
		</div>	
		<div class="wow-admin-col-4"> 																		
		</div>					
	</div>
	
	
	<div class="wow-admin-col">
		<div class="wow-admin-col-12">
			<b>Note:</b> <p />
			You need to create new google API application to setup the google login. Please follow the instructions to create new application.
			<br />
			<ul class="wow-futures">
				<li>Go to <a href='https://console.developers.google.com/project' target='_blank'>https://console.developers.google.com/project.</a> </li>
				<li>Click on "Create Project" button. A popup will appear.</li>
				<li>Please enter Project name and click on "Create" button.</li>
				<li>A App will be created and a dashobard will appear.</li>
				<li>In the blue box please click on Enable and manage APIs link. A new page will load.</li>
				<li>Now In the Social APIs section click on Google+ API and click "Enable API" button. Then the Google+ API will be activated.</li>
				<li>Now click on Credentials section and go to OAuth consent screen and enter the app details there.</li>
				<li>Click on Credentials tab and click on "New credentials" or "Add credentials" if you have already created one, a selection will appear and click on "OAuth client ID".</li>
				<li>A new page will load. Please select Application type to Web application and click "create" button. Further forms will loaded up and enter the details there.</li>
				<li>In the authorized redirect URIs please enter the details provided in the note section from plugin and click save button.</li>
				<li>In the popup you will get Client ID and client secret.</li>
				<li>And please enter those credentials in the google setting in our plugin.</li>
				<li>Rediret uri setup:<br />					
					Please use <input type='text' value='<?php echo site_url(); ?>/?wowLogin=google' readonly='readonly'/>
				</li>
				<li>
					Please note: Make sure to check the protocol "http://" or "https://" as google checks protocol as well. Better to add both URL in the list if you site is https so that google social login work properly for both https and http browser.
				</li>
			</ul>
		</div>
	</div>
	
	
</div>