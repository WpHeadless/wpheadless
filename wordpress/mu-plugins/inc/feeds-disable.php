<?php

function wpheadless_disable_feed () {
  // wp_die( '', '', [ 'response' => 404 ]);
  global $wp_query;
  $wp_query->set_404();
  status_header( 404 );
  nocache_headers();
  exit;
}

add_action('do_feed', 'wpheadless_disable_feed', 1);
add_action('do_feed_rdf', 'wpheadless_disable_feed', 1);
add_action('do_feed_rss', 'wpheadless_disable_feed', 1);
add_action('do_feed_rss2', 'wpheadless_disable_feed', 1);
add_action('do_feed_atom', 'wpheadless_disable_feed', 1);
add_action('do_feed_rss2_comments', 'wpheadless_disable_feed', 1);
add_action('do_feed_atom_comments', 'wpheadless_disable_feed', 1);
