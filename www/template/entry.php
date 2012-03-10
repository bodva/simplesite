<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>
<?php // core::debug(entry::getEntrys()); ?>
<?php  
//$objs = entry::getEntrys(); 
//foreach ($objs as $entry) {
	?>
	<div class="single-post">
		<div class="title">
			<div class="date" title="<?php echo date("Y-d-m H:i:s",$entry->title); ?>">
				<?php echo $entry->title; ?>
			</div>					
		</div>
		<div class="content">
			<?php echo $entry->content; ?>
		</div>
		<div class="separator"></div>
	</div>
	<?php
//} ?>