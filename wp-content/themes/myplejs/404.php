<?php get_header(); ?>
<div id="content">
	<div id="inner-content" class="wrap clearfix">
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="col-xs-12">
					
					<header class="article-header">
						
						<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?><h1><?php _e("Wops, cant find this page :(", "bonestheme"); ?></h1><?php else: ?><h1><?php _e("Oj, sidan går ej att visa :(", "bonestheme"); ?></h1><?php endif; ?>
						
						</header> <!-- end article header -->
						
						<section class="post-content">
							
							<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?><p><?php _e("Please try again!", "bonestheme"); ?></p><?php else: ?><p><?php _e("Sidan du letar efter går ej att visa. Det kan bero på..<br/><br/>..att sidan är borttagen.<br/>..att du inte har rättighet att se den.<br/>..att du har skrivit fel adress.", "bonestheme"); ?></p><?php endif; ?>
							
						</section>
				</div>
			</div>
		</div>
		</div>
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

			