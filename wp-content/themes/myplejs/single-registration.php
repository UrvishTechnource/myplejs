<?php get_header(); ?>
<?php // get the user
$userid = $post->post_author;
$objid = get_field( 'reg_obj_id' );
$reguserid = get_field( 'reg_user_id' );
$obj_autrel = get_post($objid);
$obj_autid = $obj_autrel->post_author;

?>
<?php
$post_tmp = get_post($objid);
?>
<?php
$user_id = $post_tmp->post_author;
?>
<?php
$first_name = get_the_author_meta('first_name',$user_id);
?>

<div id="content" class="container">
	<div class="row">
		<div class="col-xs-12">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="sreg-topwrap" style="height: 160px;">
				<div style="float: left;">
					<p><?php _e("Intresseanm&auml;lan skapad ", "bonestheme"); ?> <?php the_time('d/m/Y') ?> kl: <?php the_time('H:i') ?></p>
					<h1 style="margin-bottom: 5px !important;"><?php the_title(); ?> </h1>
					<h1 class="objtitle">Status: <?php the_field( 'reg_status' ); ?> <a href="/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit"><img src="<?php echo get_template_directory_uri(); ?>/images/icon-form-edit.png" /></a></h1>
				</div>
				<div style="float: right; margin-top: 40px;">
					<div class="btn-small-green" style="width: 204px !important; background-position: 208px -360px !important; margin: 10px 0;">
						<a href="https://docs.google.com/a/incontext.se/spreadsheet/viewform?formkey=dFFlUFJObDV2X2tMR3pvUlV6WE13R1E6MQ
							&entry_0=<?php echo the_field( 'obj_rooms', $objid ); ?>
							&entry_1=<?php echo the_field( 'obj_size', $objid ); ?>
							&entry_2=<?php echo the_field( 'obj_furnished', $objid ); ?>
							&entry_4=<?php echo the_field( 'obj_address', $objid ); ?>
							&entry_5=<?php echo the_field( 'obj_postalcode', $objid ); ?>
							&entry_6=<?php print_contract_city( get_the_terms( $objid, 'obj_city' ) ); ?>
							&entry_8=<?php echo the_field( 'obj_rent', $objid ); ?>
							&entry_9=<?php echo the_field( 'obj_downpayment', $objid ); ?>
							&entry_13=<?php echo the_field( 'obj_move', $objid ); ?>
							&entry_18=<?php echo the_author_meta( 'user_firstname' , $obj_autid); ?> <?php echo the_author_meta( 'user_lastname' , $obj_autid); ?>
							&entry_23=<?php echo esc_attr( get_the_author_meta( 'user_email' , $obj_autid ) ); ?>
							&entry_24=<?php echo esc_attr( get_the_author_meta( 'telefon' , $obj_autid ) ); ?>
							&entry_26=<?php echo esc_attr( get_the_author_meta( 'foretag' ) ); ?>
							&entry_31=<?php echo esc_attr( get_the_author_meta( 'user_firstname' ) ); ?><?php echo esc_attr( get_the_author_meta( 'user_lastname' ) ); ?>
							&entry_32=<?php echo esc_attr( get_the_author_meta( 'user_e' ) ); ?>
							&entry_33=<?php echo esc_attr( get_the_author_meta( 'telefon' ) ); ?>" target="_blank"><span class="btn-pil" style="background-position: -738px -180px !important;"></span>Skapa kontrakt</a>
						</div>
						<div class="btn-small-green" style="width: 204px !important; background-position: 208px -360px !important; margin: 10px 0;">
							<a href="/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit" target="_blank"><span class="btn-pil" style="background-position: -738px -180px !important;"></span>Uppdatera status</a>
						</div>
					</div>
				</div>
				<div id="sreg-wrap">
					<div id="sreg-userinfo">
						
						<?php $profileimage = get_the_author_meta( "profilbild", $userid ); ?>
						
			
						<div>
							<a style="font-size: 17px !important; color: #333 !important;" href="/applications/<?php the_author_meta( 'user_email' ); ?>/"><?php the_author_meta( 'user_firstname' ); ?> <?php the_author_meta( 'user_lastname' ); ?></a>
							<br/><a href="https://mail.google.com/mail/u/0/?shva=1#search/<?php the_author_meta( 'user_email' ); ?>" target="_blank"><?php the_author_meta( 'user_email' ); ?></a>
							<br/><?php the_author_meta( 'telefon' ); ?>
						</div>
						
						
					</div>
					
					
					
					<?php endwhile; ?>
					
					<?php else : ?>
					
					<h1>Denna intresseanm&auml;lan existerar inte l&auml;ngre!</h1>
					
					<?php endif; ?>
					
					<?php wp_reset_query(); ?>
					
					
					<?php
								
									$args = array(
					'post_type' => 'app',
					'posts_per_page' => 1,
					'post_status' => array('publish', 'pending', 'draft'),
					'author' => $userid
					);
					
					query_posts( $args );?>
					
					
					<?php if ( have_posts() ) : ?>
					
					<?php while ( have_posts() ) : the_post(); ?>
					
					
					
					<div id="sreg-pres">
						
						<h4>Presentation</h4>
						<p>
							<?php if( get_field('app_personalinfo') ): ?>
							<?php the_field('app_personalinfo'); ?>
							<?php endif; ?>
						</p>
						
					</div>
					
					<div id="sreg-omr">
					</div>
					<div id="sreg-bostad" style="clear: both; display:block;">
						<h3>&Ouml;nskad bostad</h3>
						<ul class="clearfix">
							
							<li>
								<b>Bostadstyp</b>
								<br/><span><?php the_field('obj_type'); ?></span>
							</li>
							<li>
								<b>M&ouml;blerat</b>
								<br/><span><?php the_field('obj_furnished'); ?></span>
							</li>
							<li>
								<b>Min. antal rum</b>
								<br/><span><?php the_field('obj_rooms'); ?></span>
							</li>
							<li>
								<b>Min. storlek</b>
								<br/><span><?php the_field('obj_size'); ?></span>
							</li>
							<li>
								<b>Max. hyra (per m&aring;nad)</b>
								<br/><span><?php the_field('obj_rent'); ?></span>
							</li>
							<li>
								<b>Inflyttningsdatum</b>
								<br/><span><?php the_field('obj_move'); ?></span>
							</li>
							
							<li>
								<b>Min. uthyrningsperiod (m&aring;nader)</b>
								<br/><span><?php the_field('obj_contractlenght'); ?></span>
							</li>
							
							<li>
								<b>Vem st&aring;r p&aring; kontraktet</b>
								<br/><span><?php
									$signedby = get_field('obj_signedby');
									if (count($signedby) === 1) {
									the_field('obj_signedby');
									} else {
									echo implode(', ', get_field('obj_signedby'));
									}
								?></span>
							</li>
							
							
						</ul>
					</div>
					
					<?php endwhile; ?>
					
					<?php else : ?>
					<p>Anv&auml;ndaren saknar en ans&ouml;kan</p>
					<?php endif; ?>
					<?php wp_reset_query(); ?>
					
					
				</div>
				
				
				
				
				
				
				
				<!-- Intressen -->
				
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
				'posts_per_page' => 20,
				'post__in' => $regids,
				'post_status' => array('publish')
				);
				query_posts($args);
				?>
				
				<?php if ( have_posts() ) : ?>
				
				<h2 class="h2minsida"><span class="minaintresseanmalningar"></span>Visat intresse för</h2><ul>
				
				<?php while ( have_posts() ) : the_post(); ?>
				
				<li><div class="objlist list">







				
