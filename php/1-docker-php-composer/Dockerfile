FROM php:alpine
MAINTAINER Julien MERCIER <devci@j3ck3l.me>
# This Dockerfile build a php image with composer included
# It used for this tutorials.
#
# Reminder : It's not recommanded to have composer installed in container for production
# as this is required for developpement only.
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/863c57de1807c99d984f7b56f0ea56ebd7e5045b/web/installer -O - -q | php -- --quiet &&\
    mv composer.phar /usr/local/bin/composer && \
    composer self-update