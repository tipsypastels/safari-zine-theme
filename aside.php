<aside id="modal" class="flex wraps-on-mobile">
  <?php
    
    $menu_classes = 'flex wraps wraps-on-mobile button-group has-invisible-links';

    wp_nav_menu([
      'menu' => 'header-about-links',
      'menu_class' => $menu_classes,
      'container' => false
    ]);
  ?>

  <?php
    wp_nav_menu([
      'menu' => 'header-featured-links',
      'menu_class' => $menu_classes . ' hide-on-computer',
      'container' => false
    ]);
  ?>

  <?php
    wp_nav_menu([
      'menu' => 'header-staffing-links',
      'menu_class' => $menu_classes,
      'container' => false
    ]);
  ?>
</aside>
