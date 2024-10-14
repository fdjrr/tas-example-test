# TAS Example Test

## Installation

```bash
$ git clone https://github.com/fdjrr/tas-test
$ cd tas-test
$ composer install
$ npm install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan serve
$ npm run dev
```

## Nginx Config

### 1. If you want http://localhost/tas-test, follow this config

```bash
server {
    listen 80 default_server;
    listen [::]:80 default_server;

    root "D:/Development/Sites";

    index index.php index.html index.htm index.nginx-debian.html;

    server_name localhost;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location /tas-test {
        alias "D:/Development/Sites/tas-test/public";
        try_files $uri $uri/ @tas_test;

        location ~ \.php$ {
            fastcgi_pass php_upstream;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $request_filename;
            include fastcgi_params;
        }
    }

    location @tas_test {
        rewrite /tas-test/(.*)$ /tas-test/index.php?/$1 last;
    }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass php_upstream;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $request_filename;
        include fastcgi_params;
    }
}
```

### 2. If you want http://tas-test.domain.com, follow this config

```bash
server {
    listen 80;
    listen [::]:80;
    server_name tas-test.domain.com;
    root /var/www/tas-test/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Note: please comment `Livewire::setScriptRoute` and `Livewire::setUpdateRoute` in `web.php` if you using point 2.
