<?php
/*
Template Name: Sortera efter hyrestagare
*/
?>
<?php get_header(); ?>

<?php if ( is_user_logged_in() ): ?>

<?php global $user_ID; if( $user_ID ) : ?>
<?php if( current_user_can('level_10') ) : ?>

<div id="inner-content" class="container clearfix">
	<div class="row">
		<!-- Sidebar -->
		<div class="col-xs-12 col-sm-3">
			<div id="obj-filter-sidebar">
				<div  role="complementary">
					<?php echo do_shortcode("[ULWPQSF id=159113 button=1]"); ?>
				</div>
			</div>
		</div> 
		<!-- end obj-filter-sidebar -->
		<!-- start listing -->
		<div id="listing">
			<div class="col-xs-12 col-sm-9">
				<!-- <div id="objlist-header" class="clearfix">
					<h2>Mailadress & Stadsdel</h2>
					<ul>
						<li class="sort" data-sort="rum"><a class="switch srt-def "><?php _e('Antal rum', 'myplejs'); ?></a></li> 
						<li class="sort" data-sort="storlek"><a  class="switch srt-def "><?php _e('Storlek', 'myplejs'); ?></a></li>
						<li class="sort" data-sort="pris"><a  class="switch srt-def "><?php _e('Pris/månad', 'myplejs'); ?></a></li>
						<li class="sort" data-sort="inflytt"><a class="switch srt-def "><?php _e('Inflyttning', 'myplejs'); ?></a></li>
						<li class="sort" data-sort="langd"><a  class="switch srt-def "><?php _e('Hyreslängd', 'myplejs'); ?></a></li>
					</ul>	
				</div> -->
			</div>
			<!-- end header -->

			<!-- content wrap -->
			<div id="objlist-wrap" class="clearfix">

			<!-- application list -->
			<div class="col-xs-12 col-sm-9">
				<!-- list -->
				<ul id="objektenlista" class="lista">
				<?php 
				    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					 $args = array(
					'post_type' => 'app',
					'posts_per_page' => 16,
					'orderby' => 'post_date',
					'order' => 'DESC',
					'paged' => $paged,
					'date_query' => array(
							        array(
							            'column' => 'post_date_gmt',
							            'after'  => '40 days ago',
							        )
							),
					'post_status' => array('published, draft')
					
				);?>
				<?php query_posts( $args ); ?>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<li class="obj-sort clearfix">
						<a target="_blank" href="https://mail.google.com/mail/u/0/#search/<?php the_title(); ?>?compose=new">
							<h2><?php the_title(); ?></h2>
						</a>
						</br>
							<!-- stadsdel -->
							<h4><?php $terms = get_the_terms($post->ID,'obj_city');
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
							echo "$list"; ?>
							</h4>
							<!-- inlinelist -->
							<ul class="inlinelist">
								<!-- antal rum -->
								<?php if (get_field('obj_rooms')): ?>
								<li class="rum"><?php the_field ('obj_rooms'); ?></li>
								<?php endif; ?>
								
								<!-- storlek -->
								<?php if (get_field('obj_size')): ?>
								<li class="storlek"><?php the_field ('obj_size'); ?> <?php _e('kvm', 'myplejs'); ?></li>
								<?php endif; ?>
								
								<!-- hyra -->
								<?php if (get_field('obj_rent')): ?>
								<li class="pris"><?php the_field ('obj_rent'); ?> SEK</li>
								<?php endif; ?>

								<!-- inflyttningsdatum -->
								<?php if (get_field('obj_move')): ?>
								<li class="inflytt"><span value="<?php $date = get_field('obj_move');?>">
								<?php
								$today = time();
								if($timestamp<$today):
									_e('Omgående', 'myplejs');
									else :
									echo get_field('obj_move');							
									endif; ?>
									</span></li>
								<?php else: ?>
									<li>Omgående</li>
								<?php endif; ?>
								
								<!-- hyrestid -->
								<?php if (get_field('obj_contractlenght')): ?>
								<li class="langd">
									<span><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
									
										<?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
										
										elseif ($value_lenght == '100') { }
										
										else { _e('månader', 'myplejs'); } ?>
										
								</li>
								<?php endif; ?>						
							</ul><!-- inlinelist -->
					</li>
				<?php endwhile;endif; ?>
				</ul>
				<!-- list -->	
			</div>
			<!-- application list -->
		</div>
		<!-- end listing -->
		</div>
	</div> 
	<!-- end content wrap -->
</div>
<?php endif; ?>
<?php endif; ?>

<?php else: ?>

<!-- Om man inte är admin, spotta ut detta -->
<?php header("Location: http://myplejs.se/404.php"); /* Redirect browser */
exit(); ?>


<?php endif; ?>	


<?php get_footer(); ?>


<script type="text/javascript">


var options = {
  valueNames: [ 'rum','storlek','pris','inflytt','langd' ],
};

var userList = new List('listing', options);


</script>
 

