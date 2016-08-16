<div class="obj obj-minsida">
	
	<?php include('obj-details.php') ?>
	<?php
	if(get_post_status() == 'pending') {
	?><div class="pending">pending</div><?php
	} else {
	
	};
	?>
	<?php
	if(get_post_status() == 'draft') {
	?><div class="pending">draft</div><?php
	} else {
	
	};
	?>
	<div class="btns-wrap">
		<div class="btn-small" style="margin-top: 15px;"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Visa</a></div>
		
		</div> <!-- end btns-wrap -->
		</div> <!-- end obj -->