=== US Heat Map ===
Contributors: athangirala
Donate link: https://utdirect.utexas.edu/apps/utgiving/online/nlogon/?source=GIV
Tags: us, distribution, map
Requires at least: 1.0
Tested up to: 1.0
Stable tag: (trunk)
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A plugin that allows users to easily show a "heat distribution" of data across a usmap. 

== Description ==

A plugin that allows users to easily show a "heat distribution" of data across a usmap.  For example, if you wanted to show which states your company's representatives are in, each state would correspond to the number of representatives.  This would be converted to graphically show on a US map.  All you need is an initial color of the state (representing 0) and the color that represents the highest value within all the states.  This plugin will then calculate the colors of all the other states and graphically display it.  

This is a very simple plugin that provides some graphical distribution across the U.S. map.  I hope you find it useful to your site!

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Use the [usHeatMap] shortcode and then add two letter (lowercase) abbreviations as parameters.  There is no admin screen (everything done by shortcode).
4. Change the shortcode parameters to suit your need.  The list of parametes are shown below with an example value.  Colors need to be in the RGB format, exactly as shown ("rgb(x,x,x)").  For text, you can put plain text or any basic html.  Further, for the "text_after_clicking" variable, you can specifiy the state variable and the respective count dynamically as $state_name and $state_count.
*	initial_state_color="'rgb(255,218,185)" 
*	final_state_color="rgb(207,83,0)"
*	panel_color="rgb(255,218,185)"
*	panel_body_text="<strong>Number of representatives</strong>" 
*	panel_footer_text="<strong>Representative statistics</strong>" 
*	hover_styles_color="rgb(0,191,255)" 
*	text_after_clicking="There are $state_count representatives in $state_name"

6. An example of the state parameters is added below.  Make sure that parameter names are lowercase, and there is only one space between the end of one parameter value and the start of the next parameter name.
[usHeatMap panel_color="rgb(255,218,185)" initial_state_color="'rgb(255,218,185)" final_state_color="rgb(207,83,0)" panel_body_text="<strong>Number of representatives</strong>" panel_footer_text="<strong>Representative statistics</strong>" hover_styles_color="rgb(0,191,255)" text_after_clicking="There are $state_count representatives in $state_name" al="0" ak="0" as="0" az="0" ar="0" ca="0" co="0" ct="0" de="0" dc="0" fm="0" fl="0" ga="0" gu="0" hi="0" id="0" il="0" in="0" ia="0"	ks="0" ky="0" la="0" me="0" mh="0" md="0" ma="0" mi="0" mn="0" ms="0" mo="0" mt="0" ne="0" nv="0" nh="0" nj="0" nm="0" ny="0" nc="0" nd="0" mp="0" oh="0" ok="0" or="0" pw="0" pa="0" pr="0" ri="0" sc="0" sd="0" tn="0" tx="1" ut="0" vt="0" vi="0" va="0" wa="0" wv="0" wi="0"	wy="0"]


== Frequently Asked Questions ==

= I have activated the plugin, now what? =

The plugin works entirely through shortcode.  In this case the shortcode, is [usHeatMap].  This means that to show up in a page, you should simply add "[usHeatMap]" in the page.

= What are all the options (or parameters) for the shortcode? =

The options will allow you to add numbers to the states, change colors, and change text to your liking.  States not in the shortcode will be defaulted to 0.  Colors are defaulted to an orange-red theme.  An example that has all the options is the following:

[usHeatMap panel_color="rgb(255,218,185)" initial_state_color="'rgb(255,218,185)" final_state_color="rgb(207,83,0)" panel_body_text="<strong>Number of representatives</strong>" panel_footer_text="<strong>Representative statistics</strong>" hover_styles_color="rgb(0,191,255)" text_after_clicking="There are $state_count representatives in $state_name" al="0" ak="0" as="0" az="0" ar="0" ca="0" co="0" ct="0" de="0" dc="0" fm="0" fl="0" ga="0" gu="0" hi="0" id="0" il="0" in="0" ia="0"	ks="0" ky="0" la="0" me="0" mh="0" md="0" ma="0" mi="0" mn="0" ms="0" mo="0" mt="0" ne="0" nv="0" nh="0" nj="0" nm="0" ny="0" nc="0" nd="0" mp="0" oh="0" ok="0" or="0" pw="0" pa="0" pr="0" ri="0" sc="0" sd="0" tn="0" tx="1" ut="0" vt="0" vi="0" va="0" wa="0" wv="0" wi="0"	wy="0"]

== Screenshots ==

1. Shows what the shortcode parameters correspond to on the map.


== Changelog ==

= 1.0 =
*	Version 1.0

== Upgrade Notice ==

= 1.0 =
On version 1.0.

