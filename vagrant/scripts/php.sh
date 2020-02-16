#!/bin/bash
set -eu

# Install Epel Release
yum -y install epel-release

# Install Remi repository
wget http://rpms.famillecollet.com/enterprise/remi-release-7.rpm
rpm -Uvh remi-release-7*.rpm
rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-EPEL-7
rpm --import /etc/pki/rpm-gpg/RPM-GPG-KEY-remi

# Install PHP
yum install -y --enablerepo=remi,remi-php71 php php-devel php-mbstring php-pdo php-gd php-simplexml php-mysqlnd php-intl php-zip zip unzip php-pecl-zip

# Restart Apache
systemctl restart httpd.service

exit 0