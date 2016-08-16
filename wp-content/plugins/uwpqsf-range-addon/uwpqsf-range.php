<?php
/*
Plugin Name: Ultimate WP Query Search Filter - Range Input Add On
Plugin URI: http://www.9-sec.com/
Description: This is an add on for Ultimate WP_Query Search Filter for various range input for meta field.
Version: 1.3
Author: TC 
Author URI: http://www.9-sec.com/

*/
/*  Copyright © 2014  TCK (email: devildai@gmail.com) http://www.9-sec.com
 
*/
include_once(ABSPATH.'wp-admin/includes/plugin.php');
if(is_plugin_active('ultimate-wp-query-search-filter/ultimate-wpqsf.php')) {

add_filter('ucmf_compare','ucmf_compare_range');
function ucmf_compare_range($compares){
  $compares['crange'] = 'Range';
  return $compares;	
}

add_filter('uwpqsfcmf_field', 'uwpqsf_range_cmf');
function uwpqsf_range_cmf($fields){
	$fields['sildertextrange'] = 'Slider Range with Text Input';  
	$fields['silderonlyrange'] = 'Slider Range Only';  
	$fields['textrange'] = 'Text Input Range Only';
	return $fields;
}

add_action('uwpsf_cmfoption_desc', 'urange_addon_desc'); 
function urange_addon_desc(){
?>
<br>
<span class="desciption"><?php _e("<b>Notice:</b> For <b>Slider Range</b> you can set the min and max value by 'range => 0-1000' (0 is min and 1000 is max) in the options box" , "UWPQSF") ;?></span>
<br>
<span class="desciption"><?php _e("<b>Notice:</b> For <b>Text Input Range</b>, there are no need ener value in option box" , "UWPQSF") ;?></span>


<?php
}

add_action( 'wp_enqueue_scripts', 'utwoinput_slider_scripts',99 );
function utwoinput_slider_scripts(){
		
		wp_enqueue_script( 'jquery-ui-slider' );
		wp_register_style( 'rangeslider',  plugins_url('style.css', __FILE__),   array(),     '2013',    'all' );
		wp_enqueue_style(  'rangeslider');
}

add_filter('uwpqsf_addcmf_field_sildertextrange', 'front_uslider_text','',10);
function front_uslider_text( $type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass){
		 if($type == 'sildertextrange'){
		    $s = explode("|",$metaval);
			foreach( $s as $k=>$v){
			  $v=explode("=>",$v);
			  $a[trim($v[0])] = $v[1];
			}
		 $range = explode('-',$a['range']);
		 $step = isset($a['step']) ? $a['step'] : '1';
		 $maxlabel = isset($a['maxlabel']) ? $a['maxlabel'] : '';
		 $minlabel = isset($a['minlabel']) ? $a['minlabel'] : '';
		 	
		 $html  = '<div class="'.$defaultclass.' '.$divclass.' cmftext-'.$i.'"><span class="cmflabel-'.$i.'">'.$label.'</span>';
		 $html .= '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$metakey.'">';
		 $html .= '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$compare.'">';
		 $html .= '<input type="hidden" id="step" value="'.$step.'">';
		$html .= '<div class="rangelabel"><label class="labelmin">'.$minlabel.' <input type="text" class="slideinput-'.$i.'" id="range1" name="cmf['.$i.'][value][val1]" value="'.$range[0].'"></label><label class="labelmax">'.$maxlabel.' <input type="text"  class="slideinput-'.$i.'" id="range2" name="cmf['.$i.'][value][val2]" value="'.$range[1].'"></label></div>';	
		
		 $html .= '<div id="inputrange" class="rangclass-'.$i.'">'.$range[0].'-'.$range[1].'</div>';
		 $html .= '</div>';
			return  apply_filters( 'uwpqsf_cmf_range_text_slider', $html,$type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
		}	
}

add_filter('uwpqsf_addcmf_field_silderonlyrange', 'front_uslider_only','',10);
function front_uslider_only($type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass){
		 if($type == 'silderonlyrange'){
		    $s = explode("|",$metaval);
			foreach( $s as $k=>$v){
			  $v = explode("=>",$v);
			  $a[trim($v[0])] = $v[1];
			}
		 $range = explode('-',$a['range']);
		 $step = isset($a['step']) ? $a['step'] : '1';
		 $maxlabel = isset($a['maxlabel']) ? $a['maxlabel'] : '';
		 $minlabel = isset($a['minlabel']) ? $a['minlabel'] : '';
		 	
		 $html  = '<div class="'.$defaultclass.' '.$divclass.' cmftext-'.$i.'"><span class="cmflabel-'.$i.'">'.$label.'</span>';
		 $html .= '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$metakey.'">';
		 $html .= '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$compare.'">';
		 $html .= '<input type="hidden" id="step" value="'.$step.'">';
		 $html .= '<input type="hidden" class="slideinput-'.$i.'" id="range1" name="cmf['.$i.'][value][val1]" value="'.$range[0].'" readonly>';
		 $html .= '<input type="hidden"  class="slideinput-'.$i.'" id="range2" name="cmf['.$i.'][value][val2]" value="'.$range[1].'" readonly>';
		 $html .= '<div class="rangelabel"><label class="labelmin">'.$minlabel.'<span class="rangeread1">'.$range[0].'</span></label><label class="labelmax">'.$maxlabel.'<span class="rangeread2">'.$range[1].'</span></label></div>';
		 $html .= '<div id="inputrange" class="rangclass-'.$i.'">'.$range[0].'-'.$range[1].'</div>';
		 $html .= '</div>';
			return  apply_filters( 'uwpqsf_cmf_range_slider_only', $html,$type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
		}	
}

add_filter('uwpqsf_addcmf_field_textrange', 'front_urange_text','',10);
function front_urange_text( $type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass){
		 if($type == 'textrange'){
		    $s = explode("|",$metaval);
			foreach( $s as $k=>$v){
			  $v=explode("=>",$v);
			  $a[trim($v[0])] = $v[1];
			}
		
		 $maxlabel = isset($a['maxlabel']) ? $a['maxlabel'] : '';
		 $minlabel = isset($a['minlabel']) ? $a['minlabel'] : '';
		 	
		 $html  = '<div class="'.$defaultclass.' '.$divclass.' cmftext-'.$i.'"><span class="cmflabel-'.$i.'">'.$label.'</span>';
		 $html .= '<input type="hidden" name="cmf['.$i.'][metakey]" value="'.$metakey.'">';
		 $html .= '<input type="hidden" name="cmf['.$i.'][compare]" value="'.$compare.'">';
	
		$html .= '<div class="rangelabel"><label class="labelmin">'.$minlabel.' <input type="text" class="slideinput-'.$i.'" id="range1" name="cmf['.$i.'][value][val1]" value=""></label><label class="labelmax">'.$maxlabel.' <input type="text"  class="slideinput-'.$i.'" id="range2" name="cmf['.$i.'][value][val2]" value=""></label></div>';	
		 $html .= '</div>';
			return  apply_filters( 'uwpqsf_cmf_range_text_only', $html,$type,$metakey,$compare,$metaval,$label,$all,$i,$defaultclass,$id,$divclass);
		}	
}

add_action( 'wp_print_footer_scripts', 'uwpqsf_slider_script', 11 );
function uwpqsf_slider_script(){
	?>
			
		    <script type="text/javascript">
		  jQuery(document).ready(function($) {
			$( "[id^=uwpqsffrom_]  #inputrange" ).each(function() {
				var rvalue = $( this ).text();
				var drange = rvalue.split('-');
				var cstep = $(this).parent().find('#step').val();
			      $( this ).empty().slider({
		     	        range: true,
		      		min: parseInt(drange[0],10),
		      		max: parseInt(drange[1],10),
		      		values: [ parseInt(drange[0],10), parseInt(drange[1],10) ],
				step: parseInt(cstep,10),
				change: function(event, ui) {process_data($(this)); },
		      		slide: function( event, ui ) {
				$(this).parent().find("#range1" ).val(ui.values[ 0 ]);
				$(this).parent().find("#range2" ).val(ui.values[ 1 ]);
				$(this).parent().find(".rangeread1" ).text(ui.values[ 0 ]);
				$(this).parent().find(".rangeread2" ).text(ui.values[ 1 ]); 	
		      		}
				
		    		});
			});
		
			  
		    });
 
              </script>
		
	<?php
}

add_filter('uwpqsf_get_cmf', 'add_utworangecmf_get','',3);
function add_utworangecmf_get( $cmf,$id, $getcmf ){
	foreach($getcmf as  $v){
		if($v['compare'] == 'crange'){
		     $min = !empty($v['value']['val1']) ? $v['value']['val1'] : 0;
		     $max = !empty($v['value']['val2'])	? $v['value']['val2'] :  999999999999999999;	
			$cmf[] = array(
				'key' => strip_tags( stripslashes($v['metakey'])),
				'value' => array($min,$max),
				'type' => 'numeric',
				'compare' => 'BETWEEN'
				);
		
		}
       }
	  return $cmf;
 }	



}
?>
