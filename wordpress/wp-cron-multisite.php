<?php

require( __DIR__ . '/wp-load.php' );

foreach ( get_sites([ 'deleted' => 0, 'archived' => 0 ]) as $site ) {
  $url = "https://{$site->domain}{$site->path}wp-cron.php";
  $ch = curl_init();
  curl_setopt_array( $ch, [
    CURLOPT_CONNECT_TO      => [ "{$site->domain}:443:nginx:443" ],
    CURLOPT_URL             => $url,
    CURLOPT_SSL_VERIFYHOST  => false,
    CURLOPT_SSL_VERIFYPEER  => false,
    CURLOPT_HTTPHEADER      => [
      'host' => $site->domain
    ]
  ] );
  curl_exec( $ch );
  curl_close( $ch );
}
