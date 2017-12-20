<?php

foreach ( glob( __DIR__ . '/inc/*.php' ) as $filename ) {
  require_once $filename;
}
