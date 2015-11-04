/*global
    window
*/

(function () {
    Drupal.behaviors.bc_theme_permalink = {
        change_text: function (input_class, reset) {
            var self = this,
                element = document.querySelector(input_class),
                newText = (element.innerHTML === 'Copy' && !reset)
                    ? 'Copied'
                    : 'Copy';
            element.innerHTML = newText;
            if (element.timer) {
                window.clearTimeout(element.timer);
            }
            if (newText !== 'Copy') {
                element.timer = window.setTimeout(function () {
                    self.change_text(input_class, true);
                }, 3000);
            }
        },
        attach: function (context, settings) {
            var self = this,
                copyTextareaBtn = document.querySelector('.copy-button'),
                copyTextarea = document.querySelector('.permalink-input'),
                permalink_path = settings.permalink_path !== undefined
                    ? settings.permalink_path
                    : '',
                permalink_url;

            if (permalink_path.length !== 0) {
                permalink_url = 'http://' + window.location.hostname + '/' + permalink_path + window.location.hash;
            } else {
                permalink_url = window.location.href;
            }

            copyTextarea.value = permalink_url;
            copyTextareaBtn.dataset.clipboardText = copyTextarea.value;

            copyTextareaBtn.addEventListener('click', function () {
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
    };
}());