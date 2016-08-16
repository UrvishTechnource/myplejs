<?php
/*
Template Name: Startsida
*/
?>
<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<!-- INLOGGAD -->
<?php if ( is_user_logged_in() ): ?>
<!-- Start toppblock -->
<section id="logged-in" class="fullw topp-block-front-inloggad">
	<div class="container">
		<div class="row">
			<!-- pushade pbjekt -->
			<article class="col-xs-12 col-md-9">
				<div class="slickslider row">
					<?php $posts = get_field('featured',74); if( $posts ):
					foreach( $posts as $post_object): ?>
					<div>
						<!-- obj info -->
						<div class="col-xs-12 col-sm-4">
							<div class="objektinfo">
								<h1><a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID); ?>"><?php echo get_the_title($post_object->ID); ?></a></h1>
								<ul>
									<li class="antalrum"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Rooms<?php else: ?>Antal rum<?php endif; ?><br/><b><?php the_field ('obj_rooms', $post_object->ID); ?></b></li>
									<li class="storlek"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Size<br/><b><?php the_field ('obj_size', $post_object->ID); ?> sqm</b></li><?php else: ?>Storlek<br/><b><?php the_field ('obj_size', $post_object->ID); ?> kvm</b></li><?php endif; ?>
									<li class="inflytt">
										<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
										Moving in date<br/><?php if (get_field('obj_move', $post_object->ID)): ?><b><?php the_field ('obj_move', $post_object->ID); ?></b>
									</li>
									<?php else: ?>
									<b>Immediately</b><?php endif; ?>
								</li><?php else: ?>	Inflyttningsdatum<br/>
								<?php if (get_field('obj_move', $post_object->ID)): ?>
							<b><?php the_field ('obj_move', $post_object->ID); ?></b></li>
							<?php else: ?>
							<b>Omgående</b>
						</li><?php endif; ?>
						
						<?php endif; ?>
					</ul>
					
					<div class="btn-small-green"><a href="<?php echo get_permalink($post_object->ID); ?>" title="<?php echo get_the_title($post_object->ID); ?>"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Show object<?php else: ?>Visa objekt<?php endif; ?></a></div>
					
				</div>
			</div>
			<!-- end objinfo -->
			<!-- obj bild -->
			<div class="col-xs-12 col-sm-8 removebootright">
				<div class="bildoverflow">
					<?php
					if ( has_post_thumbnail($post_object->ID) ) {
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_object->ID ), 'sliderstart' );
					echo '<a href="' . get_permalink($post_object->ID) . '"><img style="width:100%;" src="' . $image[0] . '"/></a>';
					}
					else {
					// none
					}
					?>
				</div>
			</div>
			<!-- end bild -->
		</div>
		<?php endforeach; endif; ?>
	</div>
</article>
<!-- nyhetsbox -->
<article class="col-xs-12 col-md-3 news-box">
	<?php
	global $query_string;
	query_posts($query_string . "post_type=post&post_status=publish&posts_per_page=1");
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	?>
	<h2><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>LATEST NEWS<?php else: ?>SENASTE NYTT<?php endif; ?></h2>
	<article id="post-<?php the_ID(); ?>"  class="hentry">
		<header class="article-header">
			<h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
			<p class="meta"><time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time> </p>
			</header> <!-- end article header -->
			<section class="post-content clearfix">
				<?php echo get_excerpt(195); ?>
				</section> <!-- end article section -->
				
				</article> <!-- end article -->
				<?php endwhile;
				endif; ?>
				<?php wp_reset_query(); ?>
			</article>
		</div>
	</div>
