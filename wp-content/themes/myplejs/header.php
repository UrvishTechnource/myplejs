<!DOCTYPE html>
<html <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title(''); ?></title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/x-icon" />
		
		<?php wp_head(); ?>
		
		<!-- Hotjar Tracking Code for https://myplejs.se/ -->
		<script>
		    (function(h,o,t,j,a,r){
		        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
		        h._hjSettings={hjid:136443,hjsv:5};
		        a=o.getElementsByTagName('head')[0];
		        r=o.createElement('script');r.async=1;
		        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
		        a.appendChild(r);
		    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
		</script>

	</head>
	<body <?php body_class(); ?> >
		<!--[if lte IE 8]>
		<div class="alert-warning text-center"> 'Du använder en gammal webbläsare. Var vänlig att <a href="http://browsehappy.com/">uppdatera din webbläsare</a> för att denna hemsida ska fungera korrekt. </div>
		<![endif]-->
		<div id="page">
			<div class="topMe"></div>
			<!-- screen menu -->
			<div id="menu-trigger-id" class="menu-wrap">
				<div class="container">
					<div class="row">
					
						<!-- lang switch -->
						<div class="col-xs-12">
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
						</div>
						<!-- end lang switch -->
						<div class="col-xs-12">
							<!-- logo -->
							<a href="<?php echo home_url(); ?>" rel="nofollow"><img class="logoscreen" src="<?php echo get_stylesheet_directory_uri() ?>/images/myplejslogo.png" alt="myplejs logotyp"></a>
							
							
							<?php
							if ( is_user_logged_in() ) {
							
										$defaults = array(
											'theme_location'  => 'member-nav',
											'menu'            => 'The Main Menu Logged In',
											'container'       => 'nav',
											'container_class' => 'topmenu-screen inloggad',
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
										'container_class' => 'topmenu-screen',
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
						
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!-- end screen menu -->
	<div class="pagecontainer">