<?php get_header(); ?>
<div id="listawrapper">
	<!-- Lägenheter och filtreringar -->
	<div class="objlist-header-bg">
		<div class="container">
			<div class="row">
				<!-- headerfiltrering -->
				<div class="col-xs-12">
					<div id="objlist-header" class="clearfix">
						<h2><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Current objects<?php else: ?>Aktuella objekt<?php endif; ?></h2>
						<!-- ändra list view -->
						<div class="change-buttons">
							<span id="list-change" class=""></span>
							<span id="view-change" class="vc-sel"></span>
						</div>
						<ul>
							<li class="sort" data-sort="antalrum"><a class="switch srt-def "><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rooms<?php else: ?>Antal rum<?php endif; ?></a></li>
							<li class="sort" data-sort="storlek"><a id="sort-size" class="switch srt-def "><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Size<?php else: ?>Storlek<?php endif; ?></a></li>
							<li class="sort" data-sort="pris"><a id="sort-price" class="switch srt-def "><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Price/month<?php else: ?>Pris/månad<?php endif; ?></a></li>
							<li class="sort" data-sort="inflytt"><a id="sort-move" class="switch srt-def "><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Moving in date<?php else: ?>Inflyttning<?php endif; ?></a></li>
							<li class="sort" data-sort="langd"><a id="sort-lenght" class="switch srt-def "><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Length of rental<?php else: ?>Hyreslängd<?php endif; ?></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end headerfiltrering -->
	<div class="container">
		<div class="row">
			<!-- sidebar -->
			<div class="col-xs-12 col-sm-3">
				<div id="obj-filter-sidebar">
					<?php
					$currentlang = get_bloginfo('language');
					if($currentlang=="en-US"):
					?>
					<h2>Customize search</h2>
					<div id="startfilter" role="complementary" class="clearfix">
						<?php echo do_shortcode("[ULWPQSF id=161209]"); ?>
					</div>
					<?php else: ?>
					<h2>Anpassa sökning</h2>
					<div id="startfilter" role="complementary" class="clearfix">
						<?php echo do_shortcode("[ULWPQSF id=161207]"); ?>
					</div>
					
					<?php endif; ?>
				</div>
			</div>
			<!-- end obj-filter-sidebar -->
			<!-- lägenheter -->
			<div class="col-xs-12 col-sm-9">
				<div class="row">
					<!-- lägenhetswrap -->
					<div id="objlist-wrap" class="clearfix">
						<!-- gridlista -->
						<ul id="listing" class="lista">
							
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<!-- start singlelägenhet -->
							<li class=" obj-sort">
								<div class="objlist grid">
									<div class="col-xs-12 col-sm-6 col-lg-4">
										<div class="obj clearfix">
											<?php
											if ( has_post_thumbnail() ) {
											the_post_thumbnail('object-thumb-250');
											}
											else {
											echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/default.png" />';
											}
											?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
												<div class="objinfo">
													<!-- titel -->
													<h2><?php the_title(); ?></h2>
													<!-- info om lgh -->
													<ul>
														<?php if (get_field('obj_rooms')): ?>
														<li class="antalrum"><span class="sort-room"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rooms:<?php else: ?>Antal rum:<?php endif; ?></b> <?php the_field ('obj_rooms'); ?></span></li>
														<?php endif; ?>
														<?php if (get_field('obj_size')): ?>
														<li class="storlek"><span class="sort-size"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Size:</b> <?php the_field ('obj_size'); ?></span> sqm</li><?php else: ?>Storlek:</b> <?php the_field ('obj_size'); ?></span> kvm</li><?php endif; ?>
														<?php endif; ?>
														<?php if (get_field('obj_rent')): ?>
														<li class="pris"><span class="sort-price"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rent:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php else: ?>Hyra:</b> <?php the_field ('obj_rent'); ?></span> SEK</li><?php endif; ?>
														<?php endif; ?>
														<?php if (get_field('obj_move')): ?>
														
														<?php
														// generate timestamp from obj_move
														$date = get_field('obj_move');
														$timestamp = 0;
														if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
														$timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
														}
														?>
														<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
														<li class="inflytt"><b>Moving in date:</b>
															<?php
															// print omgående or date
															$today = time();
															if ( $timestamp < $today ) {
															_e('Immediately', 'myplejs');
															} else {
															echo get_field('obj_move');
															}
															?>
														</li>
														<?php else: ?>
														<li class="inflytt"><b>Inflytt:</b>
															<?php
															// print omgående or date
															$today = time();
															if ( $timestamp < $today ) {
															_e('Omgående', 'myplejs');
															} else {
															echo get_field('obj_move');
															}
															?>
														</li>
														<?php endif; ?>
														<?php endif; ?>
														<?php if (get_field('obj_contractlenght')): ?>
														<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
														<li class="langd">
															<span class="sort-lenght"><b>Length of rental: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Until further notice', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
															<?php if ($value_lenght == '1') { _e('month', 'myplejs'); }
															elseif ($value_lenght == '100') { }
															else { _e('months', 'myplejs'); } ?>
														</li>
														<?php else: ?>
														<li class="langd">
															<span class="sort-lenght"><b>Hyreslängd: </b><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
															<?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
															elseif ($value_lenght == '100') { }
															else { _e('månader', 'myplejs'); } ?>
														</li>
														<?php endif; ?>
														<?php endif; ?>
													</ul>
													<!-- område -->
													<span class="omrade"><b><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Where: <?php else: ?>Vart: <?php endif; ?></b>
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
												</div>
											</a>
											<!-- end objinfo -->
											<!-- check for bookmark -->
											<?php if(get_post_meta($post->ID, "user_bookmark", true)=='1') :
											$bookmarked = ' bookmarked';
											endif; ?>
											<div class="btns-wrap <?php echo $bookmarked; ?>">
												<div class="btn-small">
													<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<span class="btn-pil"></span>
														<?php
														$currentlang = get_bloginfo('language');
														if($currentlang=="en-US"):
														?>
														Read more
														<?php else: ?>
														Läs mer
														<?php endif; ?>
													</a>
												</div>
												<?php echo $my_bookmark_button->bookmark_button(); ?>
											</div>
											<!-- end btns-wrap -->
										</div>
									</div>
									<!-- end obj -->
								</div>
							</li>
						<!-- end singlelägenhet -->
						<?php endwhile;endif; ?>
					</ul>
					<!-- end gridlista -->
					<?php wp_reset_query(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	<?php get_footer(); ?>

	<script src="<?php echo get_stylesheet_directory_uri() ?>/dev_packs/mixpanel.js"></script>

<script type="text/javascript">
function getURLParameter(name) {
  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
}

utm_source = getURLParameter('utm_source');
// create cookie if utm_source is set in the url
if (utm_source) {
    var newDate = new Date(new Date().getTime() + 30*24*60*60*1000);
    document.cookie = 'utmsourcetoken=utm_source:' + utm_source + '; expires=' + newDate + '; path=/';
}

// track Visit event in mixpanel
mixpanel.init("6bb01f7cb7489082e6b49e891ba9a115", {
    loaded: function() {
    	mixpanel.track("Visit");
    }
});

</script>
<!-- sortering -->
<script type="text/javascript">
var options = {
valueNames: [ 'antalrum','storlek','pris','inflytt','langd' ],
};
var userList = new List('listawrapper', options);
</script>