<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Settings of login
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
		<h3>Settings</h3>
	</div>
	
	<div class="wow-admin-col wow-wrap">
		<div class="wow-admin-col-12">
			<div class="wow-admin-col">
				<div class="wow-admin-col-6">
					<b>New users default role</b>
					
				</div>
				<div class="wow-admin-col-6">			
					<?php echo self::create_option($user_roles);?>
				</div>
			</div>
			<small><em>Here you can define the default role for new users authenticating. Please, be extra carefull with this option, you may be automatically giving someone elevated roles and capabilities. For more information about WordPress users roles and capabilities refer to <a href="http://codex.wordpress.org/Roles_and_Capabilities" target="_blank">http://codex.wordpress.org/Roles_and_Capabilities</a>. </em></small>
			
		</div>
		
		<div class="wow-admin-col-12">
			<?php echo self::create_option($admin_bar);?> <label for="wow_admin_bar">Hide admin bar</label><br/>
			<small><em>Hide admin bar for user.</em></small>
		</div>
		<div class="wow-admin-col-12">
			<?php echo self::create_option($hide_login_button);?> <label for="wow_hide_login_button">Hide Login button</label><br/>
			<small><em>Hide buttons when user login.</em></small>
		</div>
		
		
	</div>
	
	
</div>