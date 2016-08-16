<?php
/*
Plugin Name: Myplejs
Author: Andreas Sandström
Description: Plugin for Myplejs Interest and Bookmark functions
Version: 1.1b
Author URI: http://www.s-z.se
*/


class The_Intresse_Button {

	function __construct()
	{
		$this->hooks();
	}

	function hooks()
	{
		add_action( 'wp_head', array( $this, 'js' ) );
		add_action( 'wp_ajax_register_intresse', array( $this, 'handle_intresse' ) );
	}

	function js()
	{
		wp_enqueue_script( 'jquery' );
		wp_print_scripts();
		?>
		<script>
		jQuery(document).ready(function(){
					
			jQuery('.remove').click(function(){
				var intresse_post_id = jQuery(this).attr('alt');
				var intresse_user_id = jQuery(this).attr('rel');
				jQuery(this).closest(".obj").fadeOut("slow");
			
				jQuery.post(
					'<?php $url = site_url( '/wp-admin/admin-ajax.php', 'https' );echo $url; ?> ',


					
					{
						action		: 'register_intresse',
						user_id		: intresse_user_id,
						post_id		: intresse_post_id,
						_wpnonce	: '<?php echo wp_create_nonce('nonce-register_intresse'); ?>',
					},
					function(response) {	
						//alert(response);
					}
				);
				
			});
		});
		</script>
		<?php
	}

	function intresse_button()
	{
		if( !is_user_logged_in() )
			return false;

		global $current_user;

		$html = '<a class="remove" alt="' . get_the_ID() . '" rel="' . $current_user->ID . '">Remove</a>';
		return $html;
	}

	function handle_intresse()
	{
	
		global $wpdb;
		$user_id = (int) $_POST['user_id'];
		$post_id = (int) $_POST['post_id'];
		
		$args = array(
			'post_type' => 'registration',
			'posts_per_page' => 1,
			'post_status' => array('publish', 'pending'),
			'meta_query' => array(
				array(
					'key' => 'reg_obj_id',
					'value' => $post_id,
					'compare' => '=',
					'type' => 'NUMERIC'
					),
				array(
					'key' => 'reg_user_id',
					'value' => $user_id,
					'compare' => '=',
					'type' => 'NUMERIC'
					)
				)
			);
			
		$reg_query = new WP_Query($args);
		
		// The Loop
		if ( $reg_query->have_posts() ) :
		while ( $reg_query->have_posts() ) : $reg_query->the_post();
		$post_id = get_the_id();
		endwhile;
		endif;
		
		wp_reset_query();
		
		if( !is_user_logged_in() )
			return false;

		if( !wp_verify_nonce( $_POST['_wpnonce'], 'nonce-register_intresse' ) )
			die( 'Not allowed!' );

		
		$meta_id = update_post_meta( $post_id, 'reg_status', 'Inte intresserad' );
	    if( !$meta_id )
			echo "Error";
		else
			echo "Intresse borttaget!";
		exit;
	}
}

$my_intresse_button = new The_Intresse_Button;



// Add Bookmark


class The_Bookmark_Button {

	function __construct()
	{
		$this->hooks();
	}

	function hooks()
	{
		add_action( 'wp_head', array( $this, 'js' ) );
		add_action( 'wp_ajax_register_bookmark', array( $this, 'handle_bookmark' ) );
	}

	function js()
	{
		wp_enqueue_script( 'jquery' );
		wp_print_scripts();
		?>
		<script>
		jQuery(document).ready(function(){
					
			jQuery('.bookmark').click(function(){
				var bookmark_post_id = jQuery(this).attr('id');
				var bookmark_user_id = jQuery(this).attr('rel');
							
				jQuery.post(
					'<?php $url = site_url( '/wp-admin/admin-ajax.php', 'https' );echo $url; ?>',
					{
						action		: 'register_bookmark',
						user_id		: bookmark_user_id,
						post_id		: bookmark_post_id,
						_wpnonce	: '<?php echo wp_create_nonce('nonce-register_bookmark'); ?>',
					},
					function(response) {	
						alert(response);
					}
				);
				
			});
		});
		</script>
		<?php
	}

	function bookmark_button()
	{
		if( !is_user_logged_in() )
			return false;

		global $current_user;
		
		$html = '<div class="btn-bookmark"><a class="bookmark" id="' . get_the_ID() . '" rel="' . $current_user->ID . '">' . __('Bokmärk', 'myplejs') . '<i class="fa fa-bookmark"></i></a></div>';
		return $html;

	}

	function handle_bookmark()
	{
		global $wpdb;
		$user_id = (int) $_POST['user_id'];
		$post_id = (int) $_POST['post_id'];

		if( !is_user_logged_in() )
			return false;

		if( !wp_verify_nonce( $_POST['_wpnonce'], 'nonce-register_bookmark' ) )
			die( 'Not allowed!' );

		/* 
			Here is where we do some sort of database operation to associate
			the Like of the given post with the user who performed the action
		
			Make sure you check for errors. In order to return data, you must
			echo something that the originating page can see. True or false
			only makes sense on this page and not back there.
			
			Typically, you'd output some sort of JSON, XML or plain text.
		*/
		 $meta_id = add_post_meta( $post_id, 'user_bookmark', $user_id );
	    if( !$meta_id )
	        echo "Bookmark not recorded";
	    else
	        echo "Objektet är nu bokmärkt. Du kan se och ta bort bokmärken på Min sida.";
	    exit;
	}
}

$my_bookmark_button = new The_Bookmark_Button;


// Remove Bookmark

class The_Delete_Bookmark_Button {

	function __construct()
	{
		$this->hooks();
	}

