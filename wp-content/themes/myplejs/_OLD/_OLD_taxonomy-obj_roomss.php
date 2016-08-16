

<?php get_header(); ?>
<style type="text/css">
.hidden {display: none;}

</style>
<script type="text/javascript">
	jQuery(document).ready(function() {
    jQuery("#list-change").click(function () {
      jQuery("#objview").addClass("hidden");
      jQuery("#objlist").removeClass("hidden");
    });
    jQuery("#view-change").click(function () {
      jQuery("#objlist").addClass("hidden");
      jQuery("#objview").removeClass("hidden");
    });

}); 
</script>

		

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
					
					<!-- <form method="get" action="http://myplejs.dev.sz-client.se/" class="taxonomy-drilldown-checkboxes"> -->

					<div style="padding: 0 10px;">
						<div id="startfilter" class="" role="complementary">

					<?php if ( is_active_sidebar( 'startfilter' ) ) : ?>

						<?php dynamic_sidebar( 'startfilter' ); ?>

					<?php else : ?>
					<?php endif; ?>


				</div>	
				<!-- 
						<div class="left filter-stad">
						<h3>Stad</h3>
						<fieldset class="stad">
						
						<input type="checkbox" name="qmt[obj_city][]" value="5" id="sthlm"/>
						<label for="sthlm">Stockholm</label>
						<input type="checkbox" name="stad" value="mlm" id="mlm"/>
						<label for="mlm">Malmö</label>
						</fieldset>
						</div>
						<div class="left filter-bostad">
						<h3>Typ av bostad</h3>
						<fieldset class="typavbostad">
						<input type="checkbox" name="typavbostad" value="hus" id="hus"/>
						<label for="hus"/>Hus</label>
						<input type="checkbox" name="typavbostad" value="lgnht" id="lgnht"/>
						<label for="lgnht"/>Lägenhet</label>
						</fieldset>
						</div>
						<div class="left filter-antalrum">
						<h3>Antal rum</h3>
						<fieldset class="antalrum">
						<input type="checkbox" name="qmt[obj_rooms][]" value="7" id="1"/>
						<label for="1">1 rum</label>
						<input type="checkbox" name="qmt[obj_rooms][]" value="4" id="4"/>
						<label for="4">4 rum</label>
						<input type="checkbox" name="qmt[obj_rooms][]" value="2" id="2"/>
						<label for="2">2 rum</label>
						<input type="checkbox" name="qmt[obj_rooms][]" value="8" id="8"/>
						<label for="5">5+ rum</label>
						<input type="checkbox" name="qmt[obj_rooms][]" value="3" id="3"/>
						<label for="3">3 rum</label>
						</fieldset>
						
						</div>
						<div class="left filter-manadskostnad-min">
						<h3>Månadskostnad min</h3>
						<fieldset>
						<select>
						  <option value="0">0</option>
						  <option value="5000">5000</option>
						  <option value="10000">10000</option>
						  <option value="15000">15000</option>
						</select> 
						</fieldset>
						</div>
						<div class="left filter-manadskostnad-max">
						<h3>Månadskostnad max</h3>
						<fieldset>
						<select>
						  <option value="0">0</option>
						  <option value="5000">5000</option>
						  <option value="10000">10000</option>
						  <option value="15000">15000</option>
						</select> 
						</fieldset>
											
						</div>
						<div class="left filter-hyreslangd">
						<h3>Hyreslängd</h3>
						<fieldset>
						<select>
						  <option value="1">1 månad</option>
						  <option value="2">2 månader</option>
						  <option value="3">3 månader</option>
						  <option value="4">4 månader</option>
						  <option value="5">5 månader</option>
						  <option value="6">6 månader</option>
						  <option value="7">7 månader</option>
						  <option value="8">8 månader</option>
						  <option value="9">9 månader</option>
						  <option value="10">10 månader</option>
						  <option value="11">11 månader</option>
						  <option value="12">12 månader</option>
						  <option value="Tillsvidare">Tillsvidare</option>
						</select> 
						</fieldset>
											
						</div>

						
							
						</div>
														
						</div>
				
						
						</form>	-->

					</div>
				</div> <!-- end obj-filter-sidebar -->

<div class="obj-center-wrap">
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
				</div>
<div class="obj-center-wrap">
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
				</div>


</div> <!-- end objlist-wrap -->


<?php get_footer(); ?>