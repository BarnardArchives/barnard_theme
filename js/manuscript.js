(function ($) {
    Drupal.behaviors.bc_manuscript_transcript_toggle = {
        attach: function (context, settings) {
            $("#manuscript-transcript-toggle").click(function (event) {
                event.preventDefault();
                if ($("#manuscript-viewer-transcript-pane").css("display") == "none") {
                    $("#manuscript-viewer-osd-pane").width("49%");
                    $("#manuscript-viewer-transcript-pane").width("49%");
                }
                else {
                    // XXX: Should be something more like
                    // `width of parents-width of sibling`. But taking manual
                    // control is a can of worms with re-size.
                    $("#manuscript-viewer-osd-pane").width("90%");
                }
                $("#manuscript-viewer-transcript-pane").toggle();
                if (this.innerHTML.match(/^Hide/)) {
                    this.innerHTML = "Show transcript";
                }
                else if (this.innerHTML.match(/^Show/)) {
                    this.innerHTML = "Hide transcript";
                }
            });
        }
    }

    Drupal.behaviors.bc_manuscript_transcript_page = {
        attach: function (context, settings) {
            $('#manuscript-viewer-transcript-pane').hide();
            $('.manuscript-transcript-page').each(function() {
                $(this).hide();
            });
            $('.manuscript-transcript-page').first().addClass('active').show();
            // NB this only works because islandora uses outdated OpenSeadragon.
            // Might need to change in the future...
            settings.islandora_open_seadragon_viewer.onPageChange = function(event) {
                var target_page = event.page + 1;
                console.log('got target page: ' + target_page);
                var $active_page = $('#manuscript-viewer-transcript-pane').find('.manuscript-transcript-page.active');
                var $target_page = $('#manuscript-viewer-transcript-pane').find('#page-'+ target_page);
                $active_page.hide().removeClass('active');
                $target_page.show().addClass('active');
            }
        }
    }
})(jQuery);
