<?php

//this template is for admin views of applications

get_header(); ?>

<div id="content">

	<div id="inner-content" class="wrap clearfix news">
				
		<div class="breadcrumbs">
				
			<span class="tillbaka"><a href="javascript:history.back();"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Back</a><?php else: ?>Tillbaka</a><?php endif; ?></span>
		
		</div>
			
	<div id="main" class="eightcol first clearfix" role="main">
	
	<?php if ( current_user_can('manage_options') ) : ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
			<header class="article-header">
							
				<h1 class="single-title" itemprop="headline"><?php the_title(); ?></h1>
							
				<p><?php _e("Ansökan skapad ", "bonestheme"); ?> <?php the_time('d/m/Y') ?> kl: <?php the_time('H:i') ?></p>
						
			</header> <!-- end article header -->
					
			<section class="post-content clearfix" itemprop="articleBody">
									
				<h3><?php _e('Kontaktuppgifter', 'myplejs'); ?></h3>
									
				<table class="compact">
					<tr>
						<td><b>Fullständigt namn</b></td>
						<td><b>Telefon</b></td>
						<td><b>E-post</b></td>
					</tr>
										
					<tr>                            			
											<td><?php the_author_meta( 'user_lastname' ); ?></td>
											<td><?php the_author_meta( 'telefon' ); ?></td>
											<td><?php the_author_meta( 'user_email' ); ?></td>
							            </tr>
									</table>
									
									<?php // get the current logged in user
									$userid = $post->post_author; ?>
									
						<?php endwhile; endif; ?>
						
						
							<!-- Intressen -->
								
									
									<h3><?php _e('Intressen', 'myplejs'); ?></h3>
									
									<?php
									
										$args = array(
										'post_type' => 'registration',
										'posts_per_page' => -1,
										'post_status' => array('publish', 'pending'),
										'meta_query' => array(
												array(
													'key' => 'reg_user_id',
													'value' => $userid,
													'compare' => '=',
													'type' => 'NUMERIC'
												),
												array(
													'key' => 'reg_status',
													'value' => 'Intresserad',
													'compare' => '=',
													'type' => 'CHAR'
												)
											)
										);
						
								query_posts( $args );?>
								
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								
									<?php $data = get_field('reg_obj_id'); $regids[]=$data; ?>
									
						        <?php endwhile; ?>
						        
						        <?php else : ?>
						        
						        		null
						        		
						        <?php endif; ?>
						        
								<?php wp_reset_query(); ?>
								
								<?php
                                        $args = array(
                                          'post_type' => 'objects',
                                          'posts_per_page' => -1,
                                          'post__in' => $regids,
                                          'post_status' => array('publish', 'pending')
                                          );
                                        query_posts($args);
                                        ?>
                                        
                                <?php if ( have_posts() ) : ?>
								
								<table class="compact">
								
										<thead>
										<tr>
											<th><b>Objekt</b></th>
											<th><b>Antal rum</b></th>
											<th><b>Storlek</b></th>
											<th><b>Pris</b></th>
											<th><b>Hyreslängd</b></th>
										</tr>
										</thead>
										
										<tbody>
										
								<?php while ( have_posts() ) : the_post(); ?>
								
										<?php require('library/tpl/obj-compact.php') ?>
									
						        <?php endwhile; ?>
						        
										</tbody>
								</table>
						        
						        <?php else : ?>
						        		null
						        <?php endif; ?>
								<?php wp_reset_query(); ?>
               
								
								
								
								<!-- Ej intresserad -->
						
															
									<h3><?php _e('Ej intresserad längre', 'myplejs'); ?></h3>
									
										<?php
									
										$args = array(
										'post_type' => 'registration',
										'posts_per_page' => -1,
										'post_status' => array('publish', 'pending'),
										'meta_query' => array(
												array(
													'key' => 'reg_user_id',
													'value' => $userid,
													'compare' => '=',
													'type' => 'NUMERIC'
												),
												array(
													'key' => 'reg_status',
													'value' => 'Inte intresserad',
													'compare' => '=',
													'type' => 'CHAR'
												)
											)
										);
						
								query_posts( $args );?>
								
								<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								
									<?php $data_noreg = get_field('reg_obj_id'); $regids_noreg[]=$data_noreg; ?>
								
						        <?php endwhile; ?>
						        
						        <?php else : ?>
						        
						        		null
						        		
						        <?php endif; ?>
						        
								<?php wp_reset_query(); ?>
								
								<?php
                                        $args = array(
                                          'post_type' => 'objects',
                                          'posts_per_page' => -1,
                                          'post__in' => $regids_noreg,
                                          'post_status' => array('publish', 'pending')
                                          );
                                        query_posts($args);
                                        ?>
                                        
                                        <?php if ( have_posts() ) : ?>
								
								<table class="compact">
								
										<thead>
										<tr>
											<th><b>Objekt</b></th>
											<th><b>Antal rum</b></th>
											<th><b>Storlek</b></th>
											<th><b>Pris</b></th>
											<th><b>Hyreslängd</b></th>
										</tr>
										</thead>
										
										<tbody>
										
								<?php while ( have_posts() ) : the_post(); ?>
								
									<?php require('library/tpl/obj-compact.php') ?>	
									
						        <?php endwhile; ?>
						        
										</tbody>
								</table>
						        
						        <?php else : ?>
						        		null
						        <?php endif; ?>
								<?php wp_reset_query(); ?>
			
								
								
								<!-- Bokmärkta -->
									
									<h3><?php _e('Bokmärkta', 'myplejs'); ?></h3>
									
									
									<?php
									
										$args = array(
                                          'post_type' => 'objects',
                                          'posts_per_page' => -1,
                                          'post_status' => 'publish',
                                          'meta_key' => 'user_bookmark',
                                          'meta_value' => $userid
                                          );
						
								query_posts( $args );?>
								
								<?php if ( have_posts() ) : ?>
								
								<table class="compact">
								
										<thead>
										<tr>
											<th><b>Objekt</b></th>
											<th><b>Antal rum</b></th>
											<th><b>Storlek</b></th>
											<th><b>Pris</b></th>
											<th><b>Hyreslängd</b></th>
										</tr>
										</thead>
										
										<tbody>
										
								<?php while ( have_posts() ) : the_post(); ?>
								
									<?php require('library/tpl/obj-compact.php') ?>		
									
						        <?php endwhile; ?>
						        
										</tbody>
								</table>
						        
						        <?php else : ?>
						        		null
						        <?php endif; ?>
								<?php wp_reset_query(); ?>
									
									
								</section> <!-- end article section -->
					
							</article> <!-- end article -->
							
					<?php endif; ?>		
			
					</div> <!-- end #main -->
    
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