<?php

if (!is_admin()) return;

add_action( 'admin_head-my-sites.php', function () {
  echo '<style type="text/css">.form-table, p.submit {display: none;}</style>';
} );
