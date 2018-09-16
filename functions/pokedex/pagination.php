<?php

function paginate_pokedex($id, $id_change) {
  $find_id = $id + $id_change;

  $entry = new WP_Query([
    'post_type' => 'dex',
    'meta_query' => [
      'relation' => 'AND',
      [
        'key' => 'dexnum', 
        'value' => $find_id, 
        'compare' => '='
      ],

      [
        'key' => 'is_special_form',
        'value' => '1', 
        'compare' => '!='
      ]
    ]
  ]);

  $dir = $id_change > 0 ? 'right' : 'left';

  while($entry->have_posts()) { $entry->the_post();
    paginate($dir, get_the_title(), get_permalink());
  }
}

function altforms_for_pokemon($article_id, $dexnum) {
  $query = new WP_Query([
    'post_type' => 'dex',
    'post__not_in' => [$article_id],
    'meta_key' => 'is_special_form',
    'orderby' => 'meta_value',
    'order' => 'asc',
    'meta_query' => [
      'relation' => 'AND',
      [
        'key' => 'dexnum',
        'value' => $dexnum
      ]
    ]
  ]);

  if ($query->have_posts()) {
    altforms_block($dexnum, $query);
  }
}

function articles_featuring($pokemon) {
  $query = new WP_Query([
    'post_type' => 'post',
    'meta_query' => [
      'relation' => 'AND',
      [
        'key' => 'post_featured_pokemon',
        'value' => $pokemon,
        'compare' => 'INCLUDE'
      ]
    ]
  ]);

  if (!$query->have_posts()): ?>
    <a href="#" class="needs-articles has-invisible-links">
      There are no articles featuring <?php echo $pokemon ?>. Got a topic you want to write about? Click here!
    </a>

    <?php return;
  endif;

  ?><div class="flex wraps image-postbit-block"><?php
    while ($query->have_posts()) { 
      $query->the_post();

      image_postbit(
        get_the_permalink(),
        get_the_post_thumbnail_url(),
        get_the_title(),
        get_the_excerpt()
      );
    }
  ?></div>

  <?php wp_reset_postdata();
}

?>