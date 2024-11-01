<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	/**
		* Services
		*
		* @package     
		* @subpackage  Settings
		* @copyright   Copyright (c) 2017, Dmytro Lobov
		* @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
		* @since       1.0
	*/
	
	include ('settings/'.$m_current.'.php');	
	
?>


<div class="tab-box wow-admin">
	<ul class="tab-nav">
		<li><a href="#t1"><i class="fa fa-facebook"></i> Facebook</a></li>	
		<li><a href="#t2"><i class="fa fa-google"></i> Google</a></li>
		<li><a href="#t3"><i class="fa fa-twitter"></i> Twitter</a></li>
		<li><a href="#t4"><i class="fa fa-linkedin"></i> LinkedIn</a></li>
		<li><a href="#t5"><i class="fa fa-at"></i> Email</a></li>
		
	</ul>
	
	<div class="tab-panels">
		<div id="t1">
			<?php include ('login/facebook.php'); ?>
		</div>
		<div id="t2">
			<?php include ('login/google.php'); ?>
		</div>
		<div id="t3">
			<?php include ('login/twitter.php'); ?>
		</div>
		<div id="t4">
			<?php include ('login/linkedin.php'); ?>
		</div>	
		<div id="t5">
			<?php include ('login/email.php'); ?>
		</div>	
	</div>
</div>



