

FROM php:8.3-fpm-alpine

ARG BACKEND_DIR

COPY public "$BACKEND_DIR/public"