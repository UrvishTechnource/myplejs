<?php
// Register Custom Navigation Walker
require_once('wp_pigment_navwalker.php');
// ---------------------------------------------------------------------------------
// add js-files
function enqueue_my_scripts() {
wp_enqueue_script('jquery-js', get_template_directory_uri() . '/dev_packs/jquery-1.11.2.min.js','','1.11.2', false);
wp_enqueue_script('respond-js', get_template_directory_uri() . '/dev_packs/responder.min.js','','1.0', false);
wp_enqueue_script('backstretch-js', get_template_directory_uri() . '/dev_packs/backstretch.min.js','','1.0', false);
wp_enqueue_script('jquery.mmenu.min.all-js', get_template_directory_uri() . '/dev_packs/mmenu/src/js/jquery.mmenu.min.js','','1.0', false);
wp_enqueue_script('waypoints.min-js', get_template_directory_uri() . '/dev_packs/waypoints.min.js','','1.0', false);
wp_enqueue_script('lazyload-js', get_template_directory_uri() . '/dev_packs/jquery.unveil.js','','1.0', false);
wp_enqueue_script('list-js', get_template_directory_uri() . '/dev_packs/list.js','','1.0', false);
wp_enqueue_script('lightbox.min-js', get_template_directory_uri() . '/dev_packs/lightbox/js/lightbox.min.js','','1.0', false);
wp_enqueue_script('slick.min-js', get_template_directory_uri() . '/dev_packs/slick/slick.min.js','','1.0', false);

wp_enqueue_script('custom-onload-js', get_template_directory_uri() . '/js/pigment_custom_onload.js','','1.0', false);
wp_enqueue_script('custom-onresize-js', get_template_directory_uri() . '/js/pigment_custom_onresize.js','','1.0', false);
}
add_action('wp_enqueue_scripts', 'enqueue_my_scripts');
// ---------------------------------------------------------------------------------
// add css-files
function enqueue_my_styles() {
wp_enqueue_style( 'wordpress-style', get_template_directory_uri() . '/style.css');
wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/dev_packs/bootstrap.min.css');
wp_enqueue_style( 'font-awsome', get_template_directory_uri() .  '/dev_packs/font-awesome/css/font-awesome.min.css');
wp_enqueue_style( 'jquery.mmenu.all', get_template_directory_uri() . '/dev_packs/mmenu/src/css/jquery.mmenu.all.css');
wp_enqueue_style( 'slick', get_template_directory_uri() . '/dev_packs/slick/slick.css');
wp_enqueue_style( 'lightbox', get_template_directory_uri() . '/dev_packs/lightbox/css/lightbox.css');
// wp_enqueue_style( 'myplejs-style', get_template_directory_uri() . '/css/style.css');
wp_enqueue_style( 'my-style-general', get_template_directory_uri() . '/css/general.css');
wp_enqueue_style( 'my-style-phone-content', get_template_directory_uri() . '/css/phone_content.css');
wp_enqueue_style( 'my-style-tablet-content', get_template_directory_uri() . '/css/tablet_content.css');
wp_enqueue_style( 'my-style-desktop-content', get_template_directory_uri() . '/css/desktop_content.css');
wp_enqueue_style( 'my-style-menu-phone', get_template_directory_uri() . '/css/phone_menu.css');
wp_enqueue_style( 'my-style-menu-tablet', get_template_directory_uri() . '/css/tablet_menu.css');
wp_enqueue_style( 'my-style-menu-desktop', get_template_directory_uri() . '/css/desktop_menu.css');

}
add_action('wp_enqueue_scripts', 'enqueue_my_styles');
// ---------------------------------------------------------------------------------
// add menus
function register_my_menus() {
register_nav_menus(
array(
'main-nav' => __( 'The Main Menu in wp', 'The Main Menu' ),   // main nav in header
'member-nav' => __( 'The Logged-in Menu', 'The Main Menu Logged In' )   // main nav in header
)
);
}
add_action( 'init', 'register_my_menus' );
// ---------------------------------------------------------------------------------
// let's create the function for the custom type
function custom_post_example() {
// creating (registering) the custom type
register_post_type( 'objects', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
// let's now add all the options for this post type
array('labels' => array(
'name' => __('Objects', 'bonestheme'), /* This is the Title of the Group */
'singular_name' => __('object', 'bonestheme'), /* This is the individual type */
'all_items' => __('All Objects', 'bonestheme'), /* the all items menu item */
'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
'add_new_item' => __('Add New Object', 'bonestheme'), /* Add New Display Title */
'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
'edit_item' => __('Edit Objects', 'bonestheme'), /* Edit Display Title */
'new_item' => __('New Object', 'bonestheme'), /* New Display Title */
'view_item' => __('View Object', 'bonestheme'), /* View Display Title */
'search_items' => __('Search Object', 'bonestheme'), /* Search Custom Type Title */
'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */
'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
'parent_item_colon' => ''
), /* end of arrays */
'description' => __( 'This is the example custom post type', 'bonestheme' ), /* Custom Type Description */
'public' => true,
'publicly_queryable' => true,
'exclude_from_search' => false,
'show_ui' => true,
'query_var' => true,
'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
'menu_icon' => get_stylesheet_directory_uri() . '/images/custom-post-icon.png', /* the icon for the custom post type menu */
'rewrite'   => array( 'slug' => 'objects', 'with_front' => false ), /* you can specify its url slug */
'has_archive' => 'objects', /* you can rename the slug here */
'capability_type' => 'post',
'hierarchical' => false,
/* the next one is important, it tells what's enabled in the post editor */
'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky')
) /* end of options */
); /* end of register post type */
// creating (registering) the custom type
register_post_type( 'app', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
// let's now add all the options for this post type
array('labels' => array(
'name' => __('Applications', 'bonestheme'), /* This is the Title of the Group */
'singular_name' => __('application', 'bonestheme'), /* This is the individual type */
'all_items' => __('All Applications', 'bonestheme'), /* the all items menu item */
'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
'add_new_item' => __('Add New Application', 'bonestheme'), /* Add New Display Title */
'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
'edit_item' => __('Edit Applications', 'bonestheme'), /* Edit Display Title */
'new_item' => __('New Application', 'bonestheme'), /* New Display Title */
'view_item' => __('View Application', 'bonestheme'), /* View Display Title */
'search_items' => __('Search Application', 'bonestheme'), /* Search Custom Type Title */
'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */
'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
'parent_item_colon' => ''
), /* end of arrays */
'description' => __( 'Application custom post type', 'bonestheme' ), /* Custom Type Description */
'public' => true,
'publicly_queryable' => true,
'exclude_from_search' => true,
'show_ui' => true,
'query_var' => true,
'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
'menu_icon' => get_stylesheet_directory_uri() . '/images/custom-post-icon.png', /* the icon for the custom post type menu */
'rewrite'   => array( 'slug' => 'applications', 'with_front' => false ), /* you can specify its url slug */
'has_archive' => 'applications', /* you can rename the slug here */
'capability_type' => 'post',
'hierarchical' => false,
/* the next one is important, it tells what's enabled in the post editor */
'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky')
) /* end of options */
); /* end of register post type */
// creating (registering) the custom type
register_post_type( 'registration', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
// let's now add all the options for this post type
array('labels' => array(
'name' => __('Registrations', 'bonestheme'), /* This is the Title of the Group */
'singular_name' => __('Registration', 'bonestheme'), /* This is the individual type */
'all_items' => __('All anmälningar', 'bonestheme'), /* the all items menu item */
'add_new' => __('Add New', 'bonestheme'), /* The add new menu item */
'add_new_item' => __('Add New Application', 'bonestheme'), /* Add New Display Title */
'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
'edit_item' => __('Edit Applications', 'bonestheme'), /* Edit Display Title */
'new_item' => __('New Application', 'bonestheme'), /* New Display Title */
'view_item' => __('View Application', 'bonestheme'), /* View Display Title */
'search_items' => __('Search Application', 'bonestheme'), /* Search Custom Type Title */
'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */
'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
'parent_item_colon' => ''
), /* end of arrays */
'description' => __( 'Registration custom post type', 'bonestheme' ), /* Custom Type Description */
'public' => true,
'publicly_queryable' => true,
'exclude_from_search' => true,
'show_ui' => true,
'query_var' => true,
'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
'menu_icon' => get_stylesheet_directory_uri() . '/images/custom-post-icon.png', /* the icon for the custom post type menu */
'rewrite'   => array( 'slug' => 'registration', 'with_front' => false ), /* you can specify its url slug */
'has_archive' => 'registration', /* you can rename the slug here */
'capability_type' => 'post',
'hierarchical' => false,
/* the next one is important, it tells what's enabled in the post editor */
'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'sticky')
) /* end of options */
); /* end of register post type */

