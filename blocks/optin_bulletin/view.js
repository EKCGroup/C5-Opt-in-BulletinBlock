$(function() {
    $('a[data-action=block-subscribe-page]', 'a[data-action=block-unsubscribe-page]').magnificPopup({
        type: 'ajax',
    });

    $('a[data-action=block-subscribe-page]', 'a[data-action=block-unsubscribe-page]').on('click', function() {
        jQuery.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            type: 'post',
            success: function(response) {
                $('div.ccm-block-subscribe-wrapper', 'div.ccm-block-unsubscribe-wrapper').replaceWith(response);
            }
        });
        return false;
    });
});