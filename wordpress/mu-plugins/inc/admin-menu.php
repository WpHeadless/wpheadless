<?php

if (!is_admin()) return;

add_action( 'admin_menu', function () {
  array_map( 'remove_menu_page', [
    'index.php',
    'edit.php',
    'edit.php?post_type=page',
    'edit-comments.php',
    'themes.php'
  ] );

  remove_submenu_page( 'options-general.php', 'options-writing.php' );
  remove_submenu_page( 'options-general.php', 'options-reading.php' );
  remove_submenu_page( 'options-general.php', 'options-permalink.php' );
} );

add_action( '_network_admin_menu', function () {
  array_map( 'remove_menu_page', [
    'index.php',
  ] );

  remove_submenu_page( 'settings.php', 'setup.php' );
} );
