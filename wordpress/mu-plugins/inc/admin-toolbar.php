<?php

if (!is_admin()) return;

add_action( 'admin_bar_menu', function ($wp_adminbar) {
  $wp_adminbar->remove_node( 'wp-logo' );
  $wp_adminbar->remove_menu( 'network-admin-d' );
  $wp_adminbar->remove_menu( 'network-admin-t' );
  $wp_adminbar->remove_menu( 'view-site' );
  $wp_adminbar->remove_menu( 'edit-site' );
  $wp_adminbar->remove_menu( 'new-post' );
  $wp_adminbar->remove_menu( 'new-page' );

  foreach ( get_sites() as $site ) {
    $wp_adminbar->remove_menu( "blog-{$site->blog_id}-d" );
    $wp_adminbar->remove_menu( "blog-{$site->blog_id}-n" );
    $wp_adminbar->remove_menu( "blog-{$site->blog_id}-v" );
  }
}, 9999 );
