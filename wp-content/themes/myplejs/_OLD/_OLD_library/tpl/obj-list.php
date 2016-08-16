<div class="obj <?php
	if(get_post_status() == 'pending') {
	?>pending<?php
	} else {
	
	};
	?>
	<?php
	if(get_post_status() == 'draft') {
	?>draft<?php
	} else {
	
	};
	?>">
	
	<?php include('obj-details.php') ?>
	
	<!-- check for bookmark -->
	<?php if(get_post_meta($post->ID, "user_bookmark", true)=='1') :
		$bookmarked = ' bookmarked';
	endif; ?>
	<div class="btns-wrap <?php echo $bookmarked; ?>">
		<div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Läs mer</a></div>
		<?php echo $my_bookmark_button->bookmark_button(); ?>
		
		</div> <!-- end btns-wrap -->
		</div> <!-- end obj -->