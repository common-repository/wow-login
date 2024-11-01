<?php if ( ! defined( 'ABSPATH' ) ) exit;
	include( 'users/class-users-table.php' );	
	$customers_table = new Wow_Login_Pro_Users($this->slug);
	$customers_table->prepare_items();
?>	 
<div class="wrap">
	<h2>Users</h2>
	
	<form method="post" class="wow-login-table">		
		<?php			
			$customers_table->search_box( __( 'Search User', 'users-activity' ), 'users-activity' );
			$customers_table->display();
		?>		
		<input type="hidden" name="page" value="<?php echo $_REQUEST['page']; ?>" />	
		<?php wp_nonce_field('wow_login_export_action','wow_login_export_field'); ?>
	</form>
</div>