/* this adds your post categories to your custom post type */
register_taxonomy_for_object_type('category', 'objects');
register_taxonomy_for_object_type('category', 'applications');
/* this adds your post tags to your custom post type */
register_taxonomy_for_object_type('post_tag', 'objects');
register_taxonomy_for_object_type('post_tag', 'applications');

}
// adding the function to the Wordpress init
add_action( 'init', 'custom_post_example');

// Custom taxonomy
add_action( 'init', 'register_my_taxonomies', 0 );
function register_my_taxonomies() {
register_taxonomy(
'obj_city',
array( 'objects','app' ),
array(
'hierarchical' => true,
'public' => true,
'labels' => array(
'name' => __( 'City' ),
'singular_name' => __( 'City' ),

),
)
);
}

// ---------------------------------------------------------------------------------
// Auto login after registration
add_action( 'gform_user_registered', 'sz_gravity_registration_autologin', 10, 4 );
function sz_gravity_registration_autologin( $user_id, $user_config, $entry, $password ) {
$user = get_userdata( $user_id );
$user_login = $user->user_login;
$user_password = $password;
wp_signon( array(
'user_login' => $user_login,
'user_password' =>  $user_password,
'remember' => false
) );
}
/**
* Auto login after registration.
*/
function pi_gravity_registration_autologin( $user_id, $user_config, $entry, $password ) {
$user = get_userdata( $user_id );
$user_login = $user->user_login;
$user_password = $password;
wp_signon( array(
'user_login' => $user_login,
'user_password' =>  $user_password,
'remember' => false
) );
}
add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}
// ---------------------------------------------------------------------------------
// Excerpt
function get_excerpt($count){
global $post;
$permalink = get_permalink($post->ID);
$excerpt = get_the_content();
$excerpt = strip_tags($excerpt);
$excerpt = substr($excerpt, 0, $count);
$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
$excerpt = '<p>'.$excerpt.'... <a class="readmore" href="'.$permalink.'">L&auml;s mer &raquo;</a></p>';
return $excerpt;
}
// ---------------------------------------------------------------------------------
// Thumbnails
// add featured images
add_theme_support( 'post-thumbnails' );
// Thumbnail sizes
add_image_size( 'bones-thumb-200', 200, 200, true );
add_image_size( 'object-thumb-150', 150, 100, true );
add_image_size( 'object-thumb-250', 250, 187, true );
add_image_size( 'object-thumb-400', 400, 300, true );
add_image_size( 'sliderstart', 550, 355, true );
// Link thumb to post
add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {

$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
return $html;

}
// ---------------------------------------------------------------------------------
// ADD IMAGE TO FEATURED POST IN WP-ADMIN
// update the "4" to the ID of your form
add_filter("gform_post_submission_24", "gform_set_post_thumbnail");
function gform_set_post_thumbnail($entry){

// get post ID of the created post
$post_id = $entry["post_id"];

// get the last image added to the post
$attachments = get_posts(array('numberposts' => '1', 'post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC'));

if(sizeof($attachments) == 0)
return; //no images attached to the post
// set image as the post thumbnail
set_post_thumbnail($post_id, $attachments[0]->ID);
}
// ---------------------------------------------------------------------------------
// Custom user roles
add_role('uthyrare', 'Uthyrare', array(
'read' => true, // True allows that capability
'edit_posts' => true,
'delete_posts' => true,
));
add_role('hyrestagare', 'Hyrestagare', array(
'read' => true, // True allows that capability
'edit_posts' => true,
'delete_posts' => true,
));
// ---------------------------------------------------------------------------------
// Gör så att alla kan editera sina poster
add_filter('gform_update_post/public_edit', '__return_true');
// ---------------------------------------------------------------------------------
// CUSTOM USER PROFILE FIELDS
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { ?>
<h3>Extra profile information</h3>
<table class="form-table">
    <tr>
        <th><label for="profilbild">Profilbild</label></th>
        <td>
            <input type="text" name="profilbild" id="profilbild" value="<?php echo esc_attr( get_the_author_meta( 'profilbild', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Profilbild.</span>
        </td>
    </tr>
    <tr>
        <th><label for="telefon">Telefon</label></th>
        <td>
            <input type="text" name="telefon" id="telefon" value="<?php echo esc_attr( get_the_author_meta( 'telefon', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Telefon.</span>
        </td>
    </tr>
    <tr>
        <th><label for="foretag">Företag</label></th>
        <td>
            <input type="text" name="foretag" id="foretag" value="<?php echo esc_attr( get_the_author_meta( 'foretag', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description">Företag.</span>
        </td>
    </tr>
</table>
<?php }
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
if ( !current_user_can( 'edit_user', $user_id ) )
return false;
/* Copy and paste this line for additional fields. */
update_user_meta( $user_id, 'foretag', $_POST['foretag'] );
update_user_meta( $user_id, 'telefon', $_POST['telefon'] );
update_user_meta( $user_id, 'profilbild', $_POST['profilbild'] );
}
// ---------------------------------------------------------------------------------
/**
* Function for updating the 'profession' taxonomy count.  What this does is update the count of a specific term
* by the number of users that have been given the term.  We're not doing any checks for users specifically here.
* We're just updating the count with no specifics for simplicity.
*
* See the _update_post_term_count() function in WordPress for more info.
*
* @param array $terms List of Term taxonomy IDs
* @param object $taxonomy Current taxonomy object of terms
*/
function my_update_tests_count( $terms, $taxonomy ) {
global $wpdb;
foreach ( (array) $terms as $term ) {
$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->term_relationships WHERE term_taxonomy_id = %d", $term ) );
do_action( 'edit_term_taxonomy', $term, $taxonomy );
$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
do_action( 'edited_term_taxonomy', $term, $taxonomy );
}
}

