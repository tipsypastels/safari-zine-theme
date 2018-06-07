<?php get_header() ?>

<main id="page">
  <?php while(have_posts()) : the_post() ?>
    <section id="single-post-header" class="flex wraps image-postbit-block no-bottom-curve">
      <?php
        $params = [
          get_the_permalink(),
          get_the_post_thumbnail_url(),
          get_the_title(),
          get_the_excerpt(),
          get_the_date(),
          get_the_author(),
          get_the_category(),
          get_the_content(),
          'single'
        ];

        image_only_postbit(
          get_the_post_thumbnail_url()
        );
      ?>
    </section>

    <section id="single-post-body">
      <?php
        postbit_content(
          ...$params
        );
      ?>
    </section>
  <?php endwhile; ?>
</main>

<?php get_footer();?>