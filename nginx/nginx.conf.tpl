user nginx;
worker_processes 1;

error_log /var/log/nginx/error.log warn;
pid /var/run/nginx.pid;

events {
  worker_connections 1024;
}

http {
  include /etc/nginx/mime.types;
  default_type application/octet-stream;

  server_tokens off;
  sendfile on;
  keepalive_timeout 65;
  gzip on;

  server {
    server_name _;
    listen 80 default_server;
    listen [::]:80 default_server;

    access_log /dev/stdout;
    error_log /dev/stdout info;

    location '/.well-known/acme-challenge' {
      try_files ${DOLLAR}uri =404;
      default_type "text/plain";
      root /var/www/html;
    }

    location / {
      return 301 https://${DOLLAR}host${DOLLAR}request_uri;
    }
  }

  server {
    server_name _;
    listen 443 ssl http2 default_server;
    listen [::]:443 ssl http2 default_server;

    root /var/www/wordpress/html;
    index index.php;

    error_log /dev/stdout info;
    access_log /dev/stdout;

    resolver 8.8.8.8 8.8.4.4;

    ssl_protocols TLSv1 TLSv1.1 TLSv1.2 TLSv1.3;
    ssl_ciphers 'ECDHE-ECDSA-CHACHA20-POLY1305:ECDHE-RSA-CHACHA20-POLY1305:ECDHE-ECDSA-AES128-GCM-SHA256:ECDHE-RSA-AES128-GCM-SHA256:ECDHE-ECDSA-AES256-GCM-SHA384:ECDHE-RSA-AES256-GCM-SHA384:DHE-RSA-AES128-GCM-SHA256:DHE-RSA-AES256-GCM-SHA384:ECDHE-ECDSA-AES128-SHA256:ECDHE-RSA-AES128-SHA256:ECDHE-ECDSA-AES128-SHA:ECDHE-RSA-AES256-SHA384:ECDHE-RSA-AES128-SHA:ECDHE-ECDSA-AES256-SHA384:ECDHE-ECDSA-AES256-SHA:ECDHE-RSA-AES256-SHA:DHE-RSA-AES128-SHA256:DHE-RSA-AES128-SHA:DHE-RSA-AES256-SHA256:DHE-RSA-AES256-SHA:AES128-GCM-SHA256:AES256-GCM-SHA384:AES128-SHA256:AES256-SHA256:AES128-SHA:AES256-SHA:!DSS';
    ssl_prefer_server_ciphers on;
    ssl_session_timeout 5m;
    ssl_session_cache shared:SSL:10m;
    ssl_session_tickets off;
    ssl_certificate /etc/letsencrypt/active/${DOMAIN}/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/active/${DOMAIN}/privkey.pem;
    ssl_dhparam /etc/letsencrypt/dhparam.pem;
    ssl_stapling on;
    ssl_stapling_verify on;
    ssl_trusted_certificate /etc/letsencrypt/active/${DOMAIN}/fullchain.pem;

    add_header Strict-Transport-Security "max-age=31536000" always;
    add_header X-Frame-Options SAMEORIGIN always;

    if (!-e ${DOLLAR}request_filename) {
      rewrite ^(/[^/]+)?(/wp-.*) ${DOLLAR}2 last;
      rewrite ^(/[^/]+)?(/.*\.php) ${DOLLAR}2 last;
    }

    location = /robots.txt {
      return 200 "User-agent: *\nDisallow: /\n";
    }

    location = / {
      return 302 /wp-admin/;
    }

    # Allow only fixed set of files in Wordpress to be requested
    location ~ ^/(?!(wp-admin|wp-includes|wp-content|wp-json|wp-activate\.php|wp-cron\.php|wp-login\.php|index\.php)) {
      return 404;
    }

    # Disable php processing in uploads
    location ~ ^/wp-content/uploads/.*${DOLLAR} {
      try_files ${DOLLAR}uri =404;
    }

    location ~ \.php${DOLLAR} {
      try_files ${DOLLAR}uri =404;
      fastcgi_split_path_info ^(.+\.php)(/.+)${DOLLAR};
      fastcgi_pass php:9000;
      fastcgi_index index.php;
      include fastcgi_params;
      fastcgi_param SCRIPT_FILENAME ${DOLLAR}document_root${DOLLAR}fastcgi_script_name;
      fastcgi_param PATH_INFO ${DOLLAR}fastcgi_path_info;
    }

    location / {
      try_files ${DOLLAR}uri /index.php?${DOLLAR}args;
    }
  }
}
