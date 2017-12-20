<?php

add_action( 'admin_menu', function () {
  array_map( 'remove_menu_page', [
    'index.php',
    'edit.php',
    'edit.php?post_type=page',
    'edit-comments.php'
  ] );
} );
