(function($) {
    'use strict';

    var floatingLabel;

    floatingLabel = function(onload) {
        var $input;
        $input = $(this);
        if (onload) {
            $.each($('.bt-flabels__wrapper input'), function(index, value) {
                var $current_input;
                $current_input = $(value);
                if ($current_input.val()) {
                    $current_input.closest('.bt-flabels__wrapper').addClass('bt-flabel__float');
                }
            });
        }

        setTimeout((function() {
            if ($input.val()) {
                $input.closest('.bt-flabels__wrapper').addClass('bt-flabel__float');
            } else {
                $input.closest('.bt-flabels__wrapper').removeClass('bt-flabel__float');
            }
        }), 1);
    };

    $('.bt-flabels__wrapper input').keydown(floatingLabel);
    $('.bt-flabels__wrapper input').change(floatingLabel);

    window.addEventListener('load', floatingLabel(true), false);
    $('.js-flabels').parsley().on('form:error', function() {
        $.each(this.fields, function(key, field) {
            if (field.validationResult !== true) {
                field.$element.closest('.bt-flabels__wrapper').addClass('bt-flabels__error');
            }
        });
    });

    $('.js-flabels').parsley().on('field:validated', function() {
        if (this.validationResult === true) {
            this.$element.closest('.bt-flabels__wrapper').removeClass('bt-flabels__error');
        } else {
            this.$element.closest('.bt-flabels__wrapper').addClass('bt-flabels__error');
        }
    });

})(jQuery);
