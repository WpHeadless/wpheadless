<?php

// Disable some core endpoints
add_filter( 'rest_endpoints', function ( $endpoints ) {
  $endpointsToDisable = [
    '/oembed',
    '/wp/v2/search',
    '/wp/v2/posts',
    '/wp/v2/pages',
    '/wp/v2/blocks',
    '/wp/v2/statuses',
    '/wp/v2/taxonomies',
    '/wp/v2/users',
    '/wp/v2/comments',
    '/wp/v2/block-renderer',
    '/wp/v2/settings',
    '/wp/v2/themes',
  ];

  foreach ( array_keys( $endpoints ) as $endpoint ) {
    // exact path match
    if ( in_array( $endpoint, $endpointsToDisable ) ) unset ( $endpoints[$endpoint] );

    // endpoint path prefix match
    foreach ( $endpointsToDisable as $endpointPrefixToDisable ) {
      $endpointPrefixToDisable .= '/';
      $prefixLen = strlen( $endpointPrefixToDisable );
      if ( strncmp( $endpoint, $endpointPrefixToDisable, $prefixLen ) === 0 ) {
        unset ( $endpoints[$endpoint] );
      }
    }
  }

  return $endpoints;
} );
