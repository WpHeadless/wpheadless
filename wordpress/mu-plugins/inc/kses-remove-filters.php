<?php

if (!is_admin()) return;

add_action( 'admin_init', function () {
  kses_remove_filters();
});
