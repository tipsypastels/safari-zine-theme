<?php 
  get_header();
  $category = get_category(get_query_var('cat'));
?>

<main id="index">
  <h1 class="standard-title"><?php echo $category->name ?></h1>

    <?php
      $CATEGORIES_WITH_LIST_MODE = [
        'guides'
      ];

      $slug = get_category(get_query_var('cat'))->slug; 

      if (in_array($slug, $CATEGORIES_WITH_LIST_MODE)) {
        $mode = "list";
      } else {
        $mode = "image";
      }

      $paginated_query = new WP_Query([
        "category_name" => $slug,
        "posts_per_page" => 9,
        "paged" => $paged
      ]);

      ?>
        <section id="posts-latest" class="flex wraps <?php echo $mode ?>-postbit-block">
      <?php

      while($paginated_query->have_posts()) { $paginated_query->the_post();
  
        $author_id = get_the_author_meta('ID');

        $args = [
          get_the_permalink(),
          get_the_post_thumbnail_url(),
          get_the_title(),
          get_the_excerpt()
        ];

        if (in_array($slug, $CATEGORIES_WITH_LIST_MODE)) {
          list_postbit(...$args);
        } else {
          image_postbit(...$args);
        }
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