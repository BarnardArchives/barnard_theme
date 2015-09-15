(function ($) {
    Drupal.behaviors.bc_theme_permalink = {
        change_text: function (input_class, reset) {
            var self = this,
                element = document.querySelector(input_class);
                newText = (element.innerHTML === 'Copy' && !reset) ? 'Copied' : 'Copy';
            element.innerHTML = newText; 
            if (element.timer) {
                window.clearTimeout(element.timer);
            }
            if (newText !== 'Copy') {
                element.timer = window.setTimeout( function(){ self.change_text(input_class, true); }, 3000);
            }
        },
        attach: function (context, settings) {
            var self = this,
                copyTextareaBtn = document.querySelector('.copy-button'),
                copyTextarea = document.querySelector('.permalink-input');

            copyTextarea.value = window.location.href;
            copyTextareaBtn.dataset.clipboardText = copyTextarea.value;

            copyTextareaBtn.addEventListener('click', function(event) {
                copyTextarea.select();
                try {
                    var successful = document.execCommand('copy');
                    if (successful && copyTextareaBtn.innerHTML !== 'Copied') {
                        self.change_text('.copy-button', false);
                    }
                } catch (err) {
                    console.log('Oops, unable to copy');
                }
            });
        }
    }
}(jQuery));