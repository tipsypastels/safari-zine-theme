<?php

function format_types($type1, $type2, $none = 'No Secondary') {
  echo "<div class='types-block'>";
  if($type2 === $none) {
    echo format_single_type($type1);
  } else {
    echo format_single_type($type1) . format_single_type($type2);
  }
  echo "</div>";
}

function format_single_type($type) {
  $slug = strtolower($type);
  $link = get_dex_query_link(['type' => $type]);
  return "<a href='$link' class='pokemon-type type-$slug'>$type</a>";
}

function format_stats($stats) {
  if (!$stats) return;

  $keys = [];
  $values = [];

  $i = 0;

  foreach(explode(' ', $stats) as $item) {
    if ($i % 2 == 0) {
      $values[] = $item;
    } else {
      $keys[] = $item;
    }
    
    $i++;
  }

  $parsed_stats = array_combine($keys, $values);

  $bst = array_sum($values);
  $parsed_stats['BST'] = $bst;

  foreach($parsed_stats as $stat => $amount): ?>
    <div class="stat stat-<?php echo strtolower($stat) ?>">
      <?php echo($amount . ' ' . strtoupper($stat)) ?>
    </div>
  <?php endforeach;
}

function menu_sprite($img, $title = "", $url = null) {
  if ($url): ?>
    <a class="has-invisible-links" href="<?php echo $url ?>">
  <?php endif; ?>

  <img 
    alt="<?php echo $title ?> Menu Sprite"
    title="<?php echo $title?>"
    class="menu-sprite"
    src="<?php echo $img ?>"
  >

  <?php if ($url): ?>
    </a>
  <?php endif;
}

function format_dex_entry($category, $text, $region) { ?>
  <div class="dex-entry-wrapper">
    <div class="flex">
      <div class="dex-entry-pokemon-category">
        <?php echo $category ?> Pokémon
      </div>

      <div class="flex-spacer"></div>

      <div class="dex-entry-region has-invisible-links">
        <a href="<?php echo get_dex_query_link(['region' => $region]); ?>">
          <?php echo $region ?> Pokédex
        </a>
      </div>
    </div>
    
    <div class="dex-entry-content">
      <?php echo $text ?>
    </div>

  </div>
<?php }

function dex_needs_fimg($class = "") { ?>
  <a target="_blank" class="
    needs-article-thumbnail 
    has-invisible-links 
    <?php echo $class ?>
  " href="#">
    This article needs a custom featured image! Are you an artist or designer? Learn how to contribute one here.
  </a>
<?php }

function fimg_artist_bit($username, $title, $pronoun) {
  $user_href = "https://www.safarizone.net/u/$username";
  $description = "This $title artwork was created by Safari Zone member <strong>$username</strong>! Click to visit $pronoun profile on the forums.";
  ?>
    <a target="_blank" class="fimg-author" href="<?php echo $user_href ?>">
      <?php echo $description ?>
    </a>
  <?php
}

function altforms_block($query) { ?>
  <div class="altforms-block fancy-block"> 
    <div class="title">
      Other Forms
    </div>

    <?php
      while($query->have_posts()) { 
        $query->the_post();
        altform(
          get_the_permalink(),
          get_the_title(),
          get_field('featured_image'),
          get_field('type1'),
          get_field('type2')
        );
      }
    ?>
  </div>
  <?php wp_reset_postdata();
}

function altform($url, $title, $image, $type1, $type2) { ?>
  <a class="altform has-invisible-links" href="<?php echo $url ?>">
    <?php if ($image): ?>
      <div class="altform-image" style="background-image: url(<?php echo $image ?>)">
      </div>
    <?php endif; ?>
    <div class="altform-title">
      <?php echo $title ?>
    </div>
    <?php format_types($type1, $type2) ?>
  </a>
<?php }

?>