<?php

  // PART 0: WORDPRESS SETUP

  @ini_set( 'upload_max_size' , '64M' );
  @ini_set( 'post_max_size', '64M');
  @ini_set( 'max_execution_time', '300' );

  function scratch_setup() {
    add_theme_support('post-thumbnails');
    register_nav_menus(array('main-menu' => 'Main Menu'));
  }
  add_action('after_setup_theme', 'scratch_setup');

  function scratch_styles_and_scripts() {
    wp_enqueue_style('main-stylesheet', get_stylesheet_directory_uri() . '/style.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('our-scripts', get_stylesheet_directory_uri() . '/script.js');
  }

  add_action('wp_enqueue_scripts', 'scratch_styles_and_scripts');

  function custom_excerpt_length($length) {
    return 30;
  }

  add_filter('excerpt_length', 'custom_excerpt_length');

  // we don't want the excerpt to default to a truncated description if it's blank.
  // instead use null so we can handle it in the layout

  function remove_default_excerpt_behavior() {
    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
  }

  add_action('init', 'remove_default_excerpt_behavior');

  // function create_footer_widgets() {
  //   register_sidebar(array(
  //     'name' => 'Footer Main',
  //     'id'   => 'footer-main',
  //     'before_widget' => '<div class="widget %2$s">',
  //     'after_widget' => '</div>'
  //   ));
  // }
  // add_action('widgets_init', 'create_footer_widgets');

  // PART 1: HELPERS


  // PART 2: COMPONENTS

  // temporary icon
  function site_name($class = "") { ?>
    <a class="site-name <?php echo $class ?>" href="<?php echo get_home_url() ?>">
      <?php require 'logo.svg' ?>
      <div>Safari Zine</div>
    </a>
  <?php }

  function button($icon, $text, $href, $class, $blank = true) {
    if ($blank) {
      $target = "target='_blank'";
    } else {
      $target = "";
    } ?>

    <a class="button <?php echo $class ?>" href="<?php echo $href ?>" <?php echo $target ?>>
      <?php 
        echo ifa($icon);
        echo $text;
      ?>
    </a>
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
        <div class="image-postbit-spacer">

        </div>

        <div class="image-postbit-content">
          <h2><?php echo $title ?></h2>

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

  // PART 3: GENERIC ELEMENTS

  function fa($icon) {
    echo ifa($icon);
  }

  function ifa($icon) {
    return "<i class='fa fa-$icon'></i>";
  }
?>