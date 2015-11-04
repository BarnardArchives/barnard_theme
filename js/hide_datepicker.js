/*global
    jQuery
*/

(function ($) {
    Drupal.behaviors.bc_theme_hide_datepicker = {
        attach: function (context, settings) {
            if (!settings.islandoraSolrDatepickerRange) {
                return;
            }
            var datepickerRange = settings.islandoraSolrDatepickerRange;
            $.each(datepickerRange, function () {
                var formKey = this.formKey;
                // kill datepicker
                $(".islandora-solr-datepicker-" + formKey).datepicker('destroy');
            });
        }
    };
}(jQuery));