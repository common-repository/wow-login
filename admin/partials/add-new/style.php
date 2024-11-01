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
?>


<div class="itembox">
	<div class="item-title">
		<h3>General style of button</h3>		
		<div class="wow-admin-col">
			<div class="wow-admin-col-4"> 
				Padding: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="5px 20px"> 				
			</div>	
			<div class="wow-admin-col-4"> 
				Border: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="1px">									
			</div>
			<div class="wow-admin-col-4"> 
				Border Radius: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="3px"> 					
			</div>
			
		</div>
		<div class="wow-admin-col">
			<div class="wow-admin-col-4"> 
				Font size text: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="18px"> 												
			</div>
			<div class="wow-admin-col-4"> 
				Font size icon: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="18px">												
			</div>	
			<div class="wow-admin-col-4"> 
				Display icon: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<select disabled>
					<option>Before text</option>
				</select>																
			</div>
			
		</div>
		<div class="wow-admin-col">
			<div class="wow-admin-col-4"> 
				Margin between icon and text: <a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="5px"> 												
			</div>
			<div class="wow-admin-col-4"> </div>
			<div class="wow-admin-col-4"> </div>
		</div>
	</div>	
</div>

<div class="itembox">
	<div class="item-title">
		<h3>Email login style</h3>		
		
		<div class="wow-admin-col">
			<div class="wow-admin-col-4"> 
				Height:<a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="32px"> 				
			</div>	
			<div class="wow-admin-col-4"> 
				Width:<a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="100%">				
			</div>	
			<div class="wow-admin-col-4"> 
				Border:<a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="2px"> 					
			</div>
			
			
		</div>
		<div class="wow-admin-col">
			<div class="wow-admin-col-4"> 
				Border Radius:<a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="2px">					
			</div>			
			
			<div class="wow-admin-col-4"> 
				Font size:<a href='admin.php?page=<?php echo $this->slug;?>&tab=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br/>
				<input type="text" disabled value="16px"> 					
			</div>
			
			<div class="wow-admin-col-4"> 
				Field font color:<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
				<img src="<?php echo $this->plugin_url; ?>admin/partials/img/black.jpg"> 					
			</div>
			
			
		</div>
		<div class="wow-admin-col">
			<div class="wow-admin-col-4"> 
				Border color:<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
				<img src="<?php echo $this->plugin_url; ?>admin/partials/img/border.jpg"> 					
			</div>
			<div class="wow-admin-col-4"> 
				Field background:<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
				<img src="<?php echo $this->plugin_url; ?>admin/partials/img/white.jpg"> 					
			</div>
			
			<div class="wow-admin-col-4"> 
				Button font color:<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
				<img src="<?php echo $this->plugin_url; ?>admin/partials/img/white.jpg">												
			</div>
		</div>
		<div class="wow-admin-col">	
			
			<div class="wow-admin-col-4"> 
				Button background:<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
				<img src="<?php echo $this->plugin_url; ?>admin/partials/img/black.jpg"> 												
			</div>
			<div class="wow-admin-col-4"> 
				Button hover background:<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
				<img src="<?php echo $this->plugin_url; ?>admin/partials/img/green.jpg">												
			</div>
			<div class="wow-admin-col-4"> </div>
		</div>
	</div>	
</div>
