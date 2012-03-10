<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>

<?php 
if (!empty($_REQUEST['act'])) {
	$act =  $_REQUEST['act'];
	core::debug($act);
	switch ($act) {
		case 'admin':
			include '/admin/index.php';
			break;
		case 'logout':
			include '/admin/logout.php';
			include '/template/index.php';
			break;
		case 'index':
			include '/template/index.php';
			break;		
		case 'about':
			include '/template/about.php';
			break;		
		default:
			include '/template/index.php';
			break;
	}
} else {
	include '/template/index.php';
}
?>