  <div class="dnp-columns--<?php echo $atts['columns']; ?> dnp-post__container">
    <div style="width: 300px; height: 150px; overflow: hidden; display: flex; " class="dnp-post-image__container">
      <img style="align-self: center" class="dnp-post__image" src="<?php the_post_thumbnail(); ?>">
    </div>
    <h3 class="dnp-post__title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>
    <p class="dnp-post__excerpt">
      <?php the_excerpt(); ?>
      <a href="<?php the_permalink(); ?>">Read More &raquo;</a>
    </p>
  </div>
