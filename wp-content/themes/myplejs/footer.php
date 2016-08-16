<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="inner-footer" class="wrap clearfix">
					<?php
								if ( is_user_logged_in() ) {
					
									$defaults = array(
										'theme_location'  => 'member-nav',
										'menu'            => 'The Main Menu Logged In',
										'container'       => 'nav',
										'container_class' => 'footermenu-screen',
										'container_id'    => '',
										'menu_class'      => '',
										'menu_id'         => '',
										'echo'            => true,
										'fallback_cb'     => 'wp_page_menu',
										'before'          => '',
										'after'           => '',
										'link_before'     => '',
										'link_after'      => '',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'depth'           => 0,
									'walker'          => ''
									);
									wp_nav_menu( $defaults );
				
							} else {
				
								$defaults = array(
									'theme_location'  => 'main-nav',
									'menu'            => 'The Main Menu',
									'container'       => 'nav',
									'container_class' => 'footermenu-screen',
									'container_id'    => '',
									'menu_class'      => '',
									'menu_id'         => '',
									'echo'            => true,
									'fallback_cb'     => 'wp_page_menu',
									'before'          => '',
									'after'           => '',
									'link_before'     => '',
									'link_after'      => '',
								'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
								'walker'          => ''
								);
								wp_nav_menu( $defaults );
			}?>
			<p class="footer-seo"><?php the_field('sidfooter-seo','options'); ?></p>
			<p class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>.</p>
			
			</div> <!-- end inner footer -->
		</div>
	</div>
</div>
<!-- end container -->
</footer>
<!-- end footer -->
<!-- mobil menu trigger -->
<div class="mobile-header">


<a href="#mobile-nav">
	<i class="fa fa-bars"></i>
</a>

<div class="langswitch">
	
	<?php
	$currentlang = get_bloginfo('language');
	if($currentlang=="en-US"):
	?>
	<a href="<?php echo site_url(); ?>">
		<img alt="swedish flag" src="<?php echo get_template_directory_uri(); ?>/images/sweden-flag.png" class="langswitch">
	</a>
	<?php else: ?>
	<a href="<?php echo site_url(); ?>/en/">
		<img alt="english flag" src="<?php echo get_template_directory_uri(); ?>/images/uk-flag.png" class="langswitch">
	</a>
	<?php endif; ?>
	
</div>

<!-- logo mobile -->
<a href="<?php echo home_url(); ?>" rel="nofollow"><img class="logotype-mob" src="<?php echo get_stylesheet_directory_uri() ?>/images/myplejslogo.png" alt="myplejs logotyp"></a>
<!-- end logo mobile -->
</div>
<!-- end mobil menu trigger -->
<!-- mobile menu -->
<?php
if ( is_user_logged_in() ) {
	$defaults = array(
	'theme_location'  => 'member-nav',
	'menu'            => 'The Main Menu Logged In',
	'container'       => 'nav',
	'container_class' => 'topmenu-screen inloggad',
	'container_id'    => 'mobile-nav',
	'menu_class'      => 'mobmenu-ul',
	'menu_id'         => 'mobmenu',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
	);
	wp_nav_menu( $defaults );
} else {
	$defaults = array(
	'theme_location'  => '',
	'menu'            => 'The Main Menu',
	'container'       => 'nav',
	'container_class' => 'topmenu-screen',
	'container_id'    => 'mobile-nav',
	'menu_class'      => 'mobmenu-ul',
	'menu_id'         => 'mobmenu',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
	);
	wp_nav_menu( $defaults );
}
?>
<!-- end mobile menu -->
<!-- scroll to top arrow -->
<div class="scroll-toTop">
<i class="fa fa-arrow-up"></i>
</div>
<!-- end scroll to top arrow -->
<?php wp_footer();  ?>




</body>
</html> <!-- end page -->