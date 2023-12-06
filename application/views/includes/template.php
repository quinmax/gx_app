<!DOCTYPE html>
<html lang="en" class="qc_theme">
<head>

    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>GX App</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/skeleton.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/main.css?v=1.0"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/modal_flat.css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>res/css/litepicker.css"/>

    <!-- Scripts
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <script type="text/javascript" src="<?php echo base_url(); ?>res/js/main.js?v=1.0"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/litepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>res/js/daypilot-modal-3.15.1.min.js"></script>

    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>res/images/favicon.png">

    <!-- Font awesome
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

	<div id="app_container">
		<!-- <div class="main_container"> -->
			<?php $this->load->view($main_content); ?>
		<!-- </div> -->
	</div>

	<!-- Form overlay 	
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div id="form_overlay"></div>
	<!-- END: Form overlay -->

	<!-- View overlay 	
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div id="view_overlay"></div>
	<!-- END: View overlay -->

	<!-- Spinner 
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<div id="loader"></div>
	<!-- END: Spinner -->

</body>
</html>
