<p align="center"><img src="https://imgur.com/wUhBSGv.png" width="400" alt="NetworkManager Logo"></p>

<h1 align="center">Ticket<i>System</i></h1>

> [!NOTE]  
> This web interface only works with NetworkManager 2.16.9 or newer!

## Requirements
1. PHP 8.2 or 8.3
2. Nginx, Apache or some other web server software that supports php. Nginx is the favorite here!
3. Composer
4. Git

## Installation

1. Open the terminal (ssh) to your web server.
2. Change directory to `/var/www/` by running `cd /var/www/`
3. Run `git clone https://github.com/ChimpGamer/NetworkManagerTickets.git networkmanager-tickets`
4. Enter the directory `networkmanager-tickets` by running `cd networkmanager-tickets`
5. Install the dependencies by running `composer install --optimize-autoloader --no-dev`
6. Rename `.env.example` to `.env` by executing `mv .env.example .env.`
7. Configure the settings in the `.env` file.
8. Generate a unique key by running `php artisan key:generate`. This key will be saved in the `.env file`.
9. Configure nginx to direct all requests to the ticket application. See [Nginx Configuration Example](#Nginx-Configuration-Example)..

## Optimizations
To improve performance there are a few things you can do. Caching! Cache the config, routes and views. You can do this by running these commands:
```shell
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Nginx Configuration Example
```
server {
    listen 80;
    listen [::]:80;
    server_name networkmanager-tickets.example.com;
    root /var/www/networkmanager-tickets/public;
 
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
        fastcgi_pass unix:/var/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
 
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Updating

First enter the folder that contains the web files. Then run the following commands to update:
```shell
php artisan down
git pull
composer install --no-dev --optimize-autoloader
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan up
```
After that it should be running just fine again.
