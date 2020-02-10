<?php

if (!is_admin()) return;

// hide preview button
add_action( 'admin_head-sites.php', function () {
  echo '<style type="text/css">.row-actions > .visit {display: none;}</style>';
} );
