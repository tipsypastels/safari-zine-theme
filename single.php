<?php get_header() ?>

<?php while(have_posts()) : the_post() ?>
  <?php
    image_banner(
      get_the_post_thumbnail_url()
    );
  ?>
  <main id="single">
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
            'the_content', # get a callback
            'single'
          ];
        ?>
      </section>

      <section id="single-post-body">
        <?php
          postbit_content(
            ...$params
          );
        ?>
      </section>
  </main>
<?php endwhile; ?>

<?php get_footer();?>