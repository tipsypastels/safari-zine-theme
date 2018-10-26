<?php
  function image_postbit($href, $img, $title, $excerpt, $class = "") { ?>
    <a class="image-postbit <?php echo $class ?>" href="<?php echo $href ?>" 
      style="background-image: url(<?php echo $img ?>)">
      <div class="image-postbit-shading">
        <div class="image-postbit-content">
          <div class="title-wrapper">
            <h2><?php echo $title ?></h2>
          </div>

          <?php if (!$excerpt) $excerpt = "-"; ?>
          <p><?php echo $excerpt ?></p>
        </div>
      </div>
    </a>
  <?php }

  function list_postbit($href, $img, $title, $excerpt, $class = "") { ?>
    <div class="list-postbit <?php echo $class ?>">
      <a class="list-image hide-on-mobile" style="background-image: url(<?php echo $img ?>)" href="<?php echo $href ?>">
      </a>

      <div class="list-postbit-content">
        <a class="h2" href="<?php echo $href ?>">
          <?php echo $title ?>
        </a>

        <?php if (!$excerpt) $excerpt = "-"; ?>
        <p><?php echo $excerpt ?></p>
      </div>
    </div>
  <?php }

  function categories_list($categories) {
    if($categories): ?>
      <div class="post-categories has-invisible-links">
        <?php foreach($categories as $category):
          $id = get_cat_ID($category->name);
          $url = get_category_link($id);
        ?>
          <a class="category category-<?php echo $category->slug ?>-name" href="<?php echo $url ?>"><?php echo $category->name ?></a>
        <?php endforeach ?>
      </div>
    <?php endif;
  }

  function postbit_content($href, $img, $title, $excerpt, $date, $author, $author_id, $categories, $content_cb, $edit_link_cb = null, $class = "", $meta = []) { ?>

    <div class="single-post-content <?php echo $class ?> ">
      <h2 class="standard-title huge"><?php echo $title ?></h2>
      <div class="centered post-date">
        <?php echo $date ?>
        <?php if (is_user_logged_in() && $edit_link_cb): ?>
          | <span class="has-invisible-links"><?php $edit_link_cb('Edit') ?></span>
        <?php endif; ?>
      </div>
      
      <?php user_bit($author, $author_id); ?>

      <?php if ($img) {
        featured_image($img, $meta);
      } ?>
      <div class="article-contents"><?php $content_cb() ?></div>

    </div>
  <?php }

  function featured_image($img, $meta = []) {
    $meta_size = $meta['featimg-bgsize'];
    $meta_color = $meta['featimg-bgcolour'];

    $classes = 'article-thumbnail ';
    $style = "background-image: url($img);";

    if ($meta_size) {
      $classes .= 'expanded-background ';
      $style .= "--size: $meta_size[0];"; 
    }

    if ($meta_color) {
      $classes .= 'set-background-color';
      $style .= "--color: $meta_color[0];";
    }

    ?>
      <div class="<?php echo $classes ?>" style="<?php echo $style ?>"></div>
    <?php
  }
?>