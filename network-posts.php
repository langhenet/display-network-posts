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
add_shortcode( 'network-posts', 'glwb_list_posts' );
function glwb_list_posts( $atts ) {
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
      'offset'           => 0,
      'posts_per_page' => $atts['posts'],
      //'update_post_meta_cache' => false,
      'update_post_term_cache' => false,
      //'no_found_rows' => true,
      //'cache_results' => false

  );

  //New Query to the correct blog
  //switch_to_blog( $atts['blogs']);
  global $post;
  $posts = get_posts( $options );

  ?>
        <div class="dnp-grid__container" style="display: flex; flex-direction: row; flex-wrap: wrap;">
  <?php
  // Loop

  //6 righe di debug - provare a salvare gli ID in un array per poi -> http://wordpress.stackexchange.com/questions/174308/retrieve-featured-image-thumbnail-url-from-multiple-posts-with-one-query
  echo '<pre>'; var_dump($posts); echo '</pre>';
  $post_ids = array();
    foreach($posts as $ciccio) :
      $post_ids[] = $ciccio->ID;
    endforeach;
  echo '<pre>'; var_dump($post_ids); echo '</pre>';

  foreach ($posts as $post) :

    //setup_postdata( $post );
  //  echo '<pre>'; var_dump($post); echo '</pre>';
    echo $post->ID; echo ' - ';

  //  include( '/templates/loop-grid.php' );
    endforeach;
    wp_reset_postdata();
?>
      </div>
<?php


  //restore_current_blog();
  $output = ob_get_clean();
  return $output;
}
