<header id="wrapper">
  <header id="content" class="slight-mobile-margin slight-small-computer-margin">
    <div id="header-main-bar" class="flex wraps one-growing-element">
      <?php site_name(['class' => "vertically-centered"]) ?>

      <div id="navbar-wrapper" class="grows centered">
        <?php
          wp_nav_menu([
            'menu' => 'header-menu',
            'menu_class' => 'centered-block has-invisible-links hide-on-mobile',
            'menu_id' => 'navbar'
          ]);
        ?>
      </div>

      <div class="menu-marker">
        <?php fa('bars menu-opener-icon') ?>
      </div>
    </div>

    <?php include('aside.php'); ?>
  </header>
</header>