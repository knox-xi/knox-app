FROM node:22-alpine AS assets
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-scripts --prefer-dist --ignore-platform-reqs

FROM php:8.4-cli
RUN apt-get update && apt-get install -y libsqlite3-dev && docker-php-ext-install pdo_sqlite && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY . .
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
RUN sed -i 's/\r$//' docker-start.sh
EXPOSE 10000
CMD ["sh", "docker-start.sh"]
