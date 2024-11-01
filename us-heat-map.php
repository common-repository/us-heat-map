<?php
/*
Plugin Name: US Heat Map
Plugin URI: 
Description: A plugin that allows users to easily show a "heat distribution" of data across a usmap.  For example, if you wanted to show which states your company's representatives are in, each state would correspond to a specific number which would be converted to graphically show on a US map. 
Author: Avinash Thangirala
Version: 1.0
Author URI: 
*/

/*  Copyright 2016 Avinash Thangirala

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

function heatMapAviThangirala_func( $atts){
	
	global $content_width;	

$params = shortcode_atts( array(
		'al'=> 0,
		'ak'=> 0,
		'as'=> 0,
		'az'=> 0,
		'ar'=> 0,
		'ca'=> 0,
		'co'=> 0,
		'ct'=> 0,
		'de'=> 0,
		'dc'=> 0,
		'fm'=> 0,
		'fl'=> 0,
		'ga'=> 0,
		'gu'=> 0,
		'hi'=> 0,
		'id'=> 0,
		'il'=> 0,
		'in'=> 0,
		'ia'=> 0,
		'ks'=> 0,
		'ky'=> 0,
		'la'=> 0,
		'me'=> 0,
		'mh'=> 0,
		'md'=> 0,
		'ma'=> 0,
		'mi'=> 0,
		'mn'=> 0,
		'ms'=> 0,
		'mo'=> 0,
		'mt'=> 0,
		'ne'=> 0,
		'nv'=> 0,
		'nh'=> 0,
		'nj'=> 0,
		'nm'=> 0,
		'ny'=> 0,
		'nc'=> 0,
		'nd'=> 0,
		'mp'=> 0,
		'oh'=> 0,
		'ok'=> 0,
		'or'=> 0,
		'pw'=> 0,
		'pa'=> 0,
		'pr'=> 0,
		'ri'=> 0,
		'sc'=> 0,
		'sd'=> 0,
		'tn'=> 0,
		'tx'=> 1,
		'ut'=> 0,
		'vt'=> 0,
		'vi'=> 0,
		'va'=> 0,
		'wa'=> 0,
		'wv'=> 0,
		'wi'=> 0,
		'wy'=> 0,		
		'panel_color' => 'rgb(207,83,0)',
		'initial_state_color' => 'rgb(255,218,185)',
		'final_state_color' => 'rgb(207,83,0)',
		'panel_body_text' => '<strong>Click on a state</strong>',
		'panel_footer_text' => '<strong>Representative statistics</strong>',
		'hover_styles_color' => 'rgb(255,0,0)',
		'text_after_clicking' => 'There are $state_count representatives in $state_name',

    ), $atts );

	$stateCountTest = new stdClass();
	$stateCountTest ->AL = $params['al'];
	$stateCountTest ->AK = $params['ak'];
	$stateCountTest ->AS = $params['as'];
	$stateCountTest ->AZ = $params['az'];
	$stateCountTest ->AR = $params['ar'];
	$stateCountTest ->CA = $params['ca'];
	$stateCountTest ->CO = $params['co'];
	$stateCountTest ->CT = $params['ct'];
	$stateCountTest ->DE = $params['de'];
	$stateCountTest ->DC = $params['dc'];
	$stateCountTest ->FM = $params['fm'];
	$stateCountTest ->FL = $params['fl'];
	$stateCountTest ->GA = $params['ga'];
	$stateCountTest ->GU = $params['gu'];
	$stateCountTest ->HI = $params['hi'];
	$stateCountTest ->ID = $params['id'];
	$stateCountTest ->IL = $params['il'];
	$stateCountTest ->IN = $params['in'];
	$stateCountTest ->IA = $params['ia'];
	$stateCountTest ->KS = $params['ks'];
	$stateCountTest ->KY = $params['ky'];
	$stateCountTest ->LA = $params['la'];
	$stateCountTest ->ME = $params['me'];
	$stateCountTest ->MH = $params['mh'];
	$stateCountTest ->MD = $params['md'];
	$stateCountTest ->MA = $params['ma'];
	$stateCountTest ->MI = $params['mi'];
	$stateCountTest ->MN = $params['mn'];
	$stateCountTest ->MS = $params['ms'];
	$stateCountTest ->MO = $params['mo'];
	$stateCountTest ->MT = $params['mt'];
	$stateCountTest ->NE = $params['ne'];
	$stateCountTest ->NV = $params['nv'];
	$stateCountTest ->NH = $params['nh'];
	$stateCountTest ->NJ = $params['nj'];
	$stateCountTest ->NM = $params['nm'];
	$stateCountTest ->NY = $params['ny'];
	$stateCountTest ->NC = $params['nc'];
	$stateCountTest ->ND = $params['nd'];
	$stateCountTest ->MP = $params['mp'];
	$stateCountTest ->OH = $params['oh'];
	$stateCountTest ->OK = $params['ok'];
	$stateCountTest ->OR = $params['or'];
	$stateCountTest ->PW = $params['pw'];
	$stateCountTest ->PA = $params['pa'];
	$stateCountTest ->PR = $params['pr'];
	$stateCountTest ->RI = $params['ri'];
	$stateCountTest ->SC = $params['sc'];
	$stateCountTest ->SD = $params['sd'];
	$stateCountTest ->TN = $params['tn'];
	$stateCountTest ->TX = $params['tx'];
	$stateCountTest ->UT = $params['ut'];
	$stateCountTest ->VT = $params['vt'];
	$stateCountTest ->VI = $params['vi'];
	$stateCountTest ->VA = $params['va'];
	$stateCountTest ->WA = $params['wa'];
	$stateCountTest ->WV = $params['wv'];
	$stateCountTest ->WI = $params['wi'];
	$stateCountTest ->WY = $params['wy'];

	$stateCountsJson = json_encode($stateCountTest);
	
	
	$initialStateColor =  $params['initial_state_color'];
	$finalStateColor =  $params['final_state_color'];
	$panelBodyText = $params['panel_body_text'];
	$panelFooterText = $params['panel_footer_text'];
	$panelColor = $params['panel_color'];
	$hoverStylesColor = $params['hover_styles_color'];
	$textAfterClicking = $params['text_after_clicking'];
	
	$pattern = '/[0-9]{1,3},[0-9]{1,3},[0-9]{1,3}/';
	$rgbValues = preg_match($pattern,$panelColor,$matches);
	$rgbValues = explode(',',$matches[0]);
	$panelColor = rgb2hex($rgbValues);
	
		
	$array_to_localize = array(
	'stateCountsJson' => $stateCountsJson,
	'contentWidth' => $content_width,
	'initialStateColor' => $initialStateColor,
	'finalStateColor' => $finalStateColor,
	'panelColor' => $panelColor,
	'hoverStylesColor' => $hoverStylesColor,
	'textAfterClicking' => $textAfterClicking
	);
	
	
	//wp_register_script( 'usHeatMap', '/wp-content/plugins/us-heat-map/maps/us-map-1.0.1/usmap.js' );		
	wp_enqueue_script( 'usHeatMap', plugins_url('maps/us-map-1.0.1/usmap.js', __FILE__ ));		
	wp_localize_script( 'usHeatMap', 'phpVariables', $array_to_localize);	
	
	wp_enqueue_style( 'usHeatMapStyles', plugins_url('us-heat-map-styles.css', __FILE__ ));	
	wp_enqueue_script( 'jquery' );		
	wp_enqueue_script( 'jquery-effects-highlight');	
	
	wp_enqueue_script( 'raphael',  plugins_url('maps/us-map-1.0.1/lib/raphael.js', __FILE__ ));			
	wp_enqueue_script( 'jqueryUsMap', plugins_url('maps/us-map-1.0.1/jquery.usmap.js', __FILE__ ) );	

	
		
	$panel = '
		 
		 
		 <div class="panel panel-default center-block" style="width:0px;background-color:'.$panelColor.'; border-color:'.$panelColor.'; visibility:hidden" id="panelAviThangirala">
		  <div class="panel-body">'
			.$panelBodyText.
		  '</div>
		  <div class="panel-footer">'
			
			.$panelFooterText.
			
			'<div id="stateCount">
			</div>
		  
		  </div>
		</div>

		<div class="center-block"   id="map" style="width:0px;height:0px;visibility:hidden"></div>
		'
;

return $panel;	 
}

add_shortcode('usHeatMap', 'heatMapAviThangirala_func');

function rgb2hex($rgb) {
   $hex = "#";
   $hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
   $hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

   return $hex; // returns the hex value including the number sign (#)
}

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}
?>