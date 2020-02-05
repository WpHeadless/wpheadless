<?php

if (!is_admin()) return;

// redirect dashboard to "my sites" page
add_action( 'current_screen', function ( $screen) {
  if ( $screen->id === 'dashboard' ) {
    wp_safe_redirect( admin_url( 'my-sites.php' ) );

  } else  if ( $screen->id === 'dashboard-network' ) {
    wp_safe_redirect( admin_url( 'network/sites.php' ) );

  } else {
    return;
  }

  exit;
} );
