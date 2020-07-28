<?php

add_filter('upload_mimes', function ( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['ico'] = 'image/vnd.microsoft.icon';
  return $mimes;
});

