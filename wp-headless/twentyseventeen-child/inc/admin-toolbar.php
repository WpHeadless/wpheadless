<?php

add_action( 'admin_bar_menu', function ($wp_adminbar) {
  $wp_adminbar->remove_node('wp-logo');
  $wp_adminbar->remove_node('comments');
  $wp_adminbar->remove_node('new-content');
}, 999 );
