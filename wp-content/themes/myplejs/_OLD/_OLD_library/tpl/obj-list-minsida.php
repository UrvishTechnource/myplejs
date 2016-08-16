<div class="obj obj-minsida">
	
					<?php include('obj-details.php') ?>

<?php 
if(get_post_status() == 'pending') {
   ?><div class="pending">Under granskning</div><?php
}
elseif(get_post_status() == 'draft') {
   ?><div class="pending">Ej publicerad</div><?php
}
  else {
   
};
 ?>
					<div class="btns-wrap">
						<div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Visa</a></div>
						

						<?php $langcode = $my_transposh_plugin->target_language;?>
				        <?php if ($langcode == 'sv'): ?>
				        <div class="btn-small"><a href="/?page_id=371&gform_post_id=<?php echo $postid; ?>"><span class="btn-pil"></span>Ändra</a></div>
				        <?php elseif ($langcode == 'en'): ?>
				        <div class="btn-small"><a href="/?page_id=371&gform_post_id=<?php echo $postid; ?>&lang=en"><span class="btn-pil"></span>Edit</a></div>
				        <?php endif; ?>
						
						
						
					</div> <!-- end btns-wrap -->

</div> <!-- end obj -->