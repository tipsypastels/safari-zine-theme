<header id="wrapper">
  <header id="content" class="flex one-growing-element slight-mobile-margin">
    <?php site_name(['class' => "vertically-centered"]) ?>

    <div id="navbar-wrapper" class="grows centered">
      <!-- <ul id="navbar" class="centered-block has-invisible-links hide-on-mobile">
        <li><a href="#">Pokédex</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Guides</a></li>
        <li><a href="#">Fangames</a></li>
        <li><a href="#">Showcases</a></li>
        <li><a href="#">Other Games</a></li>
      </ul> -->

      <?php
        wp_nav_menu([
          'menu' => 'header-menu',
          'menu_class' => 'centered-block has-invisible-links hide-on-mobile',
          'menu_id' => 'navbar'
        ]);
      ?>
    </div>

    <div class="menu-opener">
      <?php fa('bars menu-opener-icon') ?>
      <?php include('aside.php'); ?>
    </div>
  </header>
</header>