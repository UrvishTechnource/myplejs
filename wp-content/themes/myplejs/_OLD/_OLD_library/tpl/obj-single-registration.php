
<div class="obj obj-minsida">
	
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('object-thumb-250');
					}
					else {
						echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/library/timthumb.php?src=' . get_bloginfo( 'stylesheet_directory' ) . '/library/images/default.png&w=150&q=90" />';
					}
					?>

					<div class="objinfo" style="width: 550px !important;">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<ul>
						<li class="antalrum"><span class="sort-room"><?php the_field ('obj_rooms'); ?></span></li>
						<li class="storlek"><span class="sort-size"><?php the_field ('obj_size'); ?></span> <?php _e('kvm', 'myplejs'); ?></li>
						<li class="pris"><span class="sort-price"><?php the_field ('obj_rent'); ?></span> SEK</li>
						<li class="inflytt"><span class="sort-move" value="<?php $date = get_field('obj_move'); $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp(); echo $timestamp; ?>">
							
							<?php
							$today = time();
							if($timestamp<$today):
								_e('Omgående', 'myplejs');
								else :
								echo get_field('obj_move');							
								endif; ?>
			
						</span></li>
						<li class="langd"><span class="sort-lenght"><?php the_field ('obj_contractlenght'); ?></span> <?php $value_lenght = get_field( "obj_contractlenght" );
                        	if ($value_lenght == 'Tillsvidare') { } elseif ($value_lenght == '1') { _e('månad', 'myplejs'); } else { _e('månader', 'myplejs'); } ?></li>
						
					</ul>
					<span>
						<?php print_taxonomy_ranks( get_the_terms( $post->ID, 'obj_city' ) ); ?>
					</span>
										
					</div> <!-- end objinfo -->

<div class="btns-wrap">
						<div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Visa</a></div>
						
					</div> <!-- end btns-wrap -->

</div> <!-- end obj -->
