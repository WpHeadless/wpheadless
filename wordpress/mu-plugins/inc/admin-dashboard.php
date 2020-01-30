<?php

if (!is_admin()) return;

// redirect dashboard to "my sites" page
add_action( 'current_screen', function ( $screen) {
  if ( 'dashboard' == $screen->id ) {
    wp_safe_redirect( admin_url( 'my-sites.php' ) );
    exit;
  }
} );
