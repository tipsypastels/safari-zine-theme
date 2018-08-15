<?php

function scratch_setup() {
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('gallery', 'caption'));
  add_theme_support( 'title-tag' );

  register_nav_menus([
    'header-menu' => 'Header Menu',
    'modal-menu-about' => 'Modal Menu About',
    'modal-menu-categories' => 'Modal Menu Categories',
    'modal-menu-bottom' => 'Modal Menu Bottom',
    'footer-social-media' => 'Footer Social Media'
  ]);
}
add_action('after_setup_theme', 'scratch_setup');

function scratch_styles_and_scripts() {
  wp_enqueue_style('main-stylesheet', get_stylesheet_directory_uri() . '/css/style.css');
  wp_enqueue_script('jquery');
  wp_enqueue_script('our-scripts', get_stylesheet_directory_uri() . '/script.js');
}

add_action('wp_enqueue_scripts', 'scratch_styles_and_scripts');

function custom_excerpt_length($length) {
  return 30;
}

add_filter('excerpt_length', 'custom_excerpt_length');

// we don't want the excerpt to default to a truncated description if it's blank.
// instead use null so we can handle it in the layout

function remove_default_excerpt_behavior() {
  remove_filter('get_the_excerpt', 'wp_trim_excerpt');
}

add_action('init', 'remove_default_excerpt_behavior');

function filter_site_upload_size_limit($size) {
  return 60 * 1024 * 1024;
}

add_filter('upload_size_limit', 'filter_site_upload_size_limit', 20);

function fix_brackets_in_password_reset($message, $key, $user_login, $user_data) {
  return "Someone has requested a password reset for the following account: " . sprintf(__('%s'), $user_data->user_email) . "\nIf this was a mistake, just ignore this email.\r\r\n\nTo reset your password, visit the following address: " . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\nDakota was here.";  
}

add_filter('retrieve_password_message', 'fix_brackets_in_password_reset', 99, 4);

?>
