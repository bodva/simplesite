<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>
<?php
core::debug($_REQUEST);
if ($user->islogin()) {
	$adminmenu = array();
	$id = 0;
	$adminmenu['$id']['mod'] = 'entry';
	$adminmenu['$id']['name'] = 'Entrys';
	$id = 1;
	$adminmenu['$id']['mod'] = 'about';
	$adminmenu['$id']['name'] = 'About';

	?>
	<div>
		<a href="?act=admin">Admin main</a>
	</div>
	<?
	if (empty($_REQUEST['mod'])) {
		?>
		<div>
			<?php
				foreach ($adminmenu as $v) {
					core::debug($v['mod']);
				 	echo '<div>';
				 	echo '<a href="?act=admin&mod='.$v['mod'].'">'.$v['name'].'</a>';
				 	echo '</div>';
				 	echo '<div id="separator" class="seperator"></div>';
				 } 
			?>
		</div>
	<?php
	} else {
		core::debug($_REQUEST['mod']);
		$mod = $_REQUEST['mod'];
		if (empty($_GET['id'])){
			$obj = new $mod;
			$entrys = $obj->admintable();
			?>
			<div>
				<a href="?act=admin&mod=<?php echo $mod; ?>&id=-1">Add</a>
			</div>
			<div>Entry's list:</div>
			<?php
			foreach ($entrys as $entry) {
				core::debug($entry);
				?>
				<div>
					<a href="?act=admin&mod=<?php echo $mod; ?>&id=<?php echo $entry['id']; ?>"><?php echo $entry['title']; ?></a>
				</div>
				<?php
				//core::debug($mod::getEntrys());
			}
		} else {
			?>
			<div><a href="?act=admin&mod=<?php echo $mod; ?>">Back to the module menu</a></div>
			<?php
			$eid = $_GET['id'];

			if (!empty($_REQUEST['save'])) { $eid = $mod::save($eid);}

			$obj = new $mod;
			// $obj->id = $eid;
			$content = '<form method="POST" action="?act=admin&mod='.$mod.'&id='.$eid.'">';
			$content.= $obj->adminentry($eid);
			$content.= '</form>'; 

			echo $content;
		}
		// core::debug($obj);
	}
	?>
	<div><a href="?act=logout">log out</a></div>
	<?php
} else {
	die ('session error. please relogin.');
}
?>