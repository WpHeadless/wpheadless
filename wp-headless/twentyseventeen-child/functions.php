<?php

// enqueue the parent and child theme stylesheets
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'twentyseventeen-style', get_template_directory_uri() . '/style.css' );
}

// allow rest interface in forcelogin
remove_filter( 'rest_authentication_errors', 'v_forcelogin_rest_access', 99 );

// remove admin menus
function remove_menus() {
  remove_menu_page( 'index.php' );
  remove_menu_page( 'edit.php' );
  remove_menu_page( 'edit.php?post_type=page' );
  remove_menu_page( 'edit-comments.php' );
}

add_action( 'admin_menu', 'remove_menus' );
