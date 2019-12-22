<?php

if (!is_admin()) return;

add_action( 'admin_bar_menu', function ($wp_adminbar) {
  $wp_adminbar->remove_node( 'wp-logo' );
  $wp_adminbar->remove_menu( 'network-admin-d' );
  $wp_adminbar->remove_menu( 'network-admin-t' );
  $wp_adminbar->remove_menu( 'view-site' );
  $wp_adminbar->remove_menu( 'edit-site' );
  $wp_adminbar->remove_menu( 'new-content' );

  // append wp-admin to site-name node href
  $site_name_node = $wp_adminbar->get_node( 'site-name' );
  $site_name_node->href = $site_name_node->href . 'wp-admin/';
  $wp_adminbar->remove_menu( 'site-name' );
  $wp_adminbar->add_node( $site_name_node );

  foreach ( get_sites() as $site ) {
    $wp_adminbar->remove_menu( "blog-{$site->blog_id}-d" );
    $wp_adminbar->remove_menu( "blog-{$site->blog_id}-n" );
    $wp_adminbar->remove_menu( "blog-{$site->blog_id}-v" );
  }
}, 9999 );
