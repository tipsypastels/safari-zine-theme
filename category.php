<?php 
  get_header();
?>

<main id="index">
  <section id="posts-latest" class="flex wraps responsive-two-columns">
    <?php
      
      $paged = get_query_var('paged');
      $paginated_query = new WP_Query([
        "category_name" => get_category(get_query_var('cat'))->slug,
        "posts_per_page" => 6,
        "paged" => $paged
      ]);

      while($paginated_query->have_posts()) { $paginated_query->the_post();
  
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