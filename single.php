<?php get_header() ?>

<?php while(have_posts()) : the_post() ?>
  <main id="single">
    <section id="single-post-body">
      <?php
        $author_id = get_the_author_meta('ID');
        
        postbit_content(
          get_the_permalink(),
          get_the_post_thumbnail_url(),
          get_the_title(),
          get_the_excerpt(),
          get_the_date(),
          get_the_author(),
          $author_id,
          get_the_category(),
          'the_content', # get a callback
          'edit_post_link', # callback to generate an edit link
          'single',
          get_post_custom()
        );

        $pagination_classes = "
          page-links has-invisible-links
          centered-block max-content
          float-on-computer float-right
        ";

        wp_link_pages([
          'before'      => "<div class='$pagination_classes'>Pages",
          'after'       => '</div>',
          'link_before' => '<span class="page-number">',
          'link_after'  => '</span>',
        ]);
      ?>
    </section>

    <section id="single-post-comments">
      <?php
        if (comments_open() || get_comments_number()) {
          comments_template();
        }
      ?>
    </section>
  </main>
<?php endwhile; ?>

<?php get_footer();?>