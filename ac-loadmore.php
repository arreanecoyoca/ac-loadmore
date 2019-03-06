    <?php
/**
 * Plugin Name: AC Loadmore
 * Plugin URI: https://github.com/arreanecoyoca/ac-loadmore
 * Description: a quick way to create Load more ajax funtionality in your wordpress site
 * Version: 1.0
 * Author: Arreane Coyoca
 * Author URI: http://arreane.herokuapp.com
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define('CLASS_AC_LOADMORE', 'AC_Loadmore');


require_once('AC_Loadmore.php');


// hooks
add_filter( 'register_post_type_args', array(CLASS_AC_LOADMORE, 'add_rest_to_post_types'), 20, 2 );
add_action('wp_enqueue_scripts', array(CLASS_AC_LOADMORE, 'enqueue_scripts'));
add_action('rest_api_init', array(CLASS_AC_LOADMORE, 'init'));
