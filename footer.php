      </div> <!-- end main container -->
    </div> <!-- end container -->

    <?php wp_footer(); ?>

    <footer id="footer">
      <div id="footer-sm">
        <h4>Brought to you by</h4>
        <?php
          site_name([
            'href'   => 'https://www.safarizone.net',
            'logo'   => 'logo_zone.svg',
            'name'   => 'Safari Zone',
            'target' => '_blank'
          ]);

          wp_nav_menu([
            'menu' => 'footer-social-media',
            'menu_class' => 'centered-block has-invisible-links has-social-media-menu',
            'container' => false
          ]);
        ?>
      </div>

      <div id="footer-legal">
        <p>
          <?php copyright() ?>
        </p>

        <p>
          Safari Zone is not affiliated by Pokémon, Game Freak, or Nintendo. Pokémon is the property of Nintendo and The Pokémon Company International.
        </p>
      </div>
    </footer>
  </body>
</html>