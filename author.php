<?php get_header(); ?>

<?php 
  $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
  $avatar  = get_wp_user_avatar_src($curauth->ID);
?>

<main id="page" class="page-width author flex one-growing-element wraps-on-mobile">
  <section class="author-info flex one-growing-element wraps wraps-on-computer">
    <div class="avatar">
      <img class="avatar huge" src="<?php echo $avatar ?>">
    </div>

    <div class="author-meta grows">
      <h1 class="lesser title"><?php echo $curauth->display_name ?></h1>
      <?php if ($curauth->first_name): ?>
        <h2 class="subtitle"><?php echo $curauth->first_name ?></h2>
      <?php endif; ?>

      <p class="biography">
        <?php echo $curauth->description ?>
      </p>
    </div>
  </section>

  <section class="author-posts grows">
    <h2 class="subtitle">
      Articles by <?php echo $curauth->display_name ?>
    </h2>

    <div class="small-divider with-margin"></div>

    <?php while(have_posts()): the_post(); ?>
      <?php postbit(
        get_the_permalink(), 
        get_the_title(),
        get_the_excerpt(),
        null, // passing author info is redundant on author pages
        get_the_date(),
        get_the_post_thumbnail_url()
      ); ?>
    <?php endwhile; ?>
  </section>
</main>

<?php get_footer();?>