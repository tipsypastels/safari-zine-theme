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

  function postbit_content($href, $img, $title, $excerpt, $date, $author, $author_id, $categories, $content_cb, $class = "") { ?>
    <div class="single-post-content <?php echo $class ?> ">
      <h2 class="standard-title huge"><?php echo $title ?></h2>
      
      <?php user_bit($author, $author_id); ?>

      <div class="post-thumbnail" style="background-image: url(<?php echo $img ?>)"></div>
      <div class="article-contents"><?php $content_cb() ?></div>

    </div>
  <?php }
?>