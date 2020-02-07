<?php

if (!is_admin()) return;

add_filter('post_row_actions', function ( $actions ) {
  unset( $actions['inline hide-if-no-js'] );
  unset( $actions['view'] );
  return $actions;
});
