<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>

<?php
if ((!empty($_REQUEST['sent']))&&(!empty($_REQUEST['login']))&&(!empty($_REQUEST['pswd']))) {
	core::debug($_REQUEST);
	$login = htmlspecialchars($_REQUEST['login']);
	$pswd = htmlspecialchars($_REQUEST['pswd']);
	$user->setLogin($login,$pswd);
} ?>

<?php
// core::debug ($user->getID());
// core::debug ($user->islogin().'7'); 
core::debug ($user); 
if ($user->islogin()) {
	include './admin/controller.php' ;
} else {
 	?>
	<div id="login" class="login">
		<form action="?act=admin" method="POST">
			<input type="text" name="login"><br />
			<input type="password" name="pswd"><br />
			<input type="submit" name="sent">
		</form>
	</div>
<?php } ?>