<div class="obj obj-minsida clearfix">
	
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('object-thumb-250');
					}
					else {
						echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/library/timthumb.php?src=' . get_bloginfo( 'stylesheet_directory' ) . '/library/images/default.png&w=150&q=90" />';
					}
					?>

					<div class="objinfo" style="width: 550px !important;">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<ul>
						<li class="antalrum"><span class="sort-room"><?php the_field ('obj_rooms'); ?></span></li>
						<li class="storlek"><span class="sort-size"><?php the_field ('obj_size'); ?></span> <?php _e('kvm', 'myplejs'); ?></li>
						<li class="pris"><span class="sort-price"><?php the_field ('obj_rent'); ?></span> SEK</li>

						 <?php
                                        // generate timestamp from obj_move
                                        $date = get_field('obj_move');
                                        $timestamp = 0;
                                        if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
                                        $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
                                        }
                                        ?>
                                        <li class="inflytt">
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


						




						<li class="langd"><span class="sort-lenght"><?php the_field ('obj_contractlenght'); ?></span> <?php $value_lenght = get_field( "obj_contractlenght" );
                        	if ($value_lenght == 'Tillsvidare') { } elseif ($value_lenght == '1') { _e('månad', 'myplejs'); } else { _e('månader', 'myplejs'); } ?></li>
						
					</ul>

										
					</div> <!-- end objinfo -->

