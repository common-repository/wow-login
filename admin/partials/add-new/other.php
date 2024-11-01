<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Other
		*
		* @package     
		* @subpackage  Settings
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	include ('settings/'.$m_current.'.php');
	
	
?>


<div class="itembox">
	<div class="item-title">
		<h3>Other Settings</h3>		
		<div class="wow-admin-col">
			<div class="wow-admin-col-12"> 
				<?php echo self::create_option($include_param);?> <label for="wow_include_param"> Parameter from URL  </label>
				<input type="hidden" name="social_subscriber[include_param]" value="">
			</div>			
		</div>
		<div class="wow-admin-col" id="include_param">
			<div class="wow-admin-col-4"> 
				Parameter name:<br/>
				<?php echo self::create_option($param_name);?> 												
			</div>
			<div class="wow-admin-col-4"></div>	
			<div class="wow-admin-col-4"></div>			
		</div>
		<div class="wow-admin-col">
			<div class="wow-admin-col-12"> 
			<b>Notice</b><p/>
				This parameter can be used for sending additional information about the user.<br/>
				This parameter is added to the information about the user in the form of a tag. The parameter is taken from the url address.<p/>
				
				<b>Example:</b><br/>
				You set the name of the parameter "tag". In this case, if the user signs from the address like https://example.com/?tag=from_facebook, then in the information about the user will appear the tag from_facebook.
				<p/>				
				This parameter can be used for subscription in MailChimp, Activecampaign and Aweber.
				<p/>
				For using MailChimp:
				<ol>
					<li>go to the list;</li>
					<li>choose List fields and *|MERGE|* tags;</li>
					<li>click 'Add A Field';</li>
					<li>select a field type to add "Text";</li>
					<li>enter parameter name in the Field label and type and Put this tag in your content.</li>
				</ol>
				
				For using Activecampaign:
				<ol>
					<li>go to the list;</li>
					<li>Click 'Manage Fields';</li>
					<li>click 'New Custom Field' -> 'Text input';</li>
					<li>Enter 'Name';</li>	
					<li>Enter 'Personalization tag' -> 'SOCIAL_SUBSCRIBER'. The 'Personalization tag' must be like %SOCIAL_SUBSCRIBER% ;</li>
				</ol>
				
			</div>				
		</div>
		
	</div>	
</div>

