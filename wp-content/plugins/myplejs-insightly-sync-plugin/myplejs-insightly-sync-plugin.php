<?php
/*
Plugin Name: myplejs Insightly Sync Plugin
Description: To post user details to a web service url on 'profile_update' hook.
Version: 0.2
Author: Abdullah
*/

add_action( 'profile_update', 'updated_user_profile_notify', 10, 2 );

function updated_user_profile_notify( $user_id, $old_user_data)
{

    // get the user data into an object
	$user = get_userdata( $user_id );
	$extra_user_info = get_user_meta($user_id);
	
	if($old_user_data == null){
		$old_user_data->user_email = $user->user_email;
		$old_user_data->display_name = $user->display_name;
	}

    $role_string = "";
    $role_array = unserialize($extra_user_info[wp_capabilities][0]);

	if (array_key_exists('uthyrare', $role_array) || array_key_exists('hyrestagare', $role_array)) {
		if($role_array['uthyrare'] == 1)
		  $role_string = "uthyrare";

		if($role_array['hyrestagare'] == 1)
		  $role_string = "hyrestagare";

		$url = 'https://script.google.com/macros/s/AKfycbyao5R8Tyj7t9hl0KBxAn_qsqHYZDl2VE6Os9ZcvlN6knUJdEQ/exec';
		$myvars = array(
						"method" => 'POST',
						"timeout" => 45,
						"redirection" => 5,
						"httpversion" => '1.0',
						"blocking" => true,
						"headers" => array(),
						"body" => array("user_id" => $user_id,
										"old_user_email" => $old_user_data->user_email, 
										"new_user_email" => $user->user_email,
										"old_display_name" => $old_user_data->display_name,
										"new_display_name" => $user->display_name,
										"new_user_first_name" => $extra_user_info[first_name][0],
										"new_user_last_name" => $extra_user_info[last_name][0],
										"new_user_phone" => $extra_user_info[telefon][0],
										"new_user_profile_img" => $extra_user_info[profilbild][0],
										"new_user_company" => $extra_user_info[foretag][0],
										"new_user_role" => $role_string)
						); 
	$response = wp_remote_post( $url, $myvars );
	
	//error_log( print_r( "final_role=".$role_string, true ) );
	
	}
}

add_action( 'update_user_meta', 'my_update_user_meta', 10, 4 );

function my_update_user_meta($meta_id, $object_id, $meta_key, $meta_value) {
			
			updated_user_profile_notify( $object_id, null);
}

?>