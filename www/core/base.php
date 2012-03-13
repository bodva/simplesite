<?php
if (!defined('defSimpleSite')) {die("Use site core!");}

$kbase = new kconfig();

include('core.php');

include('db.php');
kdb::connect();

include('user.php');
$user = new kuser;

include('./modules/entry/entry.php');
include('./modules/about/about.php');
// include('./module/flash.php');
// include('./module/lens.php');
// include('./module/memory.php');
// include('./module/tripop.php');
// include('./module/phototech.php');
?>