/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
/*Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {  	
	  }
	};*/

	// Window load event used just in case window height is dependant upon images
	$(window).bind("load", function() { 
             var footerHeight = 0,
           $footer = $("#footer");
       positionFooter();
       function positionFooter() { 
                footerHeight = $footer.height(); 
               if ( ($(document.body).height()+(footerHeight)) < $(window).height()) {
                   //must stick to bottom
                   $footer.css({
                        position: "fixed",
                        bottom: 0,
                        left:0,
                        right:0
                   })
               } else {
                   $footer.attr("style", "");
               }        
       }
       $(window).resize(positionFooter);
	});
	
    //Adds placeholder text in the islandora solr simple search form
	$(document).ready(function () {
	  	$('#islandora-solr-simple-search-form input.form-text').attr('placeholder', 'Search...');
	});

})(jQuery, Drupal, this, this.document);
