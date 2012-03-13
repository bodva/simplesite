<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>

<?php 
if (!empty($_REQUEST['act'])) {
	$act =  $_REQUEST['act'];
	core::debug($act);
	switch ($act) {
		case 'admin':
			include './admin/index.php';
			break;
		case 'logout':
			include './admin/logout.php';
			include './template/index.php';
			break;
		case 'index':
			include './template/index.php';
			break;		
		case 'about':
			include './template/about.php';
			break;		
		default:
			include './template/index.php';
			break;
	}
} elseif (!empty($_REQUEST['id'])) {
		$id = (int)$_REQUEST['id'];
		if (entry::isexist($id)) {
			$entry = new entry;
			$entry->load($id);
			include './template/entry.php';
		} else {
			include './template/404.php';
		}
} else {
	include './template/index.php';
}
?>