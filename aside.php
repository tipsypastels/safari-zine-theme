<div id="aside-wrapper" class="onclick-close-sidebar">
  <aside id="sidebar">
    <div id="aside-content">
      <div class="sidebar-main-title">
        <?php bloginfo('name') ?>
      </div>

      <p class="about-zine">
         Welcome! The Safari Zine is a collective of writers interested in all things Pokémon! We feature news, fanart and fiction, and guides on subjects such as ROM hacking and competitive battling.
      </p>

      <?php
        $menu_classes = 'button-group has-invisible-links';

        wp_nav_menu([
          'theme_location' => 'header-featured-links',
          'menu_class' => $menu_classes,
          'menu_id' => 'mobile-main-navbar'
        ]);

        wp_nav_menu([
          'theme_location' => 'sidebar-contributing',
          'menu_class' => $menu_classes,
          'container' => false
        ]);

      ?>
    </div>
  </aside>
</div>