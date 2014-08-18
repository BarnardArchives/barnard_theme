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
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {

    // Adds placeholder text in the islandora solr simple search form
	$('#block-islandora-solr-simple input.form-text', context).val(Drupal.t('Search...'));
	  $('#block-islandora-solr-simple input.form-text', context).focus(function() {
	      if ($(this).val() == Drupal.t('Search...')) $(this).val('');
	  });
	  $('#block-islandora-solr-simple input.form-text', context).blur(function() {
	      if ($(this).val() == '') $(this).val(Drupal.t('Search...'));
	  });
	  }
	};

})(jQuery, Drupal, this, this.document);
