FROM thiagobarradas/wordpress:4.9-php7.2

# VARIABLES
ENV WOOCOMMERCE_VERSION=3.6.2

# COPY SCRIPT TO SETUP WOOCOMMERCE
COPY .htaccess .htaccess
COPY scripts/supervisord-zwoocommerce.conf /etc/supervisor/conf.d/supervisord-zwoocommerce.conf
COPY scripts/setup-woocommerce.sh /setup-woocommerce.sh
COPY scripts/setup-wizard-woocommerce.php /setup-wizard-woocommerce.php
COPY scripts/setup-wizard-swissbilling.php /setup-wizard-swissbilling.php
COPY plugins/swissBilling/ /app/wp-content/plugins/swissBilling/

# EXPOSE AND RUN
RUN chmod -R 777 /var/www/html
WORKDIR /var/www/html
EXPOSE 80 3306
CMD ["/run.sh"]
