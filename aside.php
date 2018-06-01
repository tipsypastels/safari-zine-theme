<aside id="modal">
  <?php
    site_name(['class' => "vertically-centered", 'logo' => "logo_grey.svg"]);
    
    $menu_classes = 'button-group about-buttons flex wraps buttons-expand has-invisible-links';

    wp_nav_menu([
      'menu' => 'modal-menu-about',
      'menu_class' => $menu_classes,
      'container' => false
    ]);
  ?>

  <h3>Categories</h3>
  <?php
    wp_nav_menu([
      'menu' => 'modal-menu-categories',
      'menu_class' => $menu_classes,
      'container' => false
    ]);
  ?>

  <h3>Meta</h3>
  <?php
    wp_nav_menu([
      'menu' => 'modal-menu-bottom',
      'menu_class' => $menu_classes,
      'container' => false
    ]);
  ?>

</aside>
