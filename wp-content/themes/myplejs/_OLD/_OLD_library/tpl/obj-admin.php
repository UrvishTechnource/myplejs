<?php if ( current_user_can('manage_options') ) : ?>
	<style type="text/css">
.objdetail {clear: both;}
.admin-info-user td {padding: 5px;}
    </style>
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
						)/*,
						array(
							'key' => 'reg_status',
							'value' => 'Inte intresserad',
							'compare' => '!='
						)*/
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
				<th><b><a href="javascript:sortTable(4)">Status</a></b></th>
				<th>Ändra</th>
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
					<td abbr="<?php the_field( 'reg_status' ); ?>"><span><a href="/?post_type=registration&p=<?php the_ID(); ?>&preview=true"><?php the_field( 'reg_status' ); ?></a></span></td>
					<td><a href="/wp-admin/post.php?post=<?php the_ID(); ?>&action=edit" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/library/images/icon-form-edit.png" /></a></td>
	            </tr>
	            
				<?php endwhile; ?>
				
			</tbody>	
				
				<?php else : ?>
				
					<p>Ingen har visat intresse för detta objekt ännu</p>
					
				<?php endif; ?>
				 
			</table>	
	
			<?php wp_reset_query(); ?>
		
    	</div>
    	
        <div style="float: right; width: 260px; display: inline-block;">
        <h3>Visning</h3>

        <p><?php if (get_field('obj_viewinghours')) : the_field('obj_viewinghours'); else : echo('Det finns inga visningstider för detta objekt.'); endif; ?></p>

        <h3>Kontaktuppgifter</h3>
        <p>
        <?php the_author_meta( 'first_name' , $author_id ); ?> <?php the_author_meta( 'last_name' , $author_id ); ?><br>
        <a href="https://mail.google.com/mail/u/0/?shva=1#search/<?php the_author_meta( 'user_email' , $author_id ); ?>" target="_blank"><?php the_author_meta( 'user_email' , $author_id ); ?></a><br>
        <?php echo get_the_author_meta('telefon') ?>
        </p>
        </div>
	</div><!-- end admin-info -->

<?php endif; ?>