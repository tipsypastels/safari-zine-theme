<?php

function site_name(array $array = []) {
  $defaults = [
    'class'      => '',
    'logo'       => 'logo.svg',
    'name'       => get_bloginfo('name'),
    'href'       => get_home_url(),
    'target'     => '_self',
    'menu'       => null,
    'menu_class' => 'inline-list',
    'menu_cont'  => false,
    'only_logo'  => false
  ];
  $array = array_merge($defaults, array_intersect_key($array, $defaults));

  list($class, $logo, $name, 
       $href, $target, $menu, 
       $menu_class, $menu_cont,
       $only_logo) = array_values($array);

  $a_settings = "target='$target' href='$href'";
  $has_menu = $menu ? "has-menu" : "no-menu";

  ?>
  <div class="site-name <?php echo $class ?> <?php echo $has_menu ?>">
    <a <?php echo $a_settings ?>>
      <?php echo file_get_contents(__DIR__ . "/../images/logo/$logo") ?>
    </a>

    <?php if(!$only_logo): ?>
      <div class="site-name-contents">
        <a class="site-title" <?php echo $a_settings ?>>
          <?php echo $name ?>
        </a>

        <?php if($menu) {
          wp_nav_menu([
            'theme_location' => $menu,
            'menu_class'     => $menu_class,
            'container'      => $menu_cont
          ]);
        } ?>
      </div>
    <?php endif; ?>
  </div>
<?php }

function paginate($dir, $word, $url) { ?>
  <div class="pagination-area">
    <a class="pagination-area-card pagination-area-card-<?php echo $dir ?>" href="<?php echo $url ?>">
      <?php if ($dir === 'left') {
        fa('arrow-circle-left');
        ?> 
          <span class="pagination-title"><?php echo $word ?></span>
        <?php
      } else if ($dir === 'right') {
        ?> 
          <span class="pagination-title"><?php echo $word ?></span>
        <?php       
        fa('arrow-circle-right');
      } ?>
    </a>
  </div>
<?php }

?>