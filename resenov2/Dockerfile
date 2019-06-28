FROM wordpress:5.0-php7.1

ENV WOOCOMMERCE_VERSION 3.6.2
ENV WOOCOMMERCE_UPSTREAM_VERSION 3.6.2

RUN apt-get update
RUN apt-get install -y --no-install-recommends unzip wget

RUN wget https://downloads.wordpress.org/plugin/woocommerce.${WOOCOMMERCE_VERSION}.zip -O /tmp/temp.zip \
    && cd /usr/src/wordpress/wp-content/plugins \
    && unzip /tmp/temp.zip \
    && rm /tmp/temp.zip