<?php
/*
Template for single objects
*/
get_header(); ?>
<script type="text/javascript" src="https://maps-api-ssl.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var infowindow = new google.maps.InfoWindow();
var pinkmarker = new google.maps.MarkerImage('<?php echo get_stylesheet_directory_uri() ?>/dev_packs/maps/green_marker.png', new google.maps.Size(35, 35) );
var shadow = new google.maps.MarkerImage('<?php echo get_stylesheet_directory_uri() ?>/dev_packs/maps/shadow.png', new google.maps.Size(37, 34) );
function initialize() {
map = new google.maps.Map(document.getElementById('map'), {
zoom: 15,
center: new google.maps.LatLng(<?php $location = get_field('karta_ny'); echo $location['coordinates']; ?>),
mapTypeId: google.maps.MapTypeId.ROADMAP
});
for (var i = 0; i < locations.length; i++) {
var marker = new google.maps.Marker({
position: locations[i].latlng,
icon: pinkmarker,
shadow: shadow,
map: map
});
}
}
var pinkmarker = new google.maps.MarkerImage('<?php echo get_stylesheet_directory_uri() ?>/dev_packs/maps/green_marker.png', new google.maps.Size(35, 35) );
(function($) {
function render_map( $el ) {
var $markers = $el.find('.marker');
var args = {
zoom		: 15,
center		: new google.maps.LatLng(0, 0),
mapTypeId	: google.maps.MapTypeId.ROADMAP
};
var map = new google.maps.Map( $el[0], args);
map.markers = [];
$markers.each(function(){
add_marker( $(this), map );
});
center_map( map );
}
function add_marker( $marker, map ) {
var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
var marker = new google.maps.Marker({
position	: latlng,
icon: pinkmarker,
map			: map
});
map.markers.push( marker );
if( $marker.html() )
{
var infowindow = new google.maps.InfoWindow({
content		: $marker.html()
});
google.maps.event.addListener(marker, 'click', function() {
infowindow.open( map, marker );
});
}
}
function center_map( map ) {
var bounds = new google.maps.LatLngBounds();
$.each( map.markers, function( i, marker ){
var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
bounds.extend( latlng );
});
if( map.markers.length == 1 )
{
map.setCenter( bounds.getCenter() );
map.setZoom( 15 );
}
else
{
map.fitBounds( bounds );
}
}
$(document).ready(function(){
$('.acf-map').each(function(){
render_map( $(this) );
});
});
})(jQuery);
</script>
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
	
	<!-- innehåll -->
	<div class="row">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $author_id=$post->post_author;
		$current_author = get_the_author();
		$objectID=$post->ID; ?>
		<div class="col-xs-12 col-sm-7 col-md-8">
			
			<!-- OM ADMIN ÄR INLOGGAD -->
			<?php if ( current_user_can('manage_options') ) : ?>
			<style type="text/css">.objdetail {clear: both;}.admin-info-user td {padding: 5px;}</style>
			<script>jQuery("table tr:odd").css("background-color", "#eaeaea");</script>
			<div class="admin-inf">
				<div style="width: 700px; display: inline-block;">
					<h3><a href="?page_id=109652&preview=true">Intresseanmälningar</a></h3>
					
					<?php
					
					// get the current object id
					$objid = get_the_ID();
					
					// loop registration
					$args = array(
						'post_type' => 'registration',
						'posts_per_page' => -1,
						'nopaging' => 'true',
						'post_status' => array('publish', 'pending'),
						'meta_query' => array(
								array(
									'key' => 'reg_obj_id',
									'value' => $objid,
									'compare' => '=',
									'type' => 'NUMERIC'
								)
							)
							);
					
					query_posts( $args );?>
					
					<?php if ( have_posts() ) : ?>
					
					<?php $c = 0; ?>
					
					<table id="xtable" class="xmpl compact">
						<thead>
							<tr>
								<th><b><a href="#" onclick="sortTable(0);return false;">Namn</a></b></th>
								<th><b><a href="javascript:sortTable(1)">Telefon</a></b></th>
								<th><b><a href="javascript:sortTable(2)">E-post</a></b></th>
								<th><b><a href="javascript:sortTable(3)">Datum</a></b></th>
								<!-- 		<th><b><a href="javascript:sortTable(4)">Status</a></b></th>
								<th>Ändra</th> -->
							</tr>
						</thead>
						
						<tbody>
							<?php while ( have_posts() ) : the_post(); ?>
							<tr>
								<td abbr="<?php the_author_meta( 'user_firstname' ); ?>"><a href="/?post_type=registration&p=<?php the_ID(); ?>&preview=true"><?php the_author_meta( 'user_firstname' ); ?> <?php the_author_meta( 'user_lastname' ); ?></a></td>
								<?php $phone_string = (strlen(get_the_author_meta( 'telefon' )) > 20) ? substr(get_the_author_meta( 'telefon' ),0,17).'...' : get_the_author_meta( 'telefon' ); ?>
								<td abbr="<?php the_author_meta( 'telefon' ); ?>"><?php echo $phone_string; ?></td>
								<?php $email_string = (strlen(get_the_author_meta( 'user_email' )) > 30) ? substr(get_the_author_meta( 'user_email' ),0,27).'...' : get_the_author_meta( 'user_email' ); ?>
								<td abbr="<?php the_author_meta( 'user_email' ); ?>"><a href="https://mail.google.com/mail/u/0/?shva=1#search/<?php the_author_meta( 'user_email' ); ?>" title="<?php the_author_meta( 'user_email' ); ?>" target="_blank"><?php echo $email_string; ?></a></td>
								<td abbr="<?php the_time('d/m/Y') ?>"><?php the_time('d/m/Y') ?> kl: <?php the_time('H:i') ?></td>
								<!-- <td abbr="<?php the_field( 'reg_status' ); ?>"><span><a href="/?post_type=registration&p=<?php the_ID(); ?>&preview=true"><?php the_field( 'reg_status' ); ?></a></span></td> -->
								<!-- <td><a href="/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/icon-form-edit.png" /></a></td> -->
							</tr>
							
							<?php endwhile; ?>
							
						</tbody>
						
						<?php else : ?>
						
						<p>Ingen har visat intresse för detta objekt ännu</p>
						
						<?php endif; ?>
						
					</table>
					
					<?php wp_reset_query(); ?>
					
				</div>
				
				<div class="visning">
					<h3>Visning</h3>
					<p><?php if (get_field('obj_viewinghours')) : the_field('obj_viewinghours'); else : echo('Det finns inga visningstider för detta objekt.'); endif; ?></p>
					<h3>Kontaktuppgifter</h3>
					<p>
						
						<a href="https://mail.google.com/mail/u/0/?shva=1#search/<?php the_author_meta( 'user_email' , $author_id ); ?>" target="_blank"><?php the_author_meta( 'user_email' , $author_id ); ?></a><br>
						<?php echo get_the_author_meta('telefon') ?>
					</p>
				</div>
			</div>
			<?php endif; ?>
			<!-- END OM ADMIN ÄR INLOGGAD -->
			<!-- OBJDETAIL -->
			<div class="objdetail">
				<header>
					<h1 class="objtitle"><?php the_title(); ?></h1>
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
					echo "$list"; ?>,
					<span class="no_translate"><?php the_field('obj_address'); ?></span>
				</header>
				
				<!-- Slider -->
				<div class="slicksliderobj">
					<?php
						$attachments = get_children(array('post_parent' => $post->ID,
						'post_status' => 'inherit',
						'post_type' => 'attachment',
						'post_mime_type' => 'image',
						'order' => 'DESC',
						'orderby' => 'menu_order ID'));
						foreach($attachments as $att_id => $attachment) {
						$full_img_src = wp_get_attachment_image($attachment->ID, 'object-thumb-400' );
						$full_img_url = wp_get_attachment_url($attachment->ID, 'large' );
					?>
					
					<div>
						<a href="<?php echo $full_img_url; ?>" data-lightbox="image-1">
							
							<?php echo $full_img_src; ?>
						</a>
					</div>
					<?php
						}
					?>
				</div>
				
				<!-- End slider -->
				
				
				<!-- Info om bostad -->
				<div class="obj-details">
					<!-- detaljdata -->
					<div class="box">
						
						<!-- variablar --> 
						<!-- objektstyp -->
						<?php $lang = ICL_LANGUAGE_CODE;
						$objekttyp = get_field('obj_type');
						if ( $lang = 'en-US' ) :
						if ( $objekttyp == 'Rum') :
						$objekttyp = 'Room';
						elseif ( $objekttyp == 'Lägenhet') :
						$objekttyp = 'Appartment';
						else :
						$objekttyp = 'House';
						endif;
						endif; ?>

						<!-- möjlighet till förläning -->
						<?php $lang = ICL_LANGUAGE_CODE;
						$kontraktsforlangning = get_field('obj_possibleextension');
						if ( $lang = 'en-US' ) :
						if ( $kontraktsforlangning == 'Ja') :
						$kontraktsforlangning = 'Yes';
						else :
						$kontraktsforlangning = 'No';
						endif;
						endif; ?>

						<!-- möblerat -->
						<?php $lang = ICL_LANGUAGE_CODE;
						$moblering = get_field('obj_furnished');
						if ( $lang = 'en-US' ) :
						if ( $moblering == 'Ja') :
						$moblering = 'Yes';
						elseif ( $moblering == 'Delvis möblerat') :
						$moblering = 'Partially furnished';
						elseif ( $moblering == 'Omöblerat') :
						$moblering = 'No';
						else :
						$moblering = 'Optional';
						endif;
						endif; ?>

						<!-- handpenning -->
						<?php $lang = ICL_LANGUAGE_CODE;
						$downpayment = get_field('obj_downpayment');
						if ( $lang = 'en-US' ) :
						if ( $downpayment == '1 hyra') :
						$downpayment = '1 rent';
						elseif ( $downpayment == '1,5 hyra') :
						$downpayment = '1,5 rents';
						elseif ( $downpayment == '2 hyror') :
						$downpayment = '2 rents';
						else :
						$downpayment = '3 rents';
						endif;
						endif; ?>

						

						
						<!-- end variablar --> 


						<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
									<h2><?php echo $objekttyp  ?></h2>
								<?php else: ?>
						<h2><?php the_field ('obj_type'); ?></h2>
								<?php endif; ?>

						
						<ul class="clearfix">
							<li>
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_rooms')): ?>
								<span class="main-details"><?php the_field ('obj_rooms'); ?> rooms</span>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_rooms')): ?>
								<span class="main-details"><?php the_field ('obj_rooms'); ?> rum</span>
								<?php endif; ?>
								<?php endif; ?>
								
								
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_size')): ?>
								<strong>Size:</strong> <?php the_field ('obj_size'); ?> kvm<br/>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_size')): ?>
								<strong>Storlek:</strong> <?php the_field ('obj_size'); ?> kvm<br/>
								<?php endif; ?>
								<?php endif; ?>
								
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_furnished')): ?>
								<strong><?php _e('Furnitured', 'myplejs'); ?>:</strong> <?php echo $moblering ?><br/>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_furnished')): ?>
								<strong><?php _e('Möblerat', 'myplejs'); ?>:</strong> <?php the_field ('obj_furnished'); ?><br/>
								<?php endif; ?>
								<?php endif; ?>
								
								
							</li>
							
							<li>
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_rent')): ?>
								<span class="main-details"><?php the_field ('obj_rent'); ?> SEK</span>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_rent')): ?>
								<span class="main-details"><?php the_field ('obj_rent'); ?> SEK</span>
								<?php endif; ?>
								<?php endif; ?>
								
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_downpayment')): ?>
								<strong><?php _e('Deposition', 'myplejs'); ?>:</strong> <?php echo $downpayment ?><br/>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_downpayment')): ?>
								<strong><?php _e('Deposition', 'myplejs'); ?>:</strong> <?php the_field ('obj_downpayment'); ?><br/>
								<?php endif; ?>
								<?php endif; ?>
								





								<!-- ingår i hyra -->
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_included')): ?>
								<strong><?php _e('Included in rent', 'myplejs'); ?>:</strong>


									<?php
									$includedin = get_field('obj_included');
									$en = array("Electricity", "Internet", "Cable TV");
									$sv   = array("El", "Internet", "Kabel-tv");
									$new_includein = str_replace($sv, $en, $includedin);
									if (count($new_includein) === 1) {
										$new_includein;
									} else {
										echo implode(', ', $new_includein);
									}
									?>


								<?php endif; ?>

								<?php else: ?>
								<?php if (get_field('obj_included')): ?>
								<strong><?php _e('Ingår i hyra', 'myplejs'); ?>:</strong>
								
								<?php
								$included = get_field('obj_included');
								if (count($included) === 1) {
										the_field('obj_included');
									} else {
									echo implode(', ', get_field('obj_included'));
									}
								?>

								<?php endif; ?>


								<?php endif; ?>
								
								
							</li>

							
							<li>
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_contractlenght')): ?>
								<span class="main-details">
									<?php $value_lenght = get_field( "obj_contractlenght" );
								if ($value_lenght == '100') { echo 'Until further notice'; } elseif ($value_lenght == '1') { the_field ('obj_contractlenght'); echo ' month'; } else { the_field ('obj_contractlenght'); echo ' months'; } ?></span>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_contractlenght')): ?>
								<span class="main-details">
									<?php $value_lenght = get_field( "obj_contractlenght" );
								if ($value_lenght == '100') { echo 'Tillsvidare'; } elseif ($value_lenght == '1') { the_field ('obj_contractlenght'); echo ' månad'; } else { the_field ('obj_contractlenght'); echo ' månader'; } ?></span>
								<?php endif; ?>
								<?php endif; ?>
								

								
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_move')): ?>
								<strong>Moving in date:</strong>
								<?php
								// generate timestamp from obj_move
								$date = get_field('obj_move');
								$timestamp = 0;
								if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
								$timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
								}
								?>
								<?php
								// print omgående or date
								$today = time();
								if ( $timestamp < $today ) {
								_e('Immediately', 'myplejs');
								} else {
								echo get_field('obj_move');
								}
								?>
								<br/>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_move')): ?>
								<strong>Inflytt:</strong>
								<?php
								// generate timestamp from obj_move
								$date = get_field('obj_move');
								$timestamp = 0;
								if ( DateTime::createFromFormat('!d/m/Y', $date) ) {
								$timestamp = DateTime::createFromFormat('!d/m/Y', $date)->getTimestamp();
								}
								?>
								<?php
								// print omgående or date
								$today = time();
								if ( $timestamp < $today ) {
								_e('Omgående', 'myplejs');
								} else {
								echo get_field('obj_move');
								}
								?>
								<br/>
								<?php endif; ?>
								<?php endif; ?>
								
								
								
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
									<?php if (get_field('obj_possibleextension')): ?>
									<strong>Possible extension:</strong> <?php echo $kontraktsforlangning ?>
									<br/>
									<?php endif; ?>
								<?php else: ?>
									<?php if (get_field('obj_possibleextension')): ?>
									</strong>Möjlig förlängning:</strong> <?php the_field ('obj_possibleextension'); ?><br/>
									<?php endif; ?>
								<?php endif; ?>
								




								<!-- hyrs ut till -->
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_signedby')): ?>
								<strong>Leased to:</strong>


									<?php
									$signedbynew = get_field('obj_signedby');
									$en = array("Company", "Private");
									$sv = array("Ett företag", "En privatperson");
									$new_signedby = str_replace($sv, $en, $signedbynew);
									if (count($new_signedby) == 1) {
										echo $new_signedby[0];
									} else {
										echo implode(', ', $new_signedby);
									}
									?>

									


								<?php endif; ?>

								<?php else: ?>
								<?php if (get_field('obj_signedby')): ?>
								<strong><?php _e('Hyrs ut till', 'myplejs'); ?>:</strong>
								
								<?php
								$signedby = get_field('obj_signedby');
								if (count($signedby) == 1) {
										the_field('obj_signedby');
									} else {
									echo implode(', ', get_field('obj_signedby'));
									}
								?>

								<?php endif; ?>


								<?php endif; ?>






					




								
								
								
								
							</li>
							<li>

						

								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
								<?php if (get_field('obj_conditions')): ?>
								<div class="box">
									<span class="main-details">Requirements for tenant</span>
									<?php
									$condobj = get_field('obj_conditions');
									$en = array("No pets", "Can pay deposition", "None smoker");
									$sv   = array("Har inga husdjur", "Kan betala deposition", "Röker inte");
									$new_cond = str_replace($sv, $en, $condobj);
									if (count($new_cond) === 1) {
										$new_cond;
									} else {
										echo implode(', ', $new_cond);
									}
									?>
								</div>
								<?php endif; ?>
								<?php else: ?>
								<?php if (get_field('obj_conditions')): ?>
								<div class="box">
									<span class="main-details">Krav på hyresgäst</span>
									<p><?php the_field ('obj_conditions'); ?></p>
								</div>
								<?php endif; ?>
								<?php endif; ?>
								
								
							</li>
						</ul>
					</div>
					<!-- end detaljdata -->
					<!-- Krav, beskrivning och karta -->
					<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>


					<?php if (get_field('obj_description')): ?>
					<div class="box">
						<h2>Description</h2>
						<p><?php the_field ('obj_description'); ?></p>
					</div>
					<?php endif; ?>
