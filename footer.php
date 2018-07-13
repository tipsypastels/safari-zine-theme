      </div> <!-- end main container -->
    </div> <!-- end container -->

    <?php wp_footer(); ?>

    <footer id="footer">
      <footer id="footer-upper">
        <?php
          site_name([
            'href'       => 'https://www.safarizone.net',
            'logo'       => 'logo_zone.svg',
            'name'       => 'Safari Zone',
            'target'     => '_blank',
            'menu'       => 'footer-social-media',
            'menu_class' => 'has-invisible-links has-social-media-menu inline-list hide-on-mobile',
            'menu_cont'  => false
          ]);

          wp_nav_menu([
            'menu' => 'footer-social-media',
            'menu_class' => 'centered-block has-invisible-links has-social-media-menu inline-list hide-on-computer',
            'container' => false
          ]);
        ?>

      </footer>

      <footer id="footer-lower" class="flex vertically-centered">
        <div id="back-to-top">
          <?php fa('caret-up') ?>
        </div>

        <div class="footer-zine-logo hide-on-mobile">
          <?php 
            site_name([
              'logo'      => 'logo_grey.svg',
              'only_logo' => true,
              'class'     => 'big-logo' 
            ]);
          ?>
        </div>

        <div class="footer-legal">
          <p class="stylized">
            <?php copyright() ?>
          </p>

          <p>
            Safari Zone is not affiliated with Pokémon, Game Freak, or Nintendo. Pokémon is the property of Nintendo and The Pokémon Company International.
          </p>
        </div>
      </footer>
    </footer>
  </body>
</html>