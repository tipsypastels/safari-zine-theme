<?php
  function user_bit($username, $user_id) {
    $description = get_userdata($user_id)->user_description;
    $avatar = get_wp_user_avatar_src($user_id);
    $user_href = get_author_posts_url($user_id);  
  ?>
    <a class="user-bit flex vertically-centered centered-block-on-mobile has-invisible-links" href="<?php echo $user_href ?>">
      <img class="avatar small" src="<?php echo $avatar ?>">
      <div class="user-bit-contents">
        <h2 class="username stylized"><?php echo $username ?></h2>
        <p class="description"><?php echo $description ?></p>
      </div>
    </a>
  <?php }
?>