<?php get_header() ?>

<main id="dex-index">
  <section class="welcome-area flex one-growing-element vertically-centered">
    <?php site_name([
      'logo' => 'logo_black.svg',
      'only_logo' => true,
      'href' => '#',
      'class' => 'welcome-carnivine'
    ]); ?>

    <div class="welcome-bubble">
      Welcome to <strong>Pokémon Geographic</strong>! This is a placeholder because i just code i don't write blah blah blah. Got fanart of a Pokémon you want to contribute? Click <a href="#">here</a>!
    </div>
  </section>
  <section class="searchable-area">
    <input type="text" class="search-bar" placeholder="Search Pokémon Geographic">

    <div class="search-results">
      <?php while(have_posts()): the_post() ?>
        <a 
          class="search-item" 
          href="<?php the_permalink() ?>" 
          data-searchable="
            <?php echo strtolower(get_the_title()) ?> <?php echo strtolower(get_field('type1')) ?> <?php echo strtolower(get_field('type2')) ?>
          "
        >
        <!-- we can't use newlines in ^ because they affect the search :/
             stripping out them client side would affect the speed -->

          <div class="icon-block">
            <img src="<?php the_field('menu_sprite') ?>">
          </div>

          <div class="title-block">
            <?php the_title() ?>
          </div>

          <div class="types-block">
            <?php
              format_types(
                get_field('type1'),
                get_field('type2')
              );
            ?>
          </div>
        </a>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer() ?>