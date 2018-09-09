<?php
  function user_bit($username, $user_id) {
    if (!$username) return;

    $description = get_userdata($user_id)->user_description;
    $avatar = get_wp_user_avatar_src($user_id);
    $user_href = get_author_posts_url($user_id); 
    $description = format_description($description);

    return user_bit_generic($user_href, $avatar, $username, $description);
  }

  function user_bit_generic($href, $avatar, $username, $description) { ?>
    <a target="_blank" class="user-bit flex vertically-centered centered-block-on-mobile has-invisible-links" href="<?php echo $href ?>">
      <img class="avatar small" src="<?php echo $avatar ?>">
      <div class="user-bit-contents">
        <h2 class="username stylized"><?php echo $username ?></h2>
        <p class="description"><?php echo $description ?></p>
      </div>
    </a>
  <?php }

  function format_description($description) {
    $max_length = 170;
    $continue = '...';

    if (strlen($description) <= $max_length) {
      return $description;
    }  else {
      $crop_to = $max_length - strlen($continue);
      return substr($description, 0, $crop_to) . $continue;
    }
  }
?>