	function hooks()
	{
		add_action( 'wp_head', array( $this, 'js' ) );
		add_action( 'wp_ajax_delete_bookmark', array( $this, 'handle_bookmark' ) );
	}

	function js()
	{
		wp_enqueue_script( 'jquery' );
		wp_print_scripts();
		?>
		<script>
		jQuery(document).ready(function(){
					
			jQuery('.remove-bookmark').click(function(){
				var bookmark_post_id = jQuery(this).attr('alt');
				var bookmark_user_id = jQuery(this).attr('rel');
				jQuery(this).closest(".obj").fadeOut("slow");
							
				jQuery.post(
					'<?php $url = site_url( '/wp-admin/admin-ajax.php', 'https' );echo $url; ?>',
					{
						action		: 'delete_bookmark',
						user_id		: bookmark_user_id,
						post_id		: bookmark_post_id,
						_wpnonce	: '<?php echo wp_create_nonce('nonce-delete_bookmark'); ?>',
					},
					function(response) {	
						//alert(response);
					}
				);
				
			});
		});
		</script>
		<?php
	}

	function delete_bookmark_button()
	{
		if( !is_user_logged_in() )
			return false;

		global $current_user;
		
		$html = '<a class="remove-bookmark" alt="' . get_the_ID() . '" rel="' . $current_user->ID . '">Remove</a>';
		return $html;

	}

	function handle_bookmark()
	{
		global $wpdb;
		$user_id = (int) $_POST['user_id'];
		$post_id = (int) $_POST['post_id'];

		if( !is_user_logged_in() )
			return false;

		if( !wp_verify_nonce( $_POST['_wpnonce'], 'nonce-delete_bookmark' ) )
			die( 'Not allowed!' );

		/* 
			Here is where we do some sort of database operation to associate
			the Like of the given post with the user who performed the action
		
			Make sure you check for errors. In order to return data, you must
			echo something that the originating page can see. True or false
			only makes sense on this page and not back there.
			
			Typically, you'd output some sort of JSON, XML or plain text.
		*/
		 $meta_id = delete_post_meta( $post_id, 'user_bookmark', $user_id );
	    if( !$meta_id )
	        echo "Bookmark delete not recorded";
	    else
	        echo "Bookmark deleted.";
	    exit;
	}
}

$delete_bookmark_button = new The_Delete_Bookmark_Button;


// Remove Intresse

class The_Delete_Intresse_Button {

	function __construct()
	{
		$this->hooks();
	}

	function hooks()
	{
		add_action( 'wp_head', array( $this, 'js' ) );
		add_action( 'wp_ajax_delete_intresse', array( $this, 'handle_delete_intresse' ) );
	}

	function js()
	{
		wp_enqueue_script( 'jquery' );
		wp_print_scripts();
		?>
		<script>
		jQuery(document).ready(function(){
					
			jQuery('.remove-intresse').click(function(){
				var intresse_post_id = jQuery(this).attr('alt');
				var intresse_user_id = jQuery(this).attr('rel');
				jQuery(this).closest(".obj").fadeOut("slow");
			
				jQuery.post(
					'<?php $url = site_url( '/wp-admin/admin-ajax.php', 'https' );echo $url; ?>',
					{
						action		: 'delete_intresse',
						user_id		: intresse_user_id,
						post_id		: intresse_post_id,
						_wpnonce	: '<?php echo wp_create_nonce('nonce-delete_intresse'); ?>',
					},
					function(response) {	
						location.reload();
						alert(response);
					}
				);
				
			});
		});
		</script>



	<?php
	}

	function delete_intresse_button()
	{
		if( !is_user_logged_in() )
			return false;

		global $current_user;



		$html = '<p><b>(Du har redan visat intresse för detta objekt)</b></p><a class="remove-intresse" alt="' . get_the_ID() . '" rel="' . $current_user->ID . '">Avregistrera intresse</a>';
		return $html;



	}

	function delete_intresse_button_eng()
	{
		if( !is_user_logged_in() )
			return false;

		global $current_user;



		$html = '<p><b>(You have already shown interest in this object)</b></p><a class="remove-intresse" alt="' . get_the_ID() . '" rel="' . $current_user->ID . '">Unregister interest</a>';
		return $html;



	}

	function handle_delete_intresse()
	{
	
		global $wpdb;
		$user_id = (int) $_POST['user_id'];
		$post_id = (int) $_POST['post_id'];
		
		$args = array(
			'post_type' => 'registration',
			'posts_per_page' => 1,
			'post_status' => array('publish', 'pending'),
			'meta_query' => array(
				array(
					'key' => 'reg_obj_id',
					'value' => $post_id,
					'compare' => '=',
					'type' => 'NUMERIC'
					),
				array(
					'key' => 'reg_user_id',
					'value' => $user_id,
					'compare' => '=',
					'type' => 'NUMERIC'
					)
				)
			);
			
		$reg_query = new WP_Query($args);
		
		// The Loop
		if ( $reg_query->have_posts() ) :
		while ( $reg_query->have_posts() ) : $reg_query->the_post();
		$post_id = get_the_id();
		endwhile;
		endif;
		
		wp_reset_query();
		
		if( !is_user_logged_in() )
			return false;

		if( !wp_verify_nonce( $_POST['_wpnonce'], 'nonce-delete_intresse' ) )
			die( 'Not allowed!' );

		
		$meta_id = update_post_meta( $post_id, 'reg_status', 'Inte intresserad' );
	    if( !$meta_id )
			echo "Error";
		else
			echo "Du har nu avregistrerat ditt intresse.";
		exit;
	}
}

$my_delete_intresse_button = new The_Delete_Intresse_Button;