<div class="object-sidebar sidebar-widget clearfix intressefonstermobil">
						<?php if (is_user_logged_in()) : ?>
						<h2><?php the_field('object_sidebar_member_headline','options'); ?></h2><?php the_field('object_sidebar_member_content','options'); ?>
						<?php
							
						// get the current object id
						$objid = get_the_ID();
						// get the current logged in user
						$userid = get_current_user_id();
						
							$args = array(
							'post_type' => 'registration',
							'posts_per_page' => -1,
							'post_status' => array('publish', 'pending'),
							'meta_query' => array(
									array(
										'key' => 'reg_obj_id',
										'value' => $objid,
										'compare' => '=',
										'type' => 'NUMERIC'
									),
									array(
										'key' => 'reg_user_id',
										'value' => $userid,
										'compare' => '=',
										'type' => 'NUMERIC'
									),
									array(
										'key' => 'reg_status',
										'value' => 'Inte intresserad',
										'compare' => '!=',
										'type' => 'CHAR'
									)
								)
							);
						
						query_posts( $args );?>
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
							<?php echo $my_delete_intresse_button->delete_intresse_button_eng(); ?>
						<?php else: ?>
							<?php echo $my_delete_intresse_button->delete_intresse_button(); ?>
						<?php endif; ?>	
						
						
						
						<?php endwhile; ?>
						
						<?php else : ?>
						
						<?php echo do_shortcode('[gravityform id="17" name="Visa intresse - (NY)" title="false" description="false" ajax="true"]'); ?>
						
						<?php endif; ?>
						
						<?php wp_reset_query(); ?>
						<?php else : ?>
						<h2><?php the_field('object_sidebar_headline','options'); ?></h2>
						<?php the_field('object_sidebar_content','options'); ?>
						
						<?php endif; ?>
					</div>


					
					<?php if (get_field('karta_ny')): ?>
					<div class="box">
						<h2>Map</h2>
						<?php $location = get_field('karta_ny');
						if( !empty($location) ):
						?>
						<div class="acf-map">
							<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php else: ?>
					<?php if (get_field('obj_description')): ?>
					<div class="box">
						<h2>Beskrivning</h2>
						<p><?php the_field ('obj_description'); ?></p>
					</div>
					<?php endif; ?>


					<div class="object-sidebar sidebar-widget clearfix intressefonstermobil">
						<?php if (is_user_logged_in()) : ?>
						<h2><?php the_field('object_sidebar_member_headline','options'); ?></h2><?php the_field('object_sidebar_member_content','options'); ?>
						<?php
							
						// get the current object id
						$objid = get_the_ID();
						// get the current logged in user
						$userid = get_current_user_id();
						
							$args = array(
							'post_type' => 'registration',
							'posts_per_page' => -1,
							'post_status' => array('publish', 'pending'),
							'meta_query' => array(
									array(
										'key' => 'reg_obj_id',
										'value' => $objid,
										'compare' => '=',
										'type' => 'NUMERIC'
									),
									array(
										'key' => 'reg_user_id',
										'value' => $userid,
										'compare' => '=',
										'type' => 'NUMERIC'
									),
									array(
										'key' => 'reg_status',
										'value' => 'Inte intresserad',
										'compare' => '!=',
										'type' => 'CHAR'
									)
								)
							);
						
						query_posts( $args );?>
						
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

						<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
							<?php echo $my_delete_intresse_button->delete_intresse_button_eng(); ?>
						<?php else: ?>
							<?php echo $my_delete_intresse_button->delete_intresse_button(); ?>
						<?php endif; ?>	
						
						
						
						<?php endwhile; ?>
						
						<?php else : ?>
						
						<?php echo do_shortcode('[gravityform id="17" name="Visa intresse - (NY)" title="false" description="false" ajax="true"]'); ?>
						
						<?php endif; ?>
						
						<?php wp_reset_query(); ?>
						<?php else : ?>
						<h2><?php the_field('object_sidebar_headline','options'); ?></h2>
						<?php the_field('object_sidebar_content','options'); ?>
						
						<?php endif; ?>
					</div>

					
					<?php if (get_field('karta_ny')): ?>
					<div class="box">
						<h2>Kartvy</h2>
						<?php $location = get_field('karta_ny');
						if( !empty($location) ):
						?>
						<div class="acf-map">
							<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
						</div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php endif; ?>
					
					
					<!--END Krav, beskrivning och karta -->
					
				</div>
			</div>
			<!-- end objdetail -->
			<?php endwhile; ?><?php else : ?>
			<article id="post-not-found" class="hentry clearfix">
				<header class="article-header">
					<h1><?php _e("Objektet hittades inte!", "bonestheme"); ?></h1>
				</header>
				<section class="post-content">
					<p><?php _e("Objektet är tyvärr inte tillgängligt för uthyrning längre.", "bonestheme"); ?></p>
				</section>
				
			</article><?php endif; ?>
		</span>
	</div>
	<!-- end innehåll -->
	
	<!-- sidebar -->
	<aside id="sidebar" class=" col-xs-12 col-sm-5 col-md-4">
		<!-- Dela ikoner -->
		<div class="objheadericons" >
			<ul>
				<li class="print"><a href="javascript:window.print()"></a></li>
				<li class="fb"><a href="http://www.facebook.com/sharer.php?s=100&p[title]=<?php the_title(); ?>&p[summary]=<?php the_field ('obj_description'); ?>&p[url]=<?php the_permalink(); ?>&p[images][0]=<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail'); echo $image[0]; ?>
				"></a></li>
				<li class="mail"><a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>"></a></li>
			</ul>
		</div>
		<!--END dela ikoner -->
		<div class="object-sidebar sidebar-widget clearfix intressefonsterdesktop">
			<?php if (is_user_logged_in()) : ?>
			<h2><?php the_field('object_sidebar_member_headline','options'); ?></h2><?php the_field('object_sidebar_member_content','options'); ?>
			<?php
				
			// get the current object id
			$objid = get_the_ID();
			// get the current logged in user
			$userid = get_current_user_id();
			
				$args = array(
				'post_type' => 'registration',
				'posts_per_page' => -1,
				'post_status' => array('publish', 'pending'),
				'meta_query' => array(
						array(
							'key' => 'reg_obj_id',
							'value' => $objid,
							'compare' => '=',
							'type' => 'NUMERIC'
						),
						array(
							'key' => 'reg_user_id',
							'value' => $userid,
							'compare' => '=',
							'type' => 'NUMERIC'
						),
						array(
							'key' => 'reg_status',
							'value' => 'Inte intresserad',
							'compare' => '!=',
							'type' => 'CHAR'
						)
					)
				);
			
			query_posts( $args );?>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
				<?php echo $my_delete_intresse_button->delete_intresse_button_eng(); ?>
			<?php else: ?>
				<?php echo $my_delete_intresse_button->delete_intresse_button(); ?>
			<?php endif; ?>	
			
			
			
			<?php endwhile; ?>
			
			<?php else : ?>
			
			<?php echo do_shortcode('[gravityform id="17" name="Visa intresse - (NY)" title="false" description="false" ajax="true"]'); ?>
			
			<?php endif; ?>
			
			<?php wp_reset_query(); ?>
			<?php else : ?>
			<h2><?php the_field('object_sidebar_headline','options'); ?></h2>
			<?php the_field('object_sidebar_content','options'); ?>
			
			<?php endif; ?>
		</div>
	</aside>
	<!-- end sidebar -->
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



