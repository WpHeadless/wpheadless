<?php

if (!is_admin()) return;

add_filter( 'admin_footer_text', function () {
  echo '<span id="footer-thankyou">Thank you for creating with WordPress <a href="https://github.com/WpHeadless/wpheadless" target="_blank">Headless Bundle</a></span>';
} );
