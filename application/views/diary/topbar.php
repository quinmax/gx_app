<?php
	$img_topbar_logo = array('src' => 'res/images/topbar_logo.png', 'style' => 'display: block; padding-right: 40px;');
	$img_ico_user = array('src' => 'res/images/ico_user.png', 'style' => 'display: block;');
	$img_ico_logout = array('src' => 'res/images/ico_logout.png', 'style' => 'display: block;');
?>
<div class="topbar">

	<div class="middle"><?php echo img($img_topbar_logo); ?></div>
	<div class="menu_btn">Diary</div>
	<div class="middle">&nbsp;</div>
	<div class="middle">&nbsp;</div>
	
	<div class="menu_item_container middle mr_lrg">
		<div><?php echo img($img_ico_user); ?></div>
		<div>Applicant_001</div>
	</div>

	<div class="menu_item_container middle"  onclick="login.logout()">
		<div><?php echo img($img_ico_logout); ?></div>
		<div>Logout</div>
	</div>

</div>
