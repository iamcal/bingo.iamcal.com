#!/bin/bash

cd /var/www/html/bingo.iamcal.com

ln -s /var/www/html/bingo.iamcal.com/site.conf /etc/apache2/sites-available/bingo.iamcal.com.conf
a2ensite bingo.iamcal.com
service apache2 reload
