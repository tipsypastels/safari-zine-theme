<!-- 
  to manage the heights with a single variable
  this entire header is now a flex column
  which means we do need these unfortunate flex grow classes
-->

<header id="wrapper" class="flex">
  <div class="flex-grow"></div>
  <header id="content">
    <div id="header-main-bar" class="flex wraps one-growing-element">
      <?php site_name(['class' => "vertically-centered dont-multiply-title-size"]) ?>

      <div class="grows"></div>

      <div class="menu-marker">
        <?php fa('bars menu-opener-icon') ?>
      </div>
    </div>
  </header>

  <header id="lower-navbar" class="hide-on-mobile"><?php
    wp_nav_menu([
      'theme_location' => 'header-featured-links',
      'menu_class' => 'centered-block has-invisible-links inline-list',
      'menu_id' => 'navbar'
    ]);
  ?></header>
</header>