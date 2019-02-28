(function($){

$.fn.acLoadmore = function(params) {
    var config = {
        container: '',
        noShow: '<div class="alert alert-warning">all data have been displayed</div>',
        wp_query: {
            page: 1,
            post_type: 'post',
        },
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
        
        $button.addClass('loading');

        $.ajax({
            url: endpoint,
            method: 'GET',
            beforeSend: function(xhr){
                xhr.setRequestHeader( 'X-WP-Nonce', wpApiSettings.nonce );
            },
            data: config.wp_query,
        }).done(function(response){

            $.each(response, function(index, item){
                if(typeof(item.tmp)=='undefined') {
                    var msg = "Error: Ajax Enpoint not registered";
                    msg += "\n\nadd this code in your functions.php";
                    msg += "\nacLoadmore('"+item.type+"')";
                    alert(msg);
                    
                    return;
                }
                $container.append(item.tmp);
            });

        }).fail(function(response){

            console.log( response.responseJSON.message );
            $container.append(config.noShow);
            $button.hide();

        }).always(function(){

            $button.removeClass('loading');
            config.wp_query.page++;

        });

    });

    $button.trigger('click');
}
})(jQuery);
