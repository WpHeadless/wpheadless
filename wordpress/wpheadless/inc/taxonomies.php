<?php

add_action( 'init', function () {
  global $wp_taxonomies;

  if ( taxonomy_exists( 'category' )) {
    unset( $wp_taxonomies['category'] );
  }

  if ( taxonomy_exists( 'post_tag' )) {
    unset( $wp_taxonomies['post_tag'] );
  }
});
