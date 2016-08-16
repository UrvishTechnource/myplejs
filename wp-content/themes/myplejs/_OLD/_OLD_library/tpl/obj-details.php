<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('object-thumb-250');
					}
					else {
						echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/library/images/default.png" />';
					}
					?>

					<div class="objinfo">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<ul>
						<?php if (get_field('obj_rooms')): ?>
						<li class="antalrum"><span class="sort-room"><?php the_field ('obj_rooms'); ?></span></li>
						<?php endif; ?>
						<?php if (get_field('obj_size')): ?>
						<li class="storlek"><span class="sort-size"><?php the_field ('obj_size'); ?></span> <?php _e('kvm', 'myplejs'); ?></li>
						<?php endif; ?>
						<?php if (get_field('obj_rent')): ?>
						<li class="pris"><span class="sort-price"><?php the_field ('obj_rent'); ?></span> SEK</li>
						<?php endif; ?>
						<?php if (get_field('obj_move')): ?>
						<li class="inflytt"><span class="sort-move" value="<?php $date = get_field('obj_move'); $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp(); echo $timestamp; ?>">
						
							
							<?php
							$today = time();
							if($timestamp<$today):
								_e('Omgående', 'myplejs');
								else :
								echo get_field('obj_move');							
								endif; ?>
			
						</span></li><?php endif; ?>
						
						
						<?php if (get_field('obj_contractlenght')): ?>
	<li class="langd">
		<span class="sort-lenght"><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
		
			<?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
			
			elseif ($value_lenght == '100') { }
			
			else { _e('månader', 'myplejs'); } ?>
			
	</li>
<?php endif; ?>						
					</ul>
					<span>
						
				

						<?php $terms = get_the_terms($post->ID,'obj_city');
						$sep = '';
						$list = '';
						$find_parent = 0;
						for( $i = 0; $i < sizeof($terms); ++$i) {
						   foreach ($terms as $term) {
						      if ($term->parent == $find_parent) {
						         $find_parent = $term->term_id;
						         $list .= $sep .$term->name;
						         $sep = ', ';
						      }
						   }
						}
						echo "$list"; ?>, <span class="no_translate"><?php the_field('obj_address'); ?></span>
					</span>
										
					</div> <!-- end objinfo -->