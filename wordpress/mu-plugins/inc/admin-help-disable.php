<?php

if (!is_admin()) return;

// hide help button
add_action( 'admin_head', function () {
  echo '<style type="text/css">#contextual-help-link {display: none;}</style>';
} );
