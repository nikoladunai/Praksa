FROM wordpress:5.0-php7.0

ENV WOOCOMMERCE_VERSION 3.5.0
ENV WOOCOMMERCE_UPSTREAM_VERSION 3.5.0

RUN rm /etc/apt/preferences.d/no-debian-php 

RUN apt-get update -yqq
RUN apt-get -y install libxml2-dev php-soap 
RUN docker-php-ext-install soap

RUN apt-get update
RUN apt-get install -y --no-install-recommends unzip wget

RUN wget https://downloads.wordpress.org/plugin/woocommerce.${WOOCOMMERCE_VERSION}.zip -O /tmp/temp.zip \
    && cd /usr/src/wordpress/wp-content/plugins \
    && unzip /tmp/temp.zip \
    && rm /tmp/temp.zip