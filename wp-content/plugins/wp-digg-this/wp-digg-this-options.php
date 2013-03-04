<div class="wrap" style="max-width:950px !important;">
	<h2>WP Digg This</h2>
				
	<div id="poststuff" style="margin-top:10px;">
		<div id="sideblock" style="float:right;width:220px;margin-left:10px;"> 
				 <h3>Information</h3>
				 <div id="dbx-content" style="text-decoration:none;">
					  <img src="<?php echo $imgpath ?>/home.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/wordpress-plugins/wp-digg-this"> WP Digg This Home</a><br /><br />
			 <img src="<?php echo $imgpath ?>/rate.png"><a style="text-decoration:none;" href="http://wordpress.org/extend/plugins/wp-digg-this/"> Rate this plugin</a><br /><br />			 
			 <img src="<?php echo $imgpath ?>/help.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/forum"> Support and Help</a><br />			 
			 <p>
			 <a style="text-decoration:none;" href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=2567254"><img src="<?php echo $imgpath ?>/paypal.gif"></a>			 
			 </p><br />		 
			 <img src="<?php echo $imgpath ?>/more.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/wordpress-plugins"> Cool WordPress Plugins</a><br /><br />
			 <img src="<?php echo $imgpath ?>/twit.png"><a style="text-decoration:none;" href="http://twitter.com/vprelovac"> Follow updates on Twitter</a><br /><br />			
			 <img src="<?php echo $imgpath ?>/idea.png"><a style="text-decoration:none;" href="http://www.prelovac.com/vladimir/services"> Need a WordPress Expert?</a>
 		
		 		</div>
		 	</div>

	 <div id="mainblock" style="width:710px">
	 
		<div class="dbx-content">
		 	<form action="<?php echo $action_url ?>" method="post">
					<input type="hidden" name="submitted" value="1" /> 
					<?php wp_nonce_field('wp-digg-this'); ?>
					
					<h2>Options</h2>	
					
					<p>By Default Wp Digg This displays the button only on single pages.</p>
					<p>Display Digg button also on:</p>						
					<input type="checkbox" name="home"  <?php echo $home ?> /><label for="home"> Home Page</label>  <br />																						
					<input type="checkbox" name="category"  <?php echo $category ?> /><label for="category"> Category Pages</label>  <br />																						
					<input type="checkbox" name="archive"  <?php echo $archive ?> /><label for="archive"> Archive Pages</label>  <br />																						
					<input type="checkbox" name="search"  <?php echo $search ?> /><label for="search"> Search Results Pages</label>  <br />																						
					
					<p>If you use one of these options make sure you use full posts and not excerpts on these pages.</p><br />
					
					<p>By default WP Digg This will add the button to the beginning of the post. Check the box below if you want to append the button to the post end.</p>
					<input type="checkbox" name="after"  <?php echo $after ?> /><label for="after"> Button After Post</label>  <br />																						
					
					<br /><p>Enter the template for the button. Use {button} to replace actual button.</p>
					<input type="text" name="template" size="80" value="<?php echo $template ?>"/><br/>
																								
					<div class="submit"><input type="submit" name="Submit" value="Update" /></div>
			</form>
		</div>
				
	<br/><br/><h3>&nbsp;</h3>	
	 </div>

	</div>
	
<h5>WordPress plugin by <a href="http://www.prelovac.com/vladimir/">Vladimir Prelovac</a></h5>
</div>

