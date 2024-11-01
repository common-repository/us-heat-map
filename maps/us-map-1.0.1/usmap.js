jQuery(function ($) {
	$(document).ready(function() {
		
		init();
		findMaxStateCount();	
				
		initialColorArray = getRgbValues(phpVariables.initialStateColor);
		endColorArray = getRgbValues(phpVariables.finalStateColor);
			
		var initialColor = new Color(parseInt(initialColorArray[0]),parseInt(initialColorArray[1]),parseInt(initialColorArray[2]));	
		var endColor = new Color(parseInt(endColorArray[0]),parseInt(endColorArray[1]),parseInt(endColorArray[2]));
		
		var increment = new Increment(initialColor, endColor, maxValue);
		makeStateStyles(increment);
		
		
		setMapDimensions(calculateMapDimensions());	
		
		$(window).resize(function() {			
				setMapDimensions(calculateMapDimensions());
				var svg = $('#map').find('svg')[0];		
				svg.setAttribute('height', calculateMapDimensions()['height']);	
		});
		
		$('#map').usmap({		
			
			stateStyles: {fill: initialColor.hexTotal, "stroke-width": 2},
			stateHoverStyles: {fill: rgb2hex(phpVariables.hoverStylesColor)},		
			showLabels: true,
			labelBackingHoverStyles: {fill: phpVariables.hoverStylesColor},
			stateSpecificStyles: stateStyles,
			
			'click': function(event, data) {	
				
				
				for (var abbreviation in stateNames) {
					if (stateNames.hasOwnProperty(abbreviation)) {
						
						if(data.name == abbreviation)
						{
							clickedState = stateNames[abbreviation]	
													
						}
					}
				}
				
				for (var abbreviation in stateCounts) {
					if (stateCounts.hasOwnProperty(abbreviation)) {
											
						
						if(data.name == abbreviation)
						{
							clickedStateCount = parseInt(stateCounts[abbreviation]);										
						}
					}
					
				}
				
				textAfterClicking = phpVariables.textAfterClicking.replace('$state_name',clickedState);
				textAfterClicking = textAfterClicking.replace('$state_count',clickedStateCount);
				
				
				
				$('#stateCount').html(textAfterClicking);
				$('.panel-footer').effect("highlight",{color: phpVariables.panelColor}, 500);
				
			},	
			
			/* 'mouseoverState': {
			  'CA' : function(event, data) {
				alert('The state specific handler was clicked');
			  }
			} */
				
				
		});
		
		
		
		var svg = $('#map').find('svg')[0];		
		svg.setAttribute('height', calculateMapDimensions()['height']);	
		
		function Color(red, green, blue) {
			this.red = red;
			this.green = green;
			this.blue = blue;		
			
			this.pad = function(str, max) {
				str = str.toString();
				return str.length < max ? this.pad("0" + str, max) : str;
			}
			
			this.getHexTotal = function()
			{
				var redVal = this.pad(this.red.toString(16),2)
				var blueVal = this.pad(this.green.toString(16),2)
				var greenVal = this.pad(this.blue.toString(16),2)
				//return "#" + this.red.toString(16) + this.green.toString(16) + this.blue.toString(16);
				return "#" + redVal + blueVal + greenVal;
			}
			this.hexTotal = this.getHexTotal();
			
			this.makeNegativesZero = function()
			{
				if(this.red<0)
					this.red = 0;
				if(this.green<0)
					this.green = 0;
				if(this.blue<0)
					this.blue = 0;
			}
			
			
					
		}
		
		function Increment(initialColor,endColor, maxValue) {
			this.red = Math.round((endColor.red-initialColor.red)/maxValue);
			this.green = Math.round((endColor.green-initialColor.green)/maxValue);
			this.blue = Math.round((endColor.blue-initialColor.blue)/maxValue);		
		}
		
		function findMaxStateCount() {
			
			maxValue = 0;
			
			for(var abbreviation in stateCounts) {
					if (stateNames.hasOwnProperty(abbreviation)) {
						
						if(parseInt(stateCounts[abbreviation]) > maxValue)
						{						
							maxValue = stateCounts[abbreviation];												
						}
					}
			}
			
			
				
		}
		
		function makeStateStyles(increment) {
			
			stateStyles = {};
			
			for(var abbreviation in stateCounts) {
				if (stateCounts.hasOwnProperty(abbreviation)) {
					
					var stateColor = new Color(initialColor.red,initialColor.green,initialColor.blue);				
					addIncrement(stateColor,increment,stateCounts[abbreviation]);				
					
					stateStyles[abbreviation] = {"fill":stateColor.getHexTotal()};	
						
				}
			}
			
			
		}
		
		function addIncrement(color, increment, multiplier)
		{		
			color.red += increment.red*multiplier;
			color.green += increment.green*multiplier;
			color.blue += increment.blue*multiplier;
			color.makeNegativesZero();
			color.hexTotal = color.getHexTotal();		
		}
		
		function calculateMapDimensions()
		{
			var width_nopx = $("#map").parent().width();
					
			var width = (width_nopx)+'px';
			if(width == null || width == undefined)
			{
				width = Math.round(phpVariables.contentWidth) + "px";
			}			
		
			var height = width_nopx*.65+'px';		
			
			var dimensions = [];
			dimensions["height"] = height;
			dimensions["width"] = width;
			
			return dimensions;						
		}
		
		function setMapDimensions(dimensions)
		{
		document.getElementById("map").style.width = dimensions['width'];
			document.getElementById("map").style.height = dimensions['height'];		
			document.getElementById("panelAviThangirala").style.width = dimensions['width'];
			document.getElementById("map").style.visibility = "visible";
			document.getElementById("panelAviThangirala").style.visibility = "visible";
		}
		
		function rgb2hex(rgb) {
			rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);		
			function hex(x) {
				return ("0" + parseInt(x).toString(16)).slice(-2);
			}
			return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
			
		}
		
		function getRgbValues(rgb) {
			rgbValues = rgb.match(/[0-9]{1,3},[0-9]{1,3},[0-9]{1,3}/);	
			rgbValues = rgbValues[0].split(',');	
			return rgbValues;		
		}
		
		function init(){
			
			stateCounts = $.parseJSON(phpVariables.stateCountsJson);
			
			
			
					
			stateNames = 
			{
				"AL": "Alabama",
				"AK": "Alaska",
				"AS": "American Samoa",
				"AZ": "Arizona",
				"AR": "Arkansas",
				"CA": "California",
				"CO": "Colorado",
				"CT": "Connecticut",
				"DE": "Delaware",
				"DC": "District Of Columbia",
				"FM": "Federated States Of Micronesia",
				"FL": "Florida",
				"GA": "Georgia",
				"GU": "Guam",
				"HI": "Hawaii",
				"ID": "Idaho",
				"IL": "Illinois",
				"IN": "Indiana",
				"IA": "Iowa",
				"KS": "Kansas",
				"KY": "Kentucky",
				"LA": "Louisiana",
				"ME": "Maine",
				"MH": "Marshall Islands",
				"MD": "Maryland",
				"MA": "Massachusetts",
				"MI": "Michigan",
				"MN": "Minnesota",
				"MS": "Mississippi",
				"MO": "Missouri",
				"MT": "Montana",
				"NE": "Nebraska",
				"NV": "Nevada",
				"NH": "New Hampshire",
				"NJ": "New Jersey",
				"NM": "New Mexico",
				"NY": "New York",
				"NC": "North Carolina",
				"ND": "North Dakota",
				"MP": "Northern Mariana Islands",
				"OH": "Ohio",
				"OK": "Oklahoma",
				"OR": "Oregon",
				"PW": "Palau",
				"PA": "Pennsylvania",
				"PR": "Puerto Rico",
				"RI": "Rhode Island",
				"SC": "South Carolina",
				"SD": "South Dakota",
				"TN": "Tennessee",
				"TX": "Texas",
				"UT": "Utah",
				"VT": "Vermont",
				"VI": "Virgin Islands",
				"VA": "Virginia",
				"WA": "Washington",
				"WV": "West Virginia",
				"WI": "Wisconsin",
				"WY": "Wyoming"
			};
			
			//console.log(rgb2hex('rgb(207,83,0)'));
			//console.log(getRgbValues("rgb(123,234,2)"));
						
		};
		
		
		
	  });
  
  });