// ---------------------------------------------------------------------------------
// Hook Gravity Forms user registration -> Map taxomomy
function map_taxonomy($user_id, $config, $entry, $user_pass) {
global $wpdb;
// Get all taxonomies
$taxs = get_taxonomies();
// Get all user meta
$all_meta_for_user = get_user_meta($user_id);
// Loop through meta data and map to taxonomies with same name as user meta key
foreach ($all_meta_for_user as $taxonomy => $value ) {
if (in_array ($taxonomy, $taxs) ) {         // Check if there is a Taxonomy with the same name as the Custom user meta key
// Get term id
$term_id = get_user_meta($user_id, $taxonomy, true);
If (is_numeric($term_id)) {             // Check if Custom user meta is an ID
Echo $taxonomy.'='.$term_id.'<br>';
// Add user to taxomomy term
$term = get_term( $term_id, $taxonomy );
$termslug = $term->slug;
wp_set_object_terms( $user_id, array( $termslug ), $taxonomy, false);
}
}
}
}
add_action("gform_user_registered", "map_taxonomy", 10, 4);
add_action( 'gform_user_registered', 'pi_gravity_registration_autologin', 10, 4 );
// ---------------------------------------------------------------------------------
// Set parent tax for publish
add_action('publish_objects', 'select_parent_terms', 20, 2); // automatically select parent terms
function select_parent_terms($post_id, $post) {
if(!wp_is_post_revision($post_ID)) {
$taxonomies = get_taxonomies(array('_builtin' => false));
foreach ($taxonomies as $taxonomy ) {
$terms = wp_get_object_terms($post->ID, $taxonomy);
foreach ($terms as $term) {
$parenttags = get_ancestors($term->term_id,$taxonomy);
wp_set_object_terms( $post->ID, $parenttags, $taxonomy, true );
}}}}
// Set parent tax for pending
add_action('save_post','save_post_callback', 20, 2);
function save_post_callback($post_id){
global $post;
if ($post->post_type != 'objects'){
return;
}
$taxonomies = get_taxonomies(array('_builtin' => false));
foreach ($taxonomies as $taxonomy ) {
$terms = wp_get_object_terms($post->ID, $taxonomy);
foreach ($terms as $term) {
$parenttags = get_ancestors($term->term_id,$taxonomy);
wp_set_object_terms( $post->ID, $parenttags, $taxonomy, true );
}}}
// ---------------------------------------------------------------------------------
// Add ACF Option Page
if( function_exists('acf_add_options_page') ) {

acf_add_options_page();

}
if( function_exists('acf_add_options_sub_page') )
{
acf_add_options_sub_page( 'Sidfot' );
acf_add_options_sub_page( 'Övriga inställningar' );
acf_add_options_sub_page( 'Objektsvy / Visa intresse' );
acf_add_options_sub_page( 'Min sida utloggad' );
}
// ---------------------------------------------------------------------------------
// Trigger update of fields (Skapa ansökan)
add_action("gform_after_submission_11", "sz_acf_post_submission_11", 10, 2);
add_action("gform_after_submission_20", "sz_acf_post_submission_11", 10, 2);
function sz_acf_post_submission_11 ($entry, $form)
{
$post_id = $entry["post_id"];
$furnished = get_post_custom_values("obj_furnished", $post_id);
$signedby = get_post_custom_values("obj_signedby", $post_id);
$type = get_post_custom_values("obj_type", $post_id);
$conditions = get_post_custom_values("obj_conditions", $post_id);
update_field("field_50b5f58f1043a", $furnished, $post_id);
update_field("field_50b5f62fbf653", $signedby, $post_id);
update_field("field_13", $type, $post_id);
update_field("field_14", $conditions, $post_id);
}
// Trigger update of fields (Lägg till objekt)
add_action("gform_after_submission_13", "sz_acf_post_submission_13", 10, 2);
add_action("gform_after_submission_19", "sz_acf_post_submission_13", 10, 2);
function sz_acf_post_submission_13 ($entry, $form)
{
$post_id = $entry["post_id"];
$included = get_post_custom_values("obj_included", $post_id);
$conditions = get_post_custom_values("obj_conditions", $post_id);
$signedby = get_post_custom_values("obj_signedby", $post_id);
update_field("field_50a646c64ecbc", $included, $post_id);
update_field("field_50a6493e4ecc2", $conditions, $post_id);
update_field("field_50a6497a4ecc3", $signedby, $post_id);
}
// ---------------------------------------------------------------------------------
/* Disable wp-admin access for all users but admins. */
add_action( 'init', 'blockusers_init' );
function blockusers_init() {
if ( is_admin() && ! current_user_can( 'administrator' ) &&
! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
wp_redirect( home_url() );
exit;
}
}
/* Disable WordPress Admin Bar for all users but admins. */
if (!current_user_can('administrator')):
show_admin_bar(false);
endif;
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'objects_feed_rss2', 10, 1 );
function objects_feed_rss2( $for_comments ) {
$rss_template = get_template_directory() . '/feeds/objects-feed-rss2.php';
if( get_query_var( 'post_type' ) == 'objects' and file_exists( $rss_template ) )
load_template( $rss_template );
else
do_feed_rss2( $for_comments ); // Call default function
}
// ---------------------------------------------------------------------------------
/* Change email sender */
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
function new_mail_from($old) {
return 'noreply@myplejs.se';
}
function new_mail_from_name($old) {
return 'myplejs.se';
}

