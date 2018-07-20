<?php
  function image_postbit($href, $img, $title, $excerpt, $class = "") { ?>
    <a class="image-postbit <?php echo $class ?>" href="<?php echo $href ?>" 
      style="background-image: url(<?php echo $img ?>)">
      <div class="image-postbit-shading">
        <div class="image-postbit-content">
          <div class="title-wrapper">
            <h2><?php echo $title ?></h2>
          </div>

          <?php if ($excerpt): ?>
            <p><?php echo $excerpt ?></p>
          <?php endif; ?>
        </div>
      </div>
    </a>
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

  function postbit_content($href, $img, $title, $excerpt, $date, $author, $author_id, $categories, $content_cb, $edit_link_cb = null, $class = "") { ?>

    <div class="single-post-content <?php echo $class ?> ">
      <h2 class="standard-title huge"><?php echo $title ?></h2>
      <div class="centered post-date">
        <?php echo $date ?>
        <?php if (is_user_logged_in() && $edit_link_cb): ?>
          | <span class="has-invisible-links"><?php $edit_link_cb('Edit') ?></span>
        <?php endif; ?>
      </div>
      
      <?php user_bit($author, $author_id); ?>

      <?php if($img): ?>
        <div class="post-thumbnail" style="background-image: url(<?php echo $img ?>)"></div>
      <?php endif; ?>
      <div class="article-contents"><?php $content_cb() ?></div>

    </div>
  <?php }
?>