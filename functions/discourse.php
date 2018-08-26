<?php

function custom_discourse_replies($input) {
  ob_start(); ?>

  <div id="discourse-comments" class="discourse-comments-area">
    <a class="discourse-comments-title flex vertically-centered one-growing-element has-invisible-links" href="{topic_url}" target="_blank">
      <h2 class="grows block-link">Discussion</h2>
      <div><button class="button-alt">Comment <?php fa('reply') ?></button></div>
    </a>

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
    <a target="_blank" href="{user_url}" class="block-link"><img class="avatar small" src="{avatar_url}"></a>
    <div class="discourse-comment-content">
      <a target="_blank" class="username stylized" href="{user_url}">{username}</a>
      <span class="created-at stylized">{comment_created_at}</span>
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

function custom_discourse_no_replies($input) {
  ob_start(); ?>

  <div id="discourse-comments" class="discourse-comments-area">
    <a class="discourse-comments-title flex vertically-centered one-growing-element has-invisible-links" href="{topic_url}" target="_blank">
      <h2 class="grows block-link">Discussion</h2>
      <div><button class="button-alt">Comment <?php fa('reply') ?></button></div>
    </a>

    <span class="large-text">No comments yet! Be the first to comment <a target="_blank" href="{topic_url}">on our forums!</a></span>
  </div>

  <?php
    $output = ob_get_clean();
    return $output;
}

add_filter('discourse_no_replies_html', 'custom_discourse_no_replies');

// we can't use line breaks bc fuck discourse html parser :/
function discourse_publish_format($input) {
  ob_start(); ?>
    <div class="zine-new-article">
      <div class="zine-header" style="background-image: url({featuredimage})">
      </div>
      <div class="zine-title">
        <h1>{title}</h1>
      </div>
      <div class="zine-body clearfix">
        <p>{excerpt}</p>
        <a target="_blank" class="zine-btn" href="https://zine.safarizone.net">More Safari Zine</a>
        <a target="_blank" class="zine-btn" href="{blogurl}">Read Article</a>
      </div>
    </div>
  <?php
    $output = ob_get_clean();
    return $output;
}

add_filter('discourse_publish_format_html', 'discourse_publish_format');