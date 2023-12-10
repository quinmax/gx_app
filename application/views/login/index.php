<?php
$img_login_logo = array('src' => base_url() . 'res/images/login_logo', 'alt' => 'Logo', 'class' => 'login_logo mb_med')
?>

<div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">

	<!-- Logo: image -->
	<div>
		<?php echo img($img_login_logo); ?>
	</div>

	<!-- Title -->
	<div class="login_title mb_med">
		Please Login
	</div>

	<!-- Enter username: Label & input -->
	<div>Username</div>
	<div class="mt_sml">
		<?php echo form_input('cred_1', 'applicant_001', 'id="cred_1" style="" placeholder="Enter Username"'); ?>
	</div>

	<!-- Enter password: Label & input -->
	<div class="mt_med">Password</div>
	<div class="mt_sml">
		<?php echo form_input('cred_2', 'app001', 'id="cred_2" style="" placeholder="Enter Password"'); ?>
	</div>

	<!-- Submit login credentials -->
	<div class="action_button mt_med" onclick="login.checkLogin()">Login</div>

	<!-- Dsiplay login error -->
	<div id="login_error" class="login_error mt_med">Invalid username or password. Please try again.</div>

	<!-- Forgot password: not active (demo) -->
	<div class="forgot mt_med">Forgot password</div>

</div>
