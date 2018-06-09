<aside id="modal">
  <?php
    
    $menu_classes = 'flex wraps has-invisible-links';

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
