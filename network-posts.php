<?php
/*
Plugin Name: Display Network Posts
Plugin URI: http://langhe.net/
Description: This lightweight plugin uses a shortcode to displays posts from any site of a Multisite Network, as a list or as a grid
Version: 1.0
Author: Enrico Cassinelli
Author URI: http://rachelmccollin.co.uk
License: GPLv2
*/

// create shortcode to list all clothes which come in blue
// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts
add_shortcode( 'network-posts', 'glwb_list_network_posts' );
function glwb_list_network_posts( $atts ) {
    ob_start();

    // define attributes and their defaults
    extract( shortcode_atts( array (
        'type' => 'post',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => -1,
        'color' => '',
        'fabric' => '',
        'category' => '',
    ), $atts ) );

    // define query parameters based on attributes
    $options = array(
        'post_type' => $type,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
        'color' => $color,
        'fabric' => $fabric,
        'category_name' => $category,
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { ?>
        <ul class="clothes-listing ">
            <ul class="clothes-listing ">
                <li id="post-<?php the_ID(); ?>">></li>
            </ul>
        </ul>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
    }
}
