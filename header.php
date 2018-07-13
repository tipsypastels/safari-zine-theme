<?php ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://use.fontawesome.com/c2f8b0ab87.js"></script>
    <?php
      if (!function_exists('_wp_render_title_tag')) {
        function theme_slug_render_title() {
      ?>
      <title><?php wp_title( '|', true, 'right' ); ?></title>
      <?php
        }
        add_action('wp_head', 'theme_slug_render_title');
      }
    ?>
    <?php wp_head(); ?>
  </head>
  <body>
    <?php include('header-navbar.php'); ?>
    <div class="container flex">
      <div class="main-container">