<?php if ( ! defined( 'ABSPATH' ) ) exit;		
	$tab_menu = array(
	'login'  => array('Login', 'fa-sign-in'),
	'settings' => array('Settings','fa-cogs'),	
	'style' => array('Style', 'fa-paint-brush'),
	'emails' => array('Emails', 'fa-envelope'),
	'services' => array('Services', 'fa-envelope-o'),		
	);		
	$param = get_option($this->pref);
?>
<form action="" method="post" name="<?php echo $this->pref;?>" id="<?php echo $this->pref;?>">
	<div class="wowcolom">
		<div id="wow-leftcol">			
			<div class="menu-box wow-admin">
				<ul class="menu-nav">
					<?php 						
						$m_current = (isset($_GET['menu'])) ? sanitize_text_field($_GET['menu']) : 'login';
						foreach ($tab_menu as $menu => $val){
							$m_class = ( $menu == $m_current ) ? 'active' : '';							
							echo '<li><a class="'.$m_class.'" href="?page='.$this->slug.'&tab='.$current.'&menu='.$menu.'"><i class="fa '.$val[1].'"></i> '.$val[0].'</a></li>';
						}						
					?>
				</ul>
				<div class="menu-panels">					
					<?php include_once ('add-new/'.$m_current.'.php'); ?>					
				</div>
			</div>			
		</div>
		<div id="wow-rightcol">
			<div class="wowbox">
				<h3>Publish</h3>
				<div class="wow-admin" style="display: block;">
					<div class="wow-admin-col">						
						<div class="wow-admin-col-12 right">						
							<input name="submit" id="submit" class="button button-primary" value="Save Changes" type="submit">
						</div>
					</div>
				</div>
			</div>
			
			<div class="wowbox">
				<h3>Shortcode</h3>
				<div class="wow-admin" style="display: block;">
					<div class="wow-admin-col">						
						<div class="wow-admin-col-12">						
							You can use shortcode for the display of the button for login via Social Network in the contents of a posts and pages.<p />
							<center><b>[Wow-Login login="facebook"]</b></center><p />
							Attributes:<p/>
							<b>login</b> - <span style="color:red;">required attribute</span>. Can be: facebook, twitter, linkedin, google, email<p/>
							<b>text</b> - text of login button or placeholder for email<p/>
							<b>redirect</b> - URL of redirect, where user redirected after login. If this attribute empty, user will be redirected to current page<p/>
							<b>button</b> - button text for login via email<p/>
							Example:<p/>
							<center><b>[Wow-Login login="google" text="Subscribe" redirect="https://wow-estore.com/"]</b></center><br/>
							<center><b>[Wow-Login login="email" text="Enter Email" button="LogIn"]</b></center>
							
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="wowbox">
				<center><img src="<?php echo plugin_dir_url( __FILE__ ); ?>thankyou.png" alt=""  /></center>
				<hr/>				
				<div class="wow-admin wow-plugins">
					<p>We really appreciate your view of the plugin and your feedback is important to us. If you have a little time, please <a href="https://wordpress.org/plugins/wow-login/" target="_blank"><b>leave a review</b></a> on your experience of using the plugin on the site. Your wishes about new features for plugins will also be very useful. </p>					
					<p><b>With your help our products can become better!</b></p>
					<p>				
						
						<em><b>Best Regards</b>,<br/>						
							<a href="https://wow-estore.com/" target="_blank">Wow-Company Team</a><br/>
							Dmytro Lobov<br/>
							<a href="mailto:support@wow-company.com">support@wow-company.com</a>
						</em>
					</p>	
				</div>
			</div>		
			
		</div>
	</div>			
	<?php wp_nonce_field('wow_'.$this->pref.'_update','wow_'.$this->pref.'_nonce_field'); ?>
</form>					