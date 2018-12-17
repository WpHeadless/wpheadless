<?php

if (!is_admin()) return;

add_action( 'admin_init', function () {
  // https://developer.wordpress.org/reference/functions/kses_remove_filters/
  kses_remove_filters();
});
