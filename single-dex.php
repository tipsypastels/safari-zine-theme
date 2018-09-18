<?php get_header() ?>

<?php while(have_posts()) : the_post() ?>
  <main id="dex" class="
    override-highlight 
    <?php echo strtolower(get_field('color')) ?>
  ">
    <section class="back-to-dex-index flex vertically-centered has-invisible-links">
      <a class="index-link" href="<?php echo get_post_type_archive_link('dex') ?>">
        Book of Pocket Monsters
      </a>

      <?php fa('arrow-right') ?>

      <?php menu_sprite(get_field('menu_sprite')) ?>
    </section>

    <section class="dex-entry-content">
      <h1 class="standard-title huge line-height">
        <?php the_title() ?>
        <span class="dexnum">
          #<?php the_field('dexnum') ?>
        </span>
      </h1>

      <span class="edit-link centered has-invisible-links">
        <?php if (is_user_logged_in()) {
          edit_post_link('Edit');
        } ?>
      </span>

      <div class="article-thumbnail-wrapper">
        <?php 
          $meta = [];

          if (have_rows('gallery_images')) {
            $gallery_images = get_field('gallery_images');

            $fimg_data = $gallery_images[array_rand($gallery_images)];
            $fimg = $fimg_data['image'];
            $fimg_artist = [
              $fimg_data['artist_forum_username'],
              get_the_title(),
              $fimg_data['artist_possessive_pronoun']
            ];

            $has_transparent_background = $fimg_data['has_transparent_background'];

            $is_placeholder = false;
          } else {
            $fimg = get_field('placeholder_image');

            $is_placeholder = true;
          }

          if ($is_placeholder || $has_transparent_background) {
            $meta['featimg-bgsize'] = ['auto 80%'];
          }

          featured_image($fimg, $meta);

          altforms_for_pokemon(get_the_ID(), get_field('dexnum'));

          if ($is_placeholder) {
            dex_needs_fimg();
          } else if ($fimg_artist) {
            fimg_artist_bit(...$fimg_artist);
          }
        ?>
      </div>

      <?php format_dex_entry(
        get_field('pokemon_category'),
        get_field('pokedex_entry'),
        get_field('region')
      ); ?>

      <div class="types-and-stats-block flex-on-desktop">
        <div class="types-block">
          <?php format_types(
            get_field('type1'),
            get_field('type2')
          ); ?>
        </div>

        <div class="flex-spacer"></div>

        <div class="stats-block">
          <?php format_stats(get_field('stats')) ?>
        </div>
      </div>

      <div class="evolutions-and-altforms">
        <?php if(get_field('evolves_from') || get_field('evolutions')) {
          format_evolutions(
            get_the_ID(),
            get_field('evolves_from')
          );
        } ?>
      </div>

      <div class="biography article-contents">
        <?php the_field('biography') ?>
      </div>
    </section>

    <section class="battling">
      <h2 class="standard-title line-height">
        Battling With <?php the_title() ?>
      </h2>

      <div class="tiers-and-abilities flex one-growing-element">
        <?php if(have_rows('abilities')): ?>
          <div class="abilities flex">
            <?php foreach(get_field('abilities') as $ability):
              $tag = $ability['is_hidden_ability'] 
                ? "<em>$ability[ability_name]</em>"
                : $ability['ability_name']; ?>

              <div class="stickerlike">
                <?php echo $tag ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <div class="grows"></div>

        <?php $tier = get_field('smogon_tier') ?>
        <a href="<?php echo get_dex_query_link(['tier' => $tier]); ?>" class="stickerlike">
          <span class="formalized">Tier:</span>
          <?php echo $tier; ?>
        </a>
      </div>

      <div class="battling-summary article-contents">
        <?php the_field('battling_summary') ?>


        <p>Want to learn more about how to use <?php the_title() ?>? See the linked articles below for tips and movesets!</p>
      </div>
    </section>

    <section class="articles-featuring">
      <h2 class="standard-title line-height">
        Articles Featuring <?php the_title() ?>
      </h2>

      <?php articles_featuring(get_the_title()); ?>
    </section>

    <?php if(have_rows('gallery_images')): ?>
      <section class="gallery">
        <h2 class="standard-title line-height">
          <?php the_title() ?> Fanart Gallery
        </h2>

        <?php gallery_images(get_field('gallery_images')) ?>
      </section>
    <?php endif; ?>

    <section class="pagination">
      <?php
        $dexnum = get_field('dexnum');
        paginate_pokedex($dexnum, -1);
        paginate_pokedex($dexnum,  1);
      ?>
    </section>
  </main>
<?php endwhile; ?>

<?php get_footer();?>