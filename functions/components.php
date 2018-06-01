<?php

function site_name(array $array = []) {
  $defaults = [
    'class'  => '',
    'logo'   => 'logo.svg',
    'name'   => 'Safari Zine',
    'href'   => get_home_url(),
    'target' => '_self'
  ];
  $array = array_merge($defaults, array_intersect_key($array, $defaults));

  list($class, $logo, $name, $href, $target) = array_values($array);

  ?>
  <a target="<?php echo $target ?>" class="site-name <?php echo $class ?>" href="<?php echo $href ?>">
    <?php require __DIR__ . "\..\\$logo" ?>
    <div><?php echo $name ?></div>
  </a>
<?php }

function user_roles($roles) { ?>
  <div class="profile-user-roles">
    <?php foreach($roles as $role) { ?>
      <div class="user-role">
        <?php fa('pencil-square') ?>
        <span class="fontawesome-class">
          <?php echo ucfirst($role) ?>
        </span>
      </div>
    <?php } ?>
  </div>
<?php }

function postbit(
  $href, $img, $title, $excerpt, $date, $author, $author_href, 
  $author_img, $categories, $content = null, $class = null, $thumbnail_callback = null
) { 
  ?>
  <article class="card slight-mobile-margin has-invisible-links $class">
    <?php if ($img): ?>  
      <?php if (is_null($thumbnail_callback)): ?>
        <a class="thumbnail" style="background-image: url(<?php echo $img ?>)" href="<?php echo $href ?>"></a>
      <?php 
        else:
          $thumbnail_callback($img);
        endif;
      ?>
    <?php endif; ?>

    <div class="content">
      <?php foreach($categories as $category):
          $id = get_cat_ID($category->name);
          $url = get_category_link($id);
        ?>
        <a class="h3 category category-<?php echo $category->slug ?>-name" href="<?php echo $url ?>">
          <?php echo $category->name ?>
        </a>
      <?php endforeach ?>
        <h3><?php if ($categories): ?> – <?php endif ?><?php echo $date ?></h3>

      <a class="h2" href="<?php echo $href ?>"><?php echo $title ?></a>
      
      <?php if($excerpt): ?>
        <div class="rule"></div>
        <p><?php echo $excerpt ?></p>
      <?php endif; ?>

      <?php if(!is_null($content)): ?>
        <div class="rule"></div>
        <div class="post-content">
          <?php echo $content ?>
        </div>
      <?php endif; ?>

    </div>

    <?php 
      if($author and $author_href and $author_img) {
        expanding_author_credit($author, $author_href, $author_img);
      } 
    ?>
  </article>
<?php }

function image_postbit($href, $img, $title, $excerpt, $date, $author, $categories) { ?>
  <a class="image-postbit" href="<?php echo $href ?>" 
    style="background-image: url(<?php echo $img ?>">
    <div class="image-postbit-shading">
      <div class="image-postbit-content">
        <div class="title-wrapper">
          <h2><?php echo $title ?></h2>
        </div>

        <?php if ($excerpt): ?>
          <div class="rule"></div>
          <p><?php echo $excerpt ?></p>
        <?php endif; ?>
      </div>
    </div>
  </a>
<?php }

function expanding_author_credit($name, $href, $img) { ?>
  <a class="expanding-author-credit" href="<?php echo $href ?>">
    <span class="name">
      <?php echo $name ?>
    </span>
    <img class="avatar tiny" src="<?php echo $img ?>">
  </a>
<?php }


function paginate($dir, $word, $url) { ?>
  <div class="pagination-area">
    <a class="pagination-area-card pagination-area-card-<?php echo $dir ?>" href="<?php echo $url ?>">
      <?php if ($dir === 'left') {
        fa('arrow-circle-left');
        ?> 
          <span class="pagination-title"><?php echo $word ?> Posts</span>
        <?php
      } else if ($dir === 'right') {
        ?> 
          <span class="pagination-title"><?php echo $word ?> Posts</span>
        <?php       
        fa('arrow-circle-right');
      } ?>
    </a>
  </div>
<?php }

?>