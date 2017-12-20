<?php

add_action( 'template_redirect', function () {
  if ( ! is_front_page() ) {
    wp_redirect( home_url() );
    exit;
  }

  wp_safe_redirect( wp_login_url(), 302 );
  exit;
} );
