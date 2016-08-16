<?php if( get_field('notice_activate')):?>
									<p class="notice"><?php the_field('notice_text');?></p>
								<?php endif; ?>
						    
						    	<h1 class="page-title" itemprop="headline">
						    	<?php if(get_field('alt_title')): the_field('alt_title'); else : ?>
							    <?php the_title(); ?>
								<?php endif; ?>
								</h1>