// ---------------------------------------------------------------------------------
// Stad fix
function print_contract_city( $terms ) {
// if terms is not array or its empty don't proceed
if ( ! is_array( $terms ) || empty( $terms ) ) {
return false;
}
foreach ( $terms as $term ) {
// if the term have a parent, set the child term as attribute in parent term
if ( $term->parent != 0 )  {
$terms[$term->parent]->child = $term;
} else {
// record the parent term
$parent = $term;
}
}
$location = "$parent->name, {$parent->child->name}, {$parent->child->child->name},";
$new_string = str_replace(","," ",$location);
echo $new_string . ' ';

}
// ---------------------------------------------------------------------------------
// Filter för ajax filtrering - Sortera hyrestagare - Visa alla poststatusar samt bara senaste 40 dagar
add_filter('uwpqsf_query_args','addnew_post_type','',3);
function addnew_post_type($args, $id,$getdata){
$args['post_status'] = array( 'pending', 'draft', 'future', 'publish' );
$args['date_query'] = array(array('column' => 'post_date_gmt','after'  => '40 days ago',));
return $args;
}
?>
<?php
// ---------------------------------------------------------------------------------
// Gravity form submit buttons. add font awespme
$currentlang = get_bloginfo('language'); if($currentlang=="en-US"):
add_filter("gform_submit_button_10", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
return "<button class='button' id='gform_submit_button_{$form["id"]}'><span> Send </span></button>";
}
else:
add_filter("gform_submit_button_10", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
return "<button class='button' id='gform_submit_button_{$form["id"]}'><span> Skicka </span></button>";
}
endif; ?>
<?php
// ajax filter result
add_filter('uwpqsf_result_tempt', 'customize_output', '', 4);
function customize_output($results , $arg, $id, $getdata ){
// The Query
$apiclass = new uwpqsfprocess();

$query = new WP_Query( $arg );
ob_start(); $result = '';
// The Loop

if ( $query->have_posts() ) {
while ( $query->have_posts() ) {
$query->the_post();global $post;?>

<li class="obj-sort clearfix lala">
    <a target="_blank" href="https://mail.google.com/mail/u/0/#search/<?php the_title(); ?>?compose=new">
        <h2><?php the_title(); ?></h2>
    </a>
    </br>
    <!-- stadsdel -->
    <h4><?php $terms = get_the_terms($post->ID,'obj_city');
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
    echo "$list"; ?>
    </h4>
    <!-- inlinelist -->
    <ul class="inlinelist">
        <!-- antal rum -->
        <?php if (get_field('obj_rooms')): ?>
        <li class="rum"><?php the_field ('obj_rooms'); ?></li>
        <?php endif; ?>
        
        <!-- storlek -->
        <?php if (get_field('obj_size')): ?>
        <li class="storlek"><?php the_field ('obj_size'); ?> <?php _e('kvm', 'myplejs'); ?></li>
        <?php endif; ?>
        
        <!-- hyra -->
        <?php if (get_field('obj_rent')): ?>
        <li class="pris"><?php the_field ('obj_rent'); ?> SEK</li>
        <?php endif; ?>
        <!-- inflyttningsdatum -->
        <?php if (get_field('obj_move')): ?>
        <li class="inflytt"><span value="<?php $date = get_field('obj_move');?>">
            <?php
            $today = time();
            if($timestamp<$today):
            _e('Omgående', 'myplejs');
            else :
            echo get_field('obj_move');
            endif; ?>
        </span></li>
        <?php else: ?>
        <li>Omgående</li>
        <?php endif; ?>
        
        <!-- hyrestid -->
        <?php if (get_field('obj_contractlenght')): ?>
        <li class="langd">
            <span><?php $value_lenght = get_field( "obj_contractlenght" ); if ($value_lenght == '100') { _e('Tillsvidare', 'myplejs'); } else { the_field ('obj_contractlenght'); } ?></span>
            
            <?php if ($value_lenght == '1') { _e('månad', 'myplejs'); }
            
            elseif ($value_lenght == '100') { }
            
            else { _e('månader', 'myplejs'); } ?>
            
        </li>
        <?php endif; ?>
        </ul><!-- inlinelist -->
 
    <?php echo'</li>';
    }
    echo  $apiclass->ajax_pagination($arg['paged'],$query->max_num_pages, 4, $id, $getdata);
    } else {
    echo  'Din filtrering gav inga resultat';
    }
    /* Restore original Post Data */
    wp_reset_postdata();
    
    $results = ob_get_clean();
    return $results;
    }
    // this fix applies ONLY for the meta_key (field) as variable (in this case 'obj_move') in the function, and when it uses the format 'dd/mm/yyyy'
    // be sure to set the format 'dd/mm/yyyy' under all 'formulär' for this field (inflyttningsdatum), and '' under 'Custom Fields' for all field groups
    // when dates are saved by Advanced Custom Fields Plugin and/or Gravityforms
    // the values are set in tables 'wp_rg_lead_detail' AND 'wp_postmeta', in the format 'dd/mm/yyyy', or worse, like 'a:0:{}' (whatever that is).
    // in table 'wp_postmeta' the format should be 'yyyymmdd'
    // so what we do is to change the format after the plugins save it.
    // no use of fancy functions to change the date, backwards compatible is what we want
    // i put it in a function so we dont have any problems with variables with the same name somewhere else.
    // for now, it is executed in the template file 'page-reg-hyrut-steg2.php', just after the form is filled in
    // ------------------------- define function -------------------------
    function change_date_format_for_object($m_key) {
    // ------------------------- connect to the database -------------------------
    //go for defaults
    $hs = DB_HOST;
    $db = DB_NAME;
    $us = DB_USER;
    $pw = DB_PASSWORD;
    global $table_prefix;
    $tp = $table_prefix;
    // making a connection to the database
    $cn = mysql_connect($hs, $us, $pw) or die("Could not connect.");
    if(!$cn) {
    die("no db");
    }
    if(!mysql_select_db($db,$cn)) {
    die("No database selected.");
    }
    // ------------------------- delete from database (change values 'a:0:{}' to empty) -------------------------
    $qy = '';
    if ( $m_key != '' ) {
    $qy = "UPDATE `wp_postmeta` SET meta_value = '' WHERE meta_key = '" . $m_key . "' AND  meta_value = 'a:0:{}'";
    }
//print "<br />-query-<br>\n-<pre>" . $qy . "-</pre><br />\n";
if ( $qy != '' ) {
$del_result = mysql_query ($qy,$cn);
if (!$del_result) {
print mysql_errno();
print mysql_error();
}
}
// ------------------------- select from database -------------------------
$qy = '';
if ( $m_key != '' ) {
$qy = "SELECT * FROM `wp_postmeta` WHERE meta_key = '" . $m_key . "' AND  meta_value LIKE '%/%'";
}
//print "<br />-query-<br>\n-<pre>" . $qy . "-</pre><br />\n";
if ( $qy != '' ) {
$result = mysql_query ($qy,$cn);
if (!$result) {
print mysql_errno();
print mysql_error();
}
}
// ------------------------- put it in an array -------------------------
$array = '';
$numberof_results = mysql_num_rows($result);
if ( $numberof_results != 0 ) {
$indx_rows=0;
while ($rows = mysql_fetch_row($result)) {
$array[$indx_rows] = $rows;
$indx_rows++;
}
mysql_free_result($result);
}
//print '<br />' . $numberof_results . ' results found<br />';
// ------------------------- loop array values -------------------------
if ( $array != '' ) {
while ($rows = each($array)) {
$meta_id = $rows[1][0];
$post_id = $rows[1][1];
$meta_key = $rows[1][2];
$meta_value = $rows[1][3];
// ------------------------- change format from 'dd/mm/yyyy' to 'yyyymmdd' -------------------------
//$meta_value = 'dd/mm/yyyy';
$new_meta_value = '';
// be carefull its the right format
if ( $meta_value != '' && substr_count($meta_value, '/') == 2 ) {
$meta_value_arr = explode('/', $meta_value);
// be carefull its the right format
if ( strlen($meta_value_arr[0]) == 2 && strlen($meta_value_arr[1]) == 2 && strlen($meta_value_arr[2]) == 4 ) {
$new_meta_value = $meta_value_arr[2] . $meta_value_arr[1] . $meta_value_arr[0];
}
}
// ------------------------- save values -------------------------
if ($new_meta_value != '') {
//print '<br />new value: ' . $new_meta_value;
$qy = '';
if ( $meta_id != '' ) {
$qy = "UPDATE `wp_postmeta` SET meta_value = '" . $new_meta_value . "' WHERE meta_id = '" . $meta_id . "'";
}
//print "<br />-query-<br>\n-<pre>" . $qy . "-</pre><br />\n";
if ( $qy != "" ) {
$sub_result = mysql_query ($qy,$cn);
if (!$sub_result) {
print mysql_errno();
print mysql_error();
}
}
}
// show something is happening..
print '~';
//break;
// ------------------------- end loop array values -------------------------
}
}
// ------------------------- end define function -------------------------
}
?>