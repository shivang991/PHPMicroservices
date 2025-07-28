FROM node:20-slim AS frontend-build

ENV PNPM_HOME="/pnpm"
ENV PATH="$PNPM_HOME:$PATH"
RUN corepack enable

WORKDIR /app


COPY frontend-web/ .
RUN pnpm install
RUN pnpm build


# FROM php:8.3-apache as final

# RUN docker-php-ext-install pdo pdo_mysql

# COPY ./index.php /var/www/html/index.php

# RUN mkdir /var/www/html/frontend-web
# COPY --from=frontend-build /app/dist/ /var/www/html/frontend-web/dist/

# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# # USER www-data
# # CMD ["apache2-foreground"]

# FROM nginx:alpine3.22-slim AS final
# FROM nginx AS final

# # RUN apk add --no-cache nginx-


# COPY public /srv/phpmicroservices/public
# COPY nginx.conf /etc/nginx/conf.d/default.conf

# # FROM php:8.4-fpm

FROM php:8.3-fpm AS final

COPY --from=frontend-build /app/dist/ /srv/phpmicroservices/public/frontend-web/dist/
COPY public /srv/phpmicroservices/public
