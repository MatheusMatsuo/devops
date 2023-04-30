#!/bin/bash 
set -e

(cd /var/www/html && composer install --ignore-platform-reqs)

(cp .env.example .env)

(php artisan key:generate)

(npm install && npm run build)

(apache2-foreground)
