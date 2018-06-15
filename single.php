<?php get_header() ?>

<?php while(have_posts()) : the_post() ?>
  <main id="single">
    <section id="single-post-body">
      <?php
        postbit_content(
          get_the_permalink(),
          get_the_post_thumbnail_url(),
          get_the_title(),
          get_the_excerpt(),
          get_the_date(),
          get_the_author(),
          get_author_posts_url(get_the_author_meta('ID')),
          get_the_category(),
          'the_content', # get a callback
          'single'
        );
      ?>
    </section>
  </main>
<?php endwhile; ?>

<?php get_footer();?>