</section>
<!-- End toppblock -->
<?php else: ?>
<!--- NOT LOGGED IN  -->
<!-- Start bildblock -->
<section class="fullw topp-block-front">
	<?php
	$imageID = get_field('start_image');
	$image = wp_get_attachment_image_src( $imageID, 'full' );
	$alt_text = get_post_meta($imageID , '_wp_attachment_image_alt', true);
	?>
	<img id="backImageOut" src="<?php echo $image[0]; ?>" alt="myplejs background image">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<!-- text i bildblock -->
				<header class="infoblock">
					<h1><?php the_field('start_headline') ?></h1>

					<!-- ingress -->
					<?php
					$currentlang = get_bloginfo('language');
					if($currentlang=="en-US"):
					?>
					<p>Welcome to myplejs.se.<br> 
					We help people everyday in Stockholm with finding and renting out apartments. <br>
					We have done this since 2009. Start immediately, we will help you on your way!</p>
					<?php else: ?>

					<p>Välkommen till myplejs.se.<br> 
					Varje dag så hjälper vi människor med att hitta och att hyra ut lägenheter i Stockholm.<br>
					Detta har vi gjort sedan 2009. Kom igång direkt, vi hjälper dig på vägen!</p>

					<?php endif; ?>
					<!-- end ingress -->	
					
					<div class="knappcontainer clearfix">
						<div class="btn-big-green">
							<a href="<?php echo site_url(); ?><?php the_field('start_btn_1_url') ?>">
								<h2><?php the_field('start_btn_1_headline') ?></h2>
								<span><?php the_field('start_btn_1_text') ?></span>
							</a>
						</div>
						<div class="btn-big-blue">
							<a href="<?php echo site_url(); ?><?php the_field('start_btn_2_url') ?>">
								<h2><?php the_field('start_btn_2_headline') ?></h2>
								<span><?php the_field('start_btn_2_text') ?></span>
							</a>
						</div>
					</div>
					<!-- <?php if (get_field('start_badge_en')): ?><img alt="ingen avgift innan påskrivet kontrakt" class="badge" src="<?php the_field('start_badge_en') ?>" /><?php endif; ?> -->
					
				</header>
				<?php
				$currentlang = get_bloginfo('language');
				if($currentlang=="en-US"):
				?>
				
				<?php else: ?>
				
				
				<aside class="betygreco">
					<span>5/5 i betyg hos <a rel="nofollow" target="_blank" href="https://www.reco.se/myplejs"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/reco-logo.png" alt="reco logotyp"></a></span>
				</aside>
				
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<!-- End bildblock -->
<!-- Stanna loop och användarcheck -->
<?php endif; ?>
<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
<div id="listawrapper">
	<!-- Lägenheter och filtreringar -->
	<div class="objlist-header-bg">
		<div class="container">
			<div class="row">
				<!-- headerfiltrering -->
				<div class="col-xs-12">
					<div id="objlist-header" class="clearfix">
						
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
				
				<div class="presentation clearfix">
					<?php the_field('start_text') ?>
					
				</div>
				<a class="sharebox" target="_blank" href="https://www.facebook.com/myplejs?fref=ts" rel="nofollow">
					<div class="share">
						<?php
						$currentlang = get_bloginfo('language');
						if($currentlang=="en-US"):
						?>
						<p>Like us on Facebook to see new appartments directly when they come up on the website.</p>
						<?php else: ?>
						<p>Gilla oss på Facebook och ta del av nya boenden direkt när de kommer upp på hemsidan.</p>
						<?php endif; ?>
						
						<i class="fa fa-facebook-square"></i>
					</div>
				</a>
				<div class="fmi text-center">
					<?php
					$currentlang = get_bloginfo('language');
					if($currentlang=="en-US"):
					?>
					<span>We are members of The Swedish Estate Agents Inspectorate.</span>
					<a href="http://www.fmi.se/default.aspx?id=1752" rel="nofollow">
						<img src="<?php echo get_stylesheet_directory_uri() ?>/images/fmi-logo.png" alt="fmi logotyp">
					</a>
					
					<?php else: ?>
					
					
					<span>Vi är medlemmar i Fastighetsmäklarinspektionen. Effektiv tillsyn för trygg fastighetsförmedling med nöjda parter.</span>
					<a href="http://www.fmi.se/" rel="nofollow">
						<img src="<?php echo get_stylesheet_directory_uri() ?>/images/fmi-logo.png" alt="fmi logotyp">
					</a>
					<?php endif; ?>
					
				</div>
			</a>
		</div>
		<!-- end obj-filter-sidebar -->
		<!-- lägenheter -->
		<div class="col-xs-12 col-sm-9">
			<div class="row">
				<!-- lägenhetswrap -->
				<div id="objlist-wrap" class="clearfix">
					<!-- gridlista -->
					<ul id="listing" class="lista">
						<?php $args = array(
						'post_type' => 'objects',
						'post_status' => 'publish',
						'posts_per_page' => 100,
						'orderby' => 'post_date',
						'order' => 'DESC'
						);  ?>
						<?php query_posts( $args ); ?>
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<!-- start singlelägenhet -->
						<li class=" obj-sort">
							<div class="objlist grid">
								<div class="col-xs-12 col-sm-6 col-lg-4">
									<div class="obj clearfix">
										<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												
											$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'object-thumb-250' );
											$url = $thumb['0'];
											echo '<img alt="Hyr lägenhet i Stockholm:'.get_the_title().' " src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/bild-laddas.png"  data-src="' . $url.'"/>';
											}
											else {
											echo '<img alt="default image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/bild-kommer.png" />';
											}
											?>
											
											<div class="objinfo">
												<!-- titel -->
												<h3><?php the_title(); ?></h3>
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
													<?php
													$currentlang = get_bloginfo('language');
													if($currentlang=="en-US"):
													?>
													Read more
													<?php else: ?>
													Hyr lägenhet
													<?php endif; ?>
													<i class="fa fa-chevron-circle-right"></i>
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
$(window).load(function() {
$('img').unveil(200);
});
</script>
<script type="text/javascript">
var options = {
valueNames: [ 'antalrum','storlek','pris','inflytt','langd' ],
};
var userList = new List('listawrapper', options);
</script>