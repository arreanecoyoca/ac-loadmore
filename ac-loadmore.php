<?php
/**
 * Plugin Name: AC Loadmore
 * Plugin URI: 
 * Description: a quick way to create Load more ajax funtionality in your wordpress site
 * Version: 1.0
 * Author: Arreane Coyoca
 * Author URI: http://arreane.herokuapp.com
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function ac_enqueue_scripts() {
    wp_enqueue_script( 'ac-loadmore', plugin_dir_url( __FILE__ ) . 'js/ac-loadmore.js', [ 'jquery', 'wp-api' ], '1.0', true );
}
add_action('wp_enqueue_scripts', 'ac_enqueue_scripts');

function acLoadmore($postTypes = array()) {

    if(!is_array($postTypes)) {
        $postTypes = (Array) $postTypes;
    }


    foreach($postTypes as $postType)
    {
        add_action( 'rest_api_init', function() use ($postType){
 
            register_rest_field( $postType, 'tmp', array(
                'schema' => null,
                'get_callback'    => function($object) use ($postType) {
                    
                    ob_start();
                        
                        if(!is_array($object)) return false;

                        $post = get_post($object['id']);
                        setup_postdata($post);
                        
                        if($template = locate_template('ac-loadmore-'. $postType .'.php')) {
                            include($template);
                        } else {
                            echo 'Error: Template not found (Please create a file "ac-loadmore-'.$postType.'.php in your theme")';
                        }

                        $content = ob_get_contents();

                    ob_end_clean();

                    return $content;
                })
            );

        });
    }
}