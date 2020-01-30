<?php

if (!is_admin()) return;

add_filter( 'admin_footer_text', function () {
  echo '<span id="footer-thankyou">Thank you for creating with <a href="https://github.com/WpHeadless/wpheadless" target="_blank">WpHeadless</a></span>';
} );
