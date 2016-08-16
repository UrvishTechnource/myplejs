<div class="obj obj-minsida">
	
	<?php include('obj-details.php') ?>
	
	<?php echo $delete_bookmark_button->delete_bookmark_button(); ?>
	<?php
	if(get_post_status() == 'pending') {
	?><div class="pending">Ej publicerad</div><?php
	} else {
	
	};
	?>
	<div class="btns-wrap">
		<div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Visa</a></div>
		</div> <!-- end btns-wrap -->
		</div> <!-- end obj -->