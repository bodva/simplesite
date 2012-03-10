<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>
<?php  
$objs = about::getEntrys(); 
?>
<h2>About page</h2>
<?php
foreach ($objs as $entry) {
	?>
	<div class="single-post">
				<?php echo $entry->title; ?>: <?php echo $entry->content; ?>
		<div class="separator"></div>
	</div>
	<?php
} ?>