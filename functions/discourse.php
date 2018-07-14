<?php

function custom_discourse_replies($input) {
  ob_start(); ?>

  <div id="discourse-comments" class="discourse-comments-area">
    <a class="standard-title has-invisible-links block-link centered-block using-max-content" href="{topic_url}">Join the discussion on Safari Zone!</a>


    {comments}
  </div>

  <?php
    $output = ob_get_clean();
    return $output;
}

add_filter('discourse_replies_html', 'custom_discourse_replies');

function custom_discourse_comment($input) {
  ob_start(); ?>

  <article class="discourse-comment flex centered-block has-invisible-links">
    <img class="block-image avatar small" src="{avatar_url}">
    <div class="discourse-comment-content">
      <a class="username stylized" href="{user_url}">{username}</a>
      <div class="discourse-comment-body">
        {comment_body}
      </div>
    </div>
  </article>

  <?php
    $output = ob_get_clean();
    return $output;
}

add_filter('discourse_comment_html', 'custom_discourse_comment');