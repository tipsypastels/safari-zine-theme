<?php get_header() ?>

<?php while(have_posts()) : the_post() ?>
  <main id="dex" class="
    override-highlight 
    <?php echo strtolower(get_field('color')) ?>
  ">
    <section id="single-post-body">
      <h1 class="standard-title huge">
        <?php the_title() ?>
        <span class="dexnum">
          #<?php the_field('dexnum') ?>
        </span>
      </h1>

      <div class="article-thumbnail-wrapper">
        <?php 
          $fimg = get_field('featured_image');
          $fimg_mode = get_field('featimg_mode');

          /*
            the official artworks also have transparent backgrounds
            so we put them in an implicit sprite mode
          */

          if ($fimg) {
            $meta = [];

            if ($fimg_mode === 'sprite' || $fimg_mode === 'placeholder') {
              $meta['featimg-bgsize'] = ['auto 80%'];
            }

            featured_image($fimg, $meta);

            if ($fimg_mode === 'placeholder') {
              dex_needs_fimg();
            }
          } else {
            dex_needs_fimg('large');
          }
        ?>

        <?php
          $fimg_author = get_field('featimg_author');

          if ($fimg_mode !== 'placeholder' && $fimg_author) {
            fimg_artist_bit(
              $fimg_author, 
              get_the_title(),
              get_field('featimg_author_pronoun')
            );
          }
        ?>
      </div>

      <?php
        $dexnum = get_field('dexnum');
        altforms_for_pokemon(get_the_ID(), $dexnum);
      ?>

      <?php format_dex_entry(
        get_field('pokemon_category'),
        get_field('pokedex_entry'),
        get_field('pokedex_entry_region')
      ); ?>

      <div class="types-and-stats-block">
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

      <div class="biography">
        <?php the_field('biography') ?>
      </div>
    </section>

    <section class="articles-featuring">
      <h2 class="standard-title">
        Articles Featuring <?php the_title() ?>
      </h2>

      <?php articles_featuring(get_the_title()); ?>
    </section>

    <section class="pagination">
      <?php
        
        paginate_pokedex($dexnum, -1);
        paginate_pokedex($dexnum,  1);
      ?>
    </section>
  </main>
<?php endwhile; ?>

<?php get_footer();?>