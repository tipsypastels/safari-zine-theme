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
    <?php echo file_get_contents(__DIR__ . "/../$logo") ?>
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

function image_postbit($href, $img, $title, $excerpt, $date, $author, $categories, $content_cb, $class = "") { ?>
  <a class="image-postbit <?php echo $class ?>" href="<?php echo $href ?>" 
    style="background-image: url(<?php echo $img ?>)">
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

function postbit_content($href, $img, $title, $excerpt, $date, $author, $author_href, $categories, $content_cb, $class = "") { ?>
  <div class="postbit-content <?php echo $class ?> ">
    <?php foreach($categories as $category):
        $id = get_cat_ID($category->name);
        $url = get_category_link($id);
      ?>
      <a class="category category-<?php echo $category->slug ?>-name" href="<?php echo $url ?>"><?php echo $category->name ?></a>
    <?php endforeach ?>
    <h2 class="line-height"><?php echo $title ?></h2>

    <?php if($excerpt): ?>
      <div class="post-excerpt"><?php echo $excerpt ?></div>
    <?php endif; ?>

    <div class="post-thumbnail" style="background-image: url(<?php echo $img ?>)"></div>
    <div class="rule"></div>

    <div class="postbit-content-main"><?php $content_cb() ?></div>

    <div class="rule"></div>

    <a class="author" href="<?php echo $author_href ?>"><?php fa('pencil') ?> Written by <?php echo $author ?></a>
  </div>
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