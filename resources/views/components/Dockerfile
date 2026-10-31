FROM node:22-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM php:8.4-cli
RUN apt-get update && apt-get install -y git unzip libzip-dev libsqlite3-dev && docker-php-ext-install pdo_sqlite zip && rm -rf /var/lib/apt/lists/*
COPY —from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
COPY —from=assets /app/public/build ./public/build
RUN composer install —no-dev —optimize-autoloader —no-interaction
RUN sed -i 's/\r$//' docker-start.sh
EXPOSE 10000
CMD ["sh", "docker-start.sh"]