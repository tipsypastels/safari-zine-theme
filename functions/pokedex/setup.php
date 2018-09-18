<?php 

function pokedex_title_text($title) {
  $screen = get_current_screen();

  if ($screen->post_type === 'dex') {
    $title = 'Full Pokémon name, including "Alolan" or "Mega"';
  }

  return $title;
}

add_filter('enter_title_here', 'pokedex_title_text');

function define_pokedex() {
  register_post_type('dex', [
    'labels' => [
      'name' => 'Pokédex Entries', 
      'singlular_name' => 'Pokédex Entry',
      'add_new_item' => 'Add Pokédex Entry'
    ],

    'public' => true,
    'has_archive' => true,
    'supports' => ['title'],
    'rewrite' => ['slug' => 'dex']
  ]);
}

add_action('init', 'define_pokedex');

function sort_pokemon($query) {
  $type = $query->query['post_type'];

  if ($type === 'dex' && (is_archive() || is_admin())) {
    $query->set('meta_query', [
      'relation' => 'AND',
      
      'dexnum' => [
        'key' => 'dexnum', 
        'type' => 'NUMERIC'
      ],

      'is_special_form' => [
        'key' => 'is_special_form',
        'type' => 'NUMERIC'
      ]
    ]);

    $query->set('orderby', [
      'dexnum' => 'ASC',
      'is_special_form' => 'ASC'
    ]);

    $query->set('posts_per_page', 1000);
  }
}

add_action('pre_get_posts', 'sort_pokemon');

function dex_article_author_names($name) {
  if (get_post_type() === 'dex') {
    return 'Book of Pocket Monsters';
  }

  return $name;
}

add_action('the_author', 'dex_article_author_names');

function get_dex_featured_image($post_id) {
  $gallery = get_field('gallery_images', $post_id);
  if ($gallery) {
    $img = $gallery[0]['image'];    
  } else {
    $img = get_field('placeholder_image', $post_id);
  }

  return $img;
}

?>