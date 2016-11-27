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
        'blogs' => '1',
        'type' => 'post',
        'order' => 'date',
        'orderby' => 'title',
        'posts' => 6,
    //    'tax' => '',
    //    'tax-term' => '',
    ), $atts ) );

    // define query parameters based on attributes
    $options = array(
        'post_type' => $type,
      //  'order' => $order,
      //  'orderby' => $orderby,
        'posts_per_page' => $posts,
      //  'color' => $color,
      //  'fabric' => $fabric,
    );

    //dichiaro la query
    $network_query = new WP_Query( $options );

    // Loop
    if ( $network_query->have_posts() ) {
      echo "there are posts";
      while ( $network_query->have_posts() ) {
        $network_query->the_post();
        get_template_part( '/templates/loop' , ' prova ' );

        wp_reset_postdata();
      }
    }

    else { ?>
      <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

    <?php }

    $myvariable = ob_get_clean();
    return $myvariable;
  }
