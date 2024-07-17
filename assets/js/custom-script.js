
jQuery(document).ready(function($) {
    $('#archive-sort').on('change', function() {
        var sortValue = $(this).val();
        
        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'sort_posts',
                orderby: sortValue
            },
            success: function(response) {
                $('#post-container').html(response);
            }
        });
    });
});

