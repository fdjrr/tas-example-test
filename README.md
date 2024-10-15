# TAS Example Test

## Installation

```bash
$ git clone https://github.com/fdjrr/tas-example-test
$ cd tas-example-test
$ composer install
$ npm install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan serve
$ npm run dev
```

## Nginx Config

### 1. If you want http://localhost/tas-example-test, follow this config

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

    location /tas-example-test {
        alias "D:/Development/Sites/tas-example-test/public";
        try_files $uri $uri/ @tas_test;

        location ~ \.php$ {
            fastcgi_pass php_upstream;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $request_filename;
            include fastcgi_params;
        }
    }

    location @tas_test {
        rewrite /tas-example-test/(.*)$ /tas-example-test/index.php?/$1 last;
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

> Note : please run `php artisan livewire:publish --assets` before run app & uncomment `Livewire::setScriptRoute` and `Livewire::setUpdateRoute` in `web.php` if you using point 1.

### 2. If you want http://tas-example-test.domain.com, follow this config

```bash
server {
    listen 80;
    listen [::]:80;
    server_name tas-example-test.domain.com;
    root /var/www/tas-example-test/public;

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
