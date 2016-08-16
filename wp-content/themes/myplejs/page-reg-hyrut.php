<?php
/*
Template Name: Registrering Uthyrare
*/
?>
<?php get_header(); ?>
<style>
	 body .gform_wrapper div.gform_body ul.gform_fields li.gfield.gfield_html ul li,
    body .gform_wrapper form div.gform_body ul.gform_fields li.gfield.gfield_html ul li {
        list-style-type: none !important;
    }
</style>
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
		<!-- sidebar -->
		<aside id="sidebar" class="col-xs-12 col-sm-4">
			<div class="bluebg">


				<!-- lang switch -->
	
				<?php
				$currentlang = get_bloginfo('language');
				if($currentlang=="en-US"):
				?>
					<h2>HOW IT WORKS</h2>
					<?php if(get_field('reg_uthyrare_steg_en')): ?>
					<?php while(has_sub_field('reg_uthyrare_steg_en')): ?>
					<div class="box selectedbox">
						<h3><?php the_sub_field('reg_uthyrare_steg_rubrik_en'); ?></h3>
						<p><?php the_sub_field('reg_uthyrare_steg_innehall_en'); ?></p>
					</div>
					<?php endwhile; ?>
					
					<?php endif; ?>
					
					<?php if(get_field('reg_uthyrare_tips_en')): ?>
					
					<h2>TIPS</h2>
					<?php while(has_sub_field('reg_uthyrare_tips_en')): ?>
					<div class="tips-box">
						<h3><?php the_sub_field('reg_uthyrare_tips_title_en'); ?></h3>
						<img src="<?php the_sub_field('reg_uthyrare_tips_icon_en'); ?>" />
						<p><?php the_sub_field('reg_uthyrare_tips_content_en'); ?></p>
					</div>
					<?php endwhile; ?>
					
					<p><?php the_field('reg_uthyrare_text_en'); ?></p>
					
					<?php endif; ?>
	
				<?php else: ?>

					<h2>SÅ FUNKAR DET</h2>
					<?php if(get_field('reg_uthyrare_steg')): ?>
					<?php while(has_sub_field('reg_uthyrare_steg')): ?>
					<div class="box selectedbox">
						<h3><?php the_sub_field('reg_uthyrare_steg_rubrik'); ?></h3>
						<p><?php the_sub_field('reg_uthyrare_steg_innehall'); ?></p>
					</div>
					<?php endwhile; ?>
					
					<?php endif; ?>
					
					<?php if(get_field('reg_uthyrare_tips')): ?>
					
					<h2>TIPS</h2>
					<?php while(has_sub_field('reg_uthyrare_tips')): ?>
					<div class="tips-box">
						<h3><?php the_sub_field('reg_uthyrare_tips_title'); ?></h3>
						<img src="<?php the_sub_field('reg_uthyrare_tips_icon'); ?>" />
						<p><?php the_sub_field('reg_uthyrare_tips_content'); ?></p>
					</div>
					<?php endwhile; ?>
					
					<p><?php the_field('reg_uthyrare_text'); ?></p>
					
					<?php endif; ?>
			
				<?php endif; ?>
				<!-- end lang switch -->



				
			</div>
		</aside>
		<!-- end sidebar -->
		<!-- content -->
		<article id="post-<?php the_ID(); ?>" class="col-xs-12 col-sm-8">
			<?php if( get_field('notice_activate')):?>
			<p class="notice"><?php the_field('notice_text');?></p>
			<?php endif; ?>
			
			<h1 class="page-title" itemprop="headline">
			<?php if(get_field('alt_title')): the_field('alt_title'); else : ?>
			<?php the_title(); ?>
			<?php endif; ?>
			</h1>
			<section class="post-content clearfix" itemprop="articleBody">
				<?php the_content(); ?>
				</section> <!-- end article section -->
				
				</article> <!-- end article -->
				<!-- end content -->
				
				<?php endwhile;  endif; ?>
			</div>
		</div>
		<?php
		// ------------------------- execute function (defined in functions.php) -------------------------
		change_date_format_for_object('obj_move');
		?>
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