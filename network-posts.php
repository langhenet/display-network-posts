<?php
/*
Plugin Name: Display Network Posts
Plugin URI: http://langhe.net/
Description: This lightweight plugin uses a shortcode to displays posts from any site of a Multisite Network, as a list or as a grid
Version: 1.0
Author: Enrico Cassinelli
Author URI: http://glocalweb.it
License: GPLv2
*/

// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts
add_shortcode( 'network-posts', 'glwb_list_network_posts' );
function glwb_list_network_posts( $atts ) {
  ob_start();

  // define attributes and their defaults
  $atts = shortcode_atts( array (
      'blogs'   => '1',
      'type'    => 'post',
      'order'   => 'desc',
      'orderby' => 'title',
      'posts'   => 6,
      'layout'  => 'list',
      'columns'  => 3
  //    'tax' => '',
  //    'tax-term' => '',
  ), $atts );

  // define query parameters based on attributes
  $options = array(
      'post_type' => $atts['type'],
      'order' => $atts['order'],
      'orderby' => $atts['orderby'],
      'posts_per_page' => $atts['posts'],
      //'update_post_meta_cache' => false,
      //'update_post_term_cache' => false,
      //'cache_results' => false
      'no_found_rows' => true
  );

  //New Query to the correct blog
  //switch_to_blog( $atts['blogs']);
  $network_query = new WP_Query( $options );

  // Loop
  if ( $network_query->have_posts() ) :
?>
      <div class="dnp-grid__container" style="display: flex; flex-direction: row; flex-wrap: wrap;">
<?php
        while ( $network_query->have_posts() ) {
          $network_query->the_post();
          include( '/templates/loop-grid.php' );
        }
?>
      </div>
<?php

    wp_reset_postdata();

  else :
?>
    <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php
  endif;
  //restore_current_blog();
  $output = ob_get_clean();
  return $output;
}
