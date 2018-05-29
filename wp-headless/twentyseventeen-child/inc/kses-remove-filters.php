<?php

add_action( 'admin_init', function () {
  kses_remove_filters();
});
