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
		<a href="https://twitter.com/share" class="twitter-share-button" data-via="BoDVa">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</div>
	<?php
//} ?>