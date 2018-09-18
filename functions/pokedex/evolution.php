<?php

function format_single_evolution_chain($array) {
  // make the box colour the colour of the first pokemon in the family
  $color = strtolower(get_field('color', $array[0]['article_id'])); ?>

  <div class="evolution-family-chain flex override-highlight <?php echo $color ?>"><?php
    foreach($array as $pokemon) {
      format_single_evolution($pokemon);
    }
  ?></div>
<?php }

function format_single_evolution($pokemon) {
  $article_id = $pokemon['article_id'];
  $sprite = get_field('menu_sprite', $article_id);
  $title = get_the_title($article_id);
  $url = get_the_permalink($article_id);

  // if a link exists on this evolution method, add it
  $relevant_article = $pokemon['evolution_relevant_article'];
  if ($relevant_article) {
    $relevant_title = get_the_title($relevant_article);
    $relevant_url = get_the_permalink($relevant_article);

    $method = "<a 
      class='relevant-article' 
      href='$relevant_url' 
      title='$relevant_title'>
        $pokemon[evolution_method]
      </a>
    ";
  } else {
    $method = "<span class='no-relevant-article'>
      $pokemon[evolution_method]
    </span>";
  }

  ?><div class="evolution flex vertically-centered"><?php
    if ($pokemon['evolution_method']) {
      fa('arrow-right');
      echo $method;
      fa('arrow-right');
    }

    menu_sprite($sprite, $title, $url); ?>
  </div><?php
}

function format_evolutions($article_id, $evolves_from) { ?>
  <div class="evolution-list flex wraps-on-mobile"><?php
    foreach(generate_evo_trees($article_id, $evolves_from) as $array) {
      format_single_evolution_chain($array);
    }
  ?></div>
<?php }

function generate_evo_trees($article_id, $evolves_from) {
  $results = [];
  $start = first_pokemon_in_evo_chain(
    $article_id, 
    $evolves_from
  );

  $full_tree = traverse_evo_tree(['article_id' => $start]);
  return array_filter($full_tree, function($path) use ($article_id) {
    $ids = array_map(function($el) {
      return $el['article_id'];
    }, $path);

    return in_array($article_id, $ids);
  });
}

function traverse_evo_tree($article_obj) {
  $article_id = $article_obj['article_id'];
  $evos = get_field('evolutions', $article_id);

  $self = [$article_obj];

  if (empty($evos)) {
    return [$self];
  } else {
    $result = [];

    foreach($evos as $evo) {
      $evo_paths = traverse_evo_tree($evo);

      foreach($evo_paths as $evo_path) {
        // pp($evo_path);
        // pp($self);
        $result[] = array_merge($self, $evo_path);
      }
    }

    return $result;
  }
}

function first_pokemon_in_evo_chain($article_id, $evolves_from) {
  if (!$evolves_from) return $article_id;

  return first_pokemon_in_evo_chain(
    $evolves_from,
    get_field('evolves_from', $evolves_from)
  );
}

?>