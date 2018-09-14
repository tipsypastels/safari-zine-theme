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
    <input type="text" class="search-bar" placeholder="Search Pokémon Geographic" value="<?php echo search_bar_default_value() ?>">

    <div class="search-results">
      <?php while(have_posts()): the_post();
        $search_data = generate_search_data_fields(
          get_the_title(),
          get_field('type1'),
          get_field('type2'),
          get_field('regions')
        );

        ?> <div
          class="search-item" 
          data-searchable="<?php echo $search_data ?>"
        >
          <div class="icon-block">
            <?php menu_sprite(
              get_field('menu_sprite'),
              get_the_title(),
              get_the_permalink()
            ); ?>
          </div>

          <a class="title-block" href="<?php the_permalink() ?>">
            <?php the_title() ?>
          </a>

          <div class="types-block">
            <?php
              format_types(
                get_field('type1'),
                get_field('type2')
              );
            ?>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer() ?>