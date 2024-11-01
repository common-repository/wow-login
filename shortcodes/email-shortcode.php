<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Email Shortcode
		*
		* @package     
		* @subpackage  Shortcode
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	
	$account = ( isset( $_POST['wow_login_email']) ) ? sanitize_email( $_POST['wow_login_email'] ) : false;
	$nonce = ( isset( $_POST['nonce']) ) ? sanitize_key( $_POST['nonce'] ) : false;
	$error_token = ( isset( $_GET['wow_error_token']) ) ? sanitize_key( $_GET['wow_error_token'] ) : false;
	
	
	$sent_link = self::send_link($account, $nonce, $redirect);
	
	
	if( $account && !is_wp_error($sent_link) ){
		echo $param['email_success_text'];
	} 
	
	
	else {
		if ( is_wp_error($sent_link) ){
			echo apply_filters( 'wow_error', $sent_link->get_error_message() );
		}
		if( $error_token ) {
			echo $param['email_invalid_token'];
		}
		
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		
		$button = !empty($button) ? $button : 'Log In';
		$text = !empty($text) ? $text : '';
	?>
	<form name="wowloginform" id="wowloginform" action="" method="post">
		<p>					
			<input type="text" name="wow_login_email" id="wow_login_email" class="input" placeholder="<?php echo esc_attr( $text ); ?>" value="<?php echo esc_attr( $account ); ?>" size="25" />
			<input type="submit" name="wow-submit" id="wow-submit" class="button-primary" value="<?php echo esc_attr( $button ); ?>" />
		</p>								
		<?php wp_nonce_field( 'wow_login_request', 'nonce', false ) ?>
		
	</form>	
	<?php
	}	