<div class="btns-wrap">
						<div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Visa</a></div>
						
					</div> <!-- end btns-wrap -->

</div> <!-- end obj -->










				</div></li>
				
				<?php endwhile;?><li class="objlist-last-minsida"></li></ul>
				
				<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<p>Användaren har inga intresseanmälningar</p>
				<?php endif; ?>
				<?php wp_reset_query(); ?>




				
				
				
				
				
				<!-- Bokm&auml;rkta -->
				
				<?php
				
					$args = array(
				'post_type' => 'objects',
				'posts_per_page' => -1,
				'post_status' => array('publish', 'pending'),
				'meta_key' => 'user_bookmark',
				'meta_value' => $userid
				);
				
				query_posts( $args );?>
				
				<?php if ( have_posts() ) : ?>
				
				<h2 class="h2minsida"><span class="minabokmarken">&nbsp;</span>Bokm&auml;rkta Objekt</h2><ul>
				
				<?php while ( have_posts() ) : the_post(); ?>
				
				<li><div class="objlist list">
				
				
<div class="obj obj-minsida">
	
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('object-thumb-250');
					}
					else {
						echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/library/timthumb.php?src=' . get_bloginfo( 'stylesheet_directory' ) . '/library/images/default.png&w=150&q=90" />';
					}
					?>

					<div class="objinfo" style="width: 550px !important;">
						<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<ul>
						<li class="antalrum"><span class="sort-room"><?php the_field ('obj_rooms'); ?></span></li>
						<li class="storlek"><span class="sort-size"><?php the_field ('obj_size'); ?></span> <?php _e('kvm', 'myplejs'); ?></li>
						<li class="pris"><span class="sort-price"><?php the_field ('obj_rent'); ?></span> SEK</li>
						<li class="inflytt"><span class="sort-move" value="<?php $date = get_field('obj_move'); $timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp(); echo $timestamp; ?>">
							
							<?php
							$today = time();
							if($timestamp<$today):
								_e('Omgående', 'myplejs');
								else :
								echo get_field('obj_move');							
								endif; ?>
			
						</span></li>
						<li class="langd"><span class="sort-lenght"><?php the_field ('obj_contractlenght'); ?></span> <?php $value_lenght = get_field( "obj_contractlenght" );
                        	if ($value_lenght == 'Tillsvidare') { } elseif ($value_lenght == '1') { _e('månad', 'myplejs'); } else { _e('månader', 'myplejs'); } ?></li>
						
					</ul>
					<span>
						<?php print_taxonomy_ranks( get_the_terms( $post->ID, 'obj_city' ) ); ?>
					</span>
										
					</div> <!-- end objinfo -->

<div class="btns-wrap">
						<div class="btn-small"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="btn-pil"></span>Visa</a></div>
						
					</div> <!-- end btns-wrap -->

</div> <!-- end obj -->




				
				</div></li>
				
				<?php endwhile;?><li class="objlist-last-minsida">&nbsp;</li></ul>
				
				
				<?php else : ?>
				<p>Anv&auml;ndaren har inga bokm&auml;rken</p>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
				
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


				