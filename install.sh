#!/bin/bash


#######################################
# 2015-04-06
# Just core install script
# - install composer 
# - self update
# - install dependencies 
# 
# 
#######################################

curl -sS https://getcomposer.org/installer | php


php composer.phar self-update
php composer.phar install
php composer.phar update
