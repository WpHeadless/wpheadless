<?php

if (!is_admin()) return;

add_filter( 'wp_link_query', function ( $results ) {
  return [];
} );

add_action( 'admin_head', function () {
  echo '<style type="text/css">
  #wp-link #link-selector .howto {display: none;}
  #wp-link #link-selector #search-panel {display: none;}
  </style>
  ';
} );
