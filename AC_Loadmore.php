<?php

class AC_Loadmore {

    public static function enqueue_scripts()
    {
        wp_enqueue_script( 'ac-loadmore', plugin_dir_url( __FILE__ ) . 'js/ac-loadmore.js', [ 'jquery', 'wp-api' ], '1.0' );
    }

    public static function get_registered_post_types()
    {
        $args = array('public' => true, '_builtin' => false);
        
        $post_types = get_post_types($args, 'objects');
        
        // include posts and pages as default
        $registered_post_types = array('post', 'page');
        
        foreach($post_types as $type) {
            $registered_post_types[] = $type->name;
        }

        return $registered_post_types;
    }

    public static function add_rest_to_post_types($args, $post_type)
    {
        if( (!isset($args['show_in_rest'])) || $args['show_in_rest'] !== true ) {
            $args["show_in_rest"] = true;
        }

        return $args;
    }

    public static function init()
    {
        $post_types = static::get_registered_post_types();
        foreach($post_types as $type)
        {
            register_rest_field( $type, 'tmp', array(
                'schema' => null,
                'get_callback' => function($object) use ($type) {
                    ob_start();
                        if(!is_array($object)) return false;

                        $post = get_post($object['id']);
                        setup_postdata($post);
                        
                        if($template = locate_template('ac-loadmore-'. $type .'.php')) {
                            include($template);
                        } else {
                            echo 'Error: Template not found (Please create a file "ac-loadmore-'.$type.'.php in your theme")';
                        }

                        $content = ob_get_contents();

                    ob_end_clean();

                    return $content;
                })
            );
        }
    }

}
