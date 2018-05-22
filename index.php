<?php 
  get_header();
  $exclude_from_latest = [];
?>

<main id="index">
  <section id="posts-featured">
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

        /* ends the WP_Query */
        wp_reset_postdata();
      }
    ?>
  </section>

  <section id="posts-latest" class="flex wraps responsive-two-columns">
    <?php
      
      $paginated_query = new WP_Query([
        "posts_per_page" => 6,
        "paged" => $paged
      ]);

      while($paginated_query->have_posts()) { $paginated_query->the_post();
        if (in_array(get_the_ID(), $exclude_from_latest)) {
          continue;
        }
  
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

      // echo get_previous_posts_page_link($paginated_query->max_num_pages) . 'asdf';
      // $pagination = [
      //   "prev" => get_previous_posts_link('«', $paginated_query->max_num_pages),
      //   "next" => get_next_posts_link('»', $paginated_query->max_num_pages)
      // ];

      // if ($pagination['prev']) {
      //   echo $pagination['prev'];
      // } else { 
      //   no_pagination('first', "«"); 
      // }

      // if ($pagination['next']) {
      //   echo $pagination['next'];
      // } else {
      //   no_pagination('last', "»"); 
      // }
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