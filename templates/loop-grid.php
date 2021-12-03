  <div class="dnp-columns--<?php echo $atts['columns']; ?> dnp-post__container">
    <div style="width: 300px; height: 150px; overflow: hidden; display: flex; " class="dnp-post-image__container">
      <?php the_post_thumbnail( $size = 'medium'); ?>
    </div>
    <h3 class="dnp-post__title">
      <a href="<?php echo get_permalink( $post->ID); ?>"><?php echo apply_filters( 'the_title', $post->post_title ); ?></a>
    </h3>
    <p class="dnp-post__excerpt">
      <?php  ?>
      <a href="<?php echo get_permalink( $post->ID); ?>">Read More &raquo;</a>
    </p>
  </div>
<?php
//echo get_the_post_thumbnail( $post->ID, $size = 'medium' )
//echo get_the_post_thumbnail( $post->ID, $size = 'medium' )
// the_post_thumbnail( $post->ID , $size = 'medium');
//echo apply_filters( 'the_post_thumbnail', $post->post_title );
 ?>
