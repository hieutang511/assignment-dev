FROM phusion/baseimage:0.9.19
MAINTAINER Hieu Tang <hieutang511@gmail.com>
CMD ["/sbin/my_init"]

ADD php5.6-repo-key /key1
RUN apt-key add key1 
RUN add-apt-repository -y ppa:ondrej/php
RUN apt-get update
RUN DEBIAN_FRONTEND=noninteractive apt-get -yq install \
    curl \
    apache2 \
    php5.6 \
    libapache2-mod-php5.6 \
    php5.6-mcrypt \
    php5.6-cli \
    php5.6-common \
    php5.6-curl \
    php5.6-gd \
    php5.6-mysql \
    php5.6-intl \
    php5.6-imap \
    php5.6-mbstring \
    php5.6-xml \
    git \
    unzip \
    nodejs \
    npm
RUN a2enmod rewrite
RUN npm install -g less
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

RUN usermod -u 1000 www-data
RUN mkdir -p /var/www/assignment
RUN chown -R www-data:www-data /var/www/assignment
ADD assignment.dev.conf /etc/apache2/sites-available
RUN a2ensite assignment.dev.conf

# Add image configuration and scripts
ADD run.sh /run.sh
RUN chmod 755 /*.sh

RUN composer global require "fxp/composer-asset-plugin:*"

RUN ln -s `which nodejs` /usr/bin/node

EXPOSE 80
CMD ["/run.sh"]