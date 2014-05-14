<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta name="description" content="adt kenya">
		<meta name="keywords" content="adt,hiv,kenya,nascop,commodities">
		<meta name="author" content="criat">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="HandheldFriendly" content="True">
		<title><?php echo @$title;?></title>
		<!--Load styles-->
		<?php $this -> load -> view('styles');?>
		
		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		<script src="<?php echo base_url();?>assets/scripts/plugin/pace/pace.min.js"></script>
	
	    <!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
	    <script src="<?php echo base_url();?>assets/scripts/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script> if (!window.jQuery) { document.write('<script src="<?php echo base_url();?>assets/scripts/libs/jquery-2.0.2.min.js"><\/script>');} </script>
	
	    <script src="<?php echo base_url();?>assets/scripts/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
		<script> if (!window.jQuery.ui) { document.write('<script src="<?php echo base_url();?>assets/scripts/libs/jquery-ui-1.10.3.min.js"><\/script>');} </script>


	</head>
	<body id="body">
		<div id="wrap">
			<!--Load Menu-->
			<?php
			if (isset($hide_menu)) {
				
			}
			else{// If menu is not hidden, show it
				$this -> load -> view('menu');
			}
			?>
			<!--Load Side Menu-->
			<div class="container-fluid">
				<div id="body_wrapper" class="row">
					<?php
	               if (isset($hide_sidemenu)) {//If side is to be displayed, show it
					?>
					<div class="col-md-12">
						<?php
						//load content
						$this -> load -> view(@$content_view);
						?>
					</div>
					
					<?php
					}else{
					?>
					<div class="col-md-3">
						<?php
						$this -> load -> view('sidemenu');
						?>
					</div>
					<div class="col-md-9">
						<?php
						//load content
						$this -> load -> view(@$content_view);
						?>
					</div>
					<?php
					}
					?>
				</div>
			</div>
			
		</div>
		<!--Load Footer-->
		<?php $this -> load -> view('footer');?>
		
		<!--Load scripts-->
		<?php $this -> load -> view('scripts');?>
	</body>
</html>