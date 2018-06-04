<?php get_header(); ?>

<?php 
  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
  $avatar  = get_wp_user_avatar_src($curauth->ID);
?>

<main id="author">
  <section class="author-info flex one-growing-element">
    <div class="avatar-block">
      <img class="avatar huge" src="<?php echo $avatar ?>">
    </div>

    <div class="meta grows">
      <h1><?php echo $curauth->display_name ?></h1>

      <?php
        user_roles($curauth->roles);
      ?>

      <p>
        <?php echo $curauth->description ?>
      </p>
    </div>
  </section>

  <h1 class="image-postbit-title">Articles by <?php echo $curauth->display_name ?></h1><div class="rule"></div>
  <section id="posts-author" class="flex wraps image-postbit-block">

    <?php
      
      $paginated_query = new WP_Query([
        'author' => $curauth->ID,
        "posts_per_page" => 9,
        "paged" => $paged
      ]);

      while($paginated_query->have_posts()) { $paginated_query->the_post();
        $author_id = get_the_author_meta('ID');

        image_postbit(
          get_the_permalink(),
          get_the_post_thumbnail_url(),
          get_the_title(),
          get_the_excerpt(),
          get_the_date(),
          get_the_author(),
          get_the_category(),
          get_the_content()
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

<?php get_footer();?>