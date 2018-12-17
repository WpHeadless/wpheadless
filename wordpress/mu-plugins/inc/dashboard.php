<?php

if (!is_admin()) return;

add_action( 'wp_dashboard_setup', function () {
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );      // Wordpress news
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );  // Quick draft
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    // At a glance
  remove_meta_box( 'dashboard_activity', 'dashboard', 'core' );     // Activity
  remove_action( 'welcome_panel', 'wp_welcome_panel' );             // Welcome panel
} );
