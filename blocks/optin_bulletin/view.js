$(function() {
    
    //Subscribes User
    $('a[data-action=block-subscribe-page]').magnificPopup({
        type: 'ajax',
    });

    $('a[data-action=block-subscribe-page]').on('click', function() {
        jQuery.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            type: 'post',
            success: function(response) {
                $('div.ccm-block-subscribe-wrapper').replaceWith(response);
            }
        });
        return false;
    });
    
    //Unsubscribes User
    $('a[data-action=block-unsubscribe-page]').magnificPopup({
        type: 'ajax',
    });

    $('a[data-action=block-unsubscribe-page]').on('click', function() {
        jQuery.ajax({
            url: $(this).attr('href'),
            dataType: 'html',
            type: 'post',
            success: function(response) {
                $('div.ccm-block-unsubscribe-wrapper').replaceWith(response);
            }
        });
        return false;
    });
});