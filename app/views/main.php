<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui" />
	<title>Page Title</title>
	
	<!-- Main CSS -->
	<link rel="stylesheet" href="/MVC/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="/MVC/css/TimeCircles.css">
	<link rel="stylesheet" href="/MVC/css/styles.css">

	<!-- Payload CSS -->
	<?php echo Payload::get_css(); ?>

	<!-- Modernizr -->
	<script src="/MVC/bower_components/modernizr/modernizr.js"></script>
</head>
<body>

	<div class="page">
		<?php echo $primary_header; ?>
		<?php echo $main_content; ?>
	</div>

	<!-- Include Common Scripts -->
	<script src="/MVC/bower_components/jquery/dist/jquery.js"></script>
	<script src="/MVC/js/TimeCircles.js"></script>
	<script src="/MVC/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/MVC/bower_components/ReptileForms/dist/reptileforms.js"></script>

	<!-- Get JS -->
	<script>var app = {};app.settings=<?php echo Payload::get_settings(); ?>;</script>
	<?php echo Payload::get_js(); ?>
	
	<!-- Main JS -->
	<script src="/MVC/js/meeting.js"></script>
	<script src="/MVC/js/detail.js"></script>

</body>
</html>