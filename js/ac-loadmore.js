(function($){

$.fn.acLoadmore = function(params) {
    var config = {
        container: '',
        wp_query: {
            page: 1,
            post_type: 'post',
        },
        done: function(){},
        fail: function(){},
        always: function(){},
    };

    config = $.extend(true, config, params);

    if (config.wp_query.post_type=='post') {
        config.wp_query.post_type = 'posts';
    } else if (config.wp_query.post_type=='page') {
        config.wp_query.post_type = 'pages';
    }

    var $button = this;
    var $container = $(config.container);
    var endpoint = wpApiSettings.root + 'wp/v2/' + config.wp_query.post_type;

    $button.click(function(e){
        e.preventDefault();
        
        $container.addClass('loading');
        $button.addClass('loading');

        $.ajax({
            url: endpoint,
            method: 'GET',
            dataType: 'json',
            beforeSend: function(xhr){
                xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
            },
            data: config.wp_query,
        }).done(function(response, textStatus, request) {

            $.each(response, function(index, item) {
                $container.append(item.tmp);
            });

            var totalPages = request.getResponseHeader('X-WP-TotalPages');

            if(config.wp_query.page>=parseInt(totalPages)) {
                $button.hide();
            }

            config.done();

        }).fail(function(response){

            console.log( response.responseJSON.message );

            config.fail();

        }).always(function(){

            $container.removeClass('loading');
            $button.removeClass('loading');
            config.wp_query.page++;

            config.always();

        });

    });

    $button.trigger('click');
}
})(jQuery);
