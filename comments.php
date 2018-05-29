<?php if(!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) : ?>
<?php endif; ?>
  
<?php if(!empty($post->post_password)) : ?>
  <?php if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) : ?>
  <?php endif; ?>
<?php endif; ?>

<?php if($comments) : ?>
  <?php foreach($comments as $comment) : ?>
    <?php if ($comment->comment_approved == '0') : ?>
    <?php endif; ?>
  <?php endforeach; ?>
<?php else : ?>
<?php endif; ?>

<?php if(comments_open()) : ?>
  <?php if(get_option('comment_registration') && !$user_ID) : ?>
  <?php else : ?>
    <?php if($user_ID) : ?>
    <?php else : ?>
    <?php endif; ?>
  <?php endif; ?>
<?php else : ?>
<?php endif; ?>