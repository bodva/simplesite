<?php include('_config.php'); ?>
<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>

<html>
<head>
	<title>Dmitry Boyko | BoDVa</title>
	<link  href="./style.css" type="text/css" rel="Stylesheet" />
    <!-- <script src="./jquery/jquery.js" type="text/javascript"></script> 
    <script src="./jquery/jquery-ui.js" type="text/javascript"></script> -->
    <script src="./script.js" type="text/javascript"></script>
</head>
<body>
	<div id="page" class="page">
		<div id="cnt" class="cnt">
			<?php include './template/parts/header.php'; ?>
			<div id="body" class="body">
				<?php include './controllers/content.php'; ?>
			</div>
			<div id="footer" class="footer" align="center">
				<?php include './template/parts/footer.php'; ?>
			</div>
		</div>
		<div id="sidebar" class="sidebar">
			<?php include './template/parts/sidebar.php'; ?>
		</div>
	</div>
</body>
</html>