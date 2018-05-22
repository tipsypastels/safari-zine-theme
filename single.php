<?php get_header() ?>

<main id="single">
    <section id="article">
      <?php
        while(have_posts()) { the_post();
          $author_id = get_the_author_meta('ID');

          postbit(
            get_the_permalink(),
            get_the_post_thumbnail_url(),
            get_the_title(),
            get_the_excerpt(),
            get_the_date(),
            get_the_author(),
            get_author_posts_url($author_id),
            get_wp_user_avatar_src($author_id),
            get_the_category(),
            get_the_content(),
            'single-post',
            function($img) { ?>
              <div class="thumbnail expanded" style="background-image: url(<?php echo $img ?>)">
                <div class="thumbnail-image-wrapper">
                  <img class="thumbnail-image" src="<?php echo $img ?>">
                </div>
              </div>
            <?php } 
          );
        }
      ?>
    </section>
</main>