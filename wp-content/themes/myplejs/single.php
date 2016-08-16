<?php get_header(); ?>
<div id="content" class="container">
	<div class="row">
		<div class="col-xs-12">
			<!-- breadcrumb -->
			<div class="breadcrumbs">
				<span class="spanleft">
					<?php if(function_exists('bcn_display'))
					{
					bcn_display();
					}?>
				</span>
				<span class="tillbaka"><a href="javascript:history.back();"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Back</a><?php else: ?>Tillbaka</a><?php endif; ?></span>
			</div>
			<!-- end breadcrumb -->
		</div>
	</div>
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<!-- content -->
		<article id="post-<?php the_ID(); ?>" class="col-xs-12">
			<h1 class="page-title" itemprop="headline">
			<?php if(get_field('alt_title')): the_field('alt_title'); else : ?>
			<?php the_title(); ?>
			<?php endif; ?>
			</h1>
			<p class="meta">Postat: <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time('F jS, Y'); ?></time> </p>
			<section class="post-content clearfix" itemprop="articleBody">
				<?php the_content(); ?>
				</section> <!-- end article section -->
				
				</article> <!-- end article -->
				<!-- end content -->
				<?php endwhile; ?>
				
				
				<?php endif; ?>
				
				
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
		
	

