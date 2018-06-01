<?php 
  get_header();
  $exclude_from_latest = [];
?>

<main id="index">
  <h1 class="image-postbit-title">Featured Articles</h1><div class="rule"></div>
  <section id="posts-featured" class="flex wraps image-postbit-block">

    <?php
      $paged = get_query_var('paged');

      if (!$paged) {
        $feat = new WP_Query([
          'category_name' => 'featured',
          'posts_per_page' => 3
        ]);

        while($feat->have_posts()) { $feat->the_post();
          $exclude_from_latest[] = get_the_ID();
          $author_id = get_the_author_meta('ID');

          image_postbit(
            get_the_permalink(),
            get_the_post_thumbnail_url(),
            get_the_title(),
            get_the_excerpt(),
            get_the_date(),
            get_the_author(),
            get_the_category()
          );
        }

        /* ends the WP_Query */
        wp_reset_postdata();
      }
    ?>
  </section>

  <h1 class="image-postbit-title">Latest Articles</h1><div class="rule"></div>
  <section id="posts-latest" class="flex wraps image-postbit-block">

    <?php
      
      $paginated_query = new WP_Query([
        "posts_per_page" => 9,
        "paged" => $paged
      ]);

      while($paginated_query->have_posts()) { $paginated_query->the_post();
        if (in_array(get_the_ID(), $exclude_from_latest)) {
          continue;
        }
  
        $author_id = get_the_author_meta('ID');

        image_postbit(
          get_the_permalink(),
          get_the_post_thumbnail_url(),
          get_the_title(),
          get_the_excerpt(),
          get_the_date(),
          get_the_author(),
          get_the_category()
        );
      }

      wp_reset_postdata();
    ?>
  </section>

  <section class="pagination">
    <?php
      if (get_previous_posts_link(null, $paginated_query->max_num_pages)) {
        paginate(
          "left", 
          "Newer",
          get_previous_posts_page_link($paginated_query->max_num_pages)
        );
      }

      if (get_next_posts_link(null, $paginated_query->max_num_pages)) {
        paginate(
          "right", 
          "Older",
          get_next_posts_page_link($paginated_query->max_num_pages)
        );
      }
    ?>
  </section>
</main>

<?php get_footer();?>