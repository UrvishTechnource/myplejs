<?php
/*
This is the custom post type taxonomy template.
If you edit the custom taxonomy name, you've got
to change the name of this template to
reflect that name change.

i.e. if your custom taxonomy is called
register_taxonomy( 'shoes',
then your single template should be
taxonomy-shoes.php

*/
?>

<?php get_header(); ?>
			
		<div id="objlist-header">
<div style="float:left;">
<h1>Aktuella objekt</h1>
<ul>
	<li>Antal rum</li>
	<li>Storlek</li>
	<li>Pris/månad</li>
	<li>Inflyttning</li>
	<li>Hyreslängd</li>
</ul>
</div>
<span id="list-change" class="selected"></span>
<span id="view-change"></span>

</div>



<div id="objlist-wrap" class="clearfix">
				<div id="obj-filter-sidebar">
					
					<h2>Anpassa sökning</h2>
					
					

					<div style="padding: 0 10px;">
					
														<div id="startfilter" class="" role="complementary">

					<?php if ( is_active_sidebar( 'startfilter' ) ) : ?>

						<?php dynamic_sidebar( 'startfilter' ); ?>

					<?php else : ?>
					<?php endif; ?>


				</div>				
						</div>
						
						

					</div>
				</div> <!-- end obj-filter-sidebar -->


				<div id="objlist" class="">
<?php
global $query_string;
query_posts($query_string . "post_type=objects&post_status=publish&posts_per_page=100");
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

include('library/tpl/obj-list.php');?>

<?php endwhile; 
endif; ?>

<?php wp_reset_query(); ?>



								           
								        
							

           
			


				</div> <!-- end objlist -->

				<div id="objview" class="hidden">

<?php
global $query_string;
query_posts($query_string . "post_type=objects&post_status=publish&posts_per_page=100");
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

include('library/tpl/obj-view.php');?>

<?php endwhile; 
endif; ?>

<?php wp_reset_query(); ?>


				</div> <!-- end objview -->


</div> <!-- end objlist-wrap -->

<?php get_footer(); ?>