<?php

if (defined('WP_MAIL_FROM_EMAIL') && WP_MAIL_FROM_EMAIL !== '') {
  add_filter( 'wp_mail_from', function () {
    return WP_MAIL_FROM_EMAIL;
  } );
}

if (defined('WP_MAIL_FROM_NAME') && WP_MAIL_FROM_NAME !== '') {
  add_filter( 'wp_mail_from_name', function () {
    return WP_MAIL_FROM_NAME;
  } );
}
