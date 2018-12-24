<?php

foreach ( glob( __DIR__ . '/inc/*.php', GLOB_ERR ) as $filename ) {
  require_once $filename;
}
