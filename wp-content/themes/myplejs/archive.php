<?php get_header(); ?>
			
			<div id="content">
			
				<div id="inner-content" class="wrap clearfix news">
				
				<?php include('library/tpl/breadcrumbs.php') ?>
			
				    <div id="main" class="left-content-col clearfix" role="main">
				    
				 <?php /* If this is a category archive */ if (is_category()) { ?>
				<h1 class="pagetitle">Nyhetsarkiv / <?php single_cat_title(); ?></h1>

			<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
				<h1 class="pagetitle">Inlägg märkte med &#8216;<?php single_tag_title(); ?>&#8217;</h1>

			<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				<h1 class="pagetitle">Nyhetsarkiv / <?php the_time('F jS, Y'); ?></h1>

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				<h1 class="pagetitle">Nyhetsarkiv / <?php the_time('F, Y'); ?></h1>

			<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				<h1 class="pagetitle">Nyhetsarkiv / <?php the_time('Y'); ?></h1>

			<?php /* If this is an author archive */ } elseif (is_author()) { ?>
				<h1 class="pagetitle">Nyhetsarkiv / </h1>

			<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				<h1 class="pagetitle">Nyhetsarkiv</h1>
							
			<?php } ?>

					    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" class="entry">
					    
					    <?php if ( has_post_thumbnail()) the_post_thumbnail('bones-thumb-200'); ?>
						
						    <header class="article-header">
						    							
							    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							
							    <p class="meta"><?php _e('Postat', 'bonestheme'); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate><?php the_time(get_option('date_format')); ?></time></p>
						
						    </header> <!-- end article header -->
					
						    <section class="post-content clearfix">
							    <?php the_excerpt(); ?>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">

    							<p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>

						    </footer> <!-- end article footer -->
						    
						    <?php // comments_template(); // uncomment if you want to use them ?>
					
					    </article> <!-- end article -->
					
					    <?php endwhile; ?>	
					
					        <?php if (function_exists('bones_page_navi')) { // if experimental feature is active ?>
						
						        <?php bones_page_navi(); // use the page navi function ?>
						
					        <?php } else { // if it is disabled, display regular wp prev & next links ?>
						        <nav class="wp-prev-next">
							        <ul class="clearfix">
								        <li class="prev-link"><?php next_posts_link(_e('&laquo; Older Entries', 'bonestheme')) ?></li>
								        <li class="next-link"><?php previous_posts_link(_e('Newer Entries &raquo;', 'bonestheme')) ?></li>
							        </ul>
						        </nav>
					        <?php } ?>		
					
					    <?php else : ?>
					    
					        <article id="post-not-found" class="hentry clearfix">
					            <header class="article-header">
					        	    <h1><?php _e("Oops, Post Not Found!", "bonestheme"); ?></h1>
					        	</header>
					            <section class="post-content">
					        	    <p><?php _e("Uh Oh. Something is missing. Try double checking things.", "bonestheme"); ?></p>
					        	</section>
					        	<footer class="article-footer">
					        	    <p><?php _e("This is the error message in the index.php template.", "bonestheme"); ?></p>
					        	</footer>
					        </article>
					
					    <?php endif; ?>
			
				    </div> <!-- end #main -->
    
				    <?php get_sidebar(); // sidebar 1 ?>
				    
				</div> <!-- end #inner-content -->
    
			</div> <!-- end #content -->

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











