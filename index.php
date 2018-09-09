<?php 
  get_header();
  $exclude_from_latest = [];
  $paged = get_query_var('paged');


//  echo phpinfo();
?>

<main id="index">
  <?php
    $feat = new WP_Query([
      'category_name' => 'featured',
      'posts_per_page' => 3
    ]);
  ?>
  <?php if($feat->have_posts() && !$paged): ?>
    <h1 class="standard-title">Featured Articles</h1>
    <section id="posts-featured" class="flex wraps image-postbit-block slight-small-computer-margin">

      <?php
        while($feat->have_posts()) { $feat->the_post();
          $exclude_from_latest[] = get_the_ID();
          $author_id = get_the_author_meta('ID');

          image_postbit(
            get_the_permalink(),
            get_the_post_thumbnail_url(),
            get_the_title(),
            get_the_excerpt()
          );
        }

        /* ends the WP_Query */
        wp_reset_postdata();
      ?>
    </section>
  <?php endif; ?>

  <h1 class="standard-title">
    <?php if ($paged) {
      echo "Latest Page $paged";
    } else {
      echo "Latest Articles";
    } ?>
  </h1>
  <section id="posts-latest" class="flex wraps image-postbit-block slight-small-computer-margin">

    <?php
      
      $paginated_query = new WP_Query([
        "posts_per_page" => get_option('posts_per_page'),
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
          get_the_excerpt()
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
          "Newer Posts",
          get_previous_posts_page_link($paginated_query->max_num_pages)
        );
      }

      if (get_next_posts_link(null, $paginated_query->max_num_pages)) {
        paginate(
          "right", 
          "Older Posts",
          get_next_posts_page_link($paginated_query->max_num_pages)
        );
      }
    ?>
  </section>
</main>

<?php get_footer();?>
