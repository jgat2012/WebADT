<div class="container-fluid">
	<!-- Login header -->
	<?php echo $this->load->view('header_login');?>
	<!-- Login header end -->
	
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4">
			<div class="well no-padding">
				<form action="http://192.241.236.31/test4.smartadmin/index.html" id="login-form" class="smart-form client-form">
					<header>
						Sign In
					</header>
		
					<fieldset>
						
						<section>
							<label class="label">Please Enter your E-mail / Username</label>
							<label class="input"> <i class="icon-append fa fa-user"></i>
								<input type="email" name="email">
								<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter email address/username</b></label>
						</section>
		
						<section>
							<label class="label">Password</label>
							<label class="input"> <i class="icon-append fa fa-lock"></i>
								<input type="password" name="password">
								<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
							<div class="note">
								<a href="<?php echo base_url();?>user/forgot_pass">Forgot password?</a>
							</div>
						</section>
					</fieldset>
					<footer>
						<button type="submit" class="btn btn-primary">
							Sign in
						</button>
					</footer>
				</form>
		
			</div>
			
		</div>		
	</div>
</div>

