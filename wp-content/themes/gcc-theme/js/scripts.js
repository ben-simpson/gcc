(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		/*--------------------------------------------------------------------------------*\
			JQUERY SVG SHIM CURTEOUSY OF JUSTIN MCCANDLESS
			http://www.justinmccandless.com/blog/Patching+jQuery's+Lack+of+SVG+Support
		\*--------------------------------------------------------------------------------*/
		
		/* addClass shim
		****************************************************/
		var addClass = $.fn.addClass;
		$.fn.addClass = function(value) {
		var orig = addClass.apply(this, arguments);

		var elem,
		  i = 0,
		  len = this.length;

		for (; i < len; i++ ) {
		  elem = this[ i ];
		  if ( elem instanceof SVGElement ) {
			var classes = $(elem).attr('class');
			if ( classes ) {
				var index = classes.indexOf(value);
				if (index === -1) {
				  classes = classes + " " + value;
				  $(elem).attr('class', classes);
				}
			} else {
			  $(elem).attr('class', value);
			}
		  }
		}
		return orig;
		};

		/* removeClass shim
		****************************************************/
		var removeClass = $.fn.removeClass;
		$.fn.removeClass = function(value) {
		var orig = removeClass.apply(this, arguments);

		var elem,
		  i = 0,
		  len = this.length;

		for (; i < len; i++ ) {
		  elem = this[ i ];
		  if ( elem instanceof SVGElement ) {
			var classes = $(elem).attr('class');
			if ( classes ) {
			  var index = classes.indexOf(value);
			  if (index !== -1) {
				classes = classes.substring(0, index) + classes.substring((index + value.length), classes.length);
				$(elem).attr('class', classes);
			  }
			}
		  }
		}
		return orig;
		};

		/* hasClass shim
		****************************************************/
		var hasClass = $.fn.hasClass;
		$.fn.hasClass = function(value) {
		var orig = hasClass.apply(this, arguments);

		var elem,
		  i = 0,
		  len = this.length;

		for (; i < len; i++ ) {
		  elem = this[ i ];
		  if ( elem instanceof SVGElement ) {
			var classes = $(elem).attr('class');

			if ( classes ) {
			  if ( classes.indexOf(value) === -1 ) {
				return false;
			  } else {
				return true;
			  }
			} else {
				return false;
			}
		  }
		}
		return orig;
		};
		
		/*--------------------------------------------------------------------------------*\
			MENU INTERACTIONS
		\*--------------------------------------------------------------------------------*/
		
		//Toggles 'hide' class for menu icon and 'active' nav menu which opens and closes on toggle.
		$( ".menu-link" ).click(function() {
			$( ".menu-link" ).toggleClass( "active" );
			$( ".menu-link .icon" ).toggleClass( "hide" );
			$( ".menu-link .link" ).toggleClass( "hide" );
			$( ".slide-menu" ).toggleClass( "hide" );
			$( "body" ).toggleClass( "lock" );
		});
		
		/*--------------------------------------------------------------------------------*\
			WAVEFORM CUSTOM INTERFACE
		\*--------------------------------------------------------------------------------*/
		
		//Toggles 'play/pause for audio player. Additional specificity is required for multiple audio players on a single page.
		$( ".play-pause" ).click(function() {
			console.log("Play/Pause was clicked");
			$( ".play-pause .icon" ).toggleClass( "hidden" );
		});
		
	});
	
})(jQuery, this);


