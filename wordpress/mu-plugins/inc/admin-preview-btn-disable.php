<?php

if (!is_admin()) return;

// hide preview button
add_action( 'admin_head-post-new.php', 'admin_css_post' );
add_action( 'admin_head-post.php', 'admin_css_post' );

function admin_css_post () {
  echo '<style type="text/css">#post-preview, #view-post-btn, #visibility {display: none;}</style>';
}
