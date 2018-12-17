<?php

if (!is_admin()) return;

add_action( 'admin_bar_menu', function ($wp_adminbar) {
  $wp_adminbar->remove_node('wp-logo');
  $wp_adminbar->remove_node('comments');
}, 9999 );
