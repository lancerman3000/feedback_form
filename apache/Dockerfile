FROM php:7.4-apache
RUN apt-get update && apt-get install -y \
	curl \
	wget \
	&& docker-php-ext-install -j$(nproc) mysqli pdo_mysql
EXPOSE 80