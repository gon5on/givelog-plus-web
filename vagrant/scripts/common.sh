#!/bin/bash
set -eu

# yum -y update kernel

# install for develop
yum -y install kernel-devel kernel-headers dkms
yum -y install mailx git sqlite-devel libmcrypt-devel openssl-devel gcc-c++ psmisc

# set up JST timezone
timedatectl set-timezone Asia/Tokyo

# disable SElinux
cp -p /etc/selinux/config /etc/selinux/config.orig
sed -i -e "s|^SELINUX=.*|SELINUX=disabled|" /etc/selinux/config

setenforce 0

# set up vagrant public key
curl https://raw.githubusercontent.com/mitchellh/vagrant/master/keys/vagrant.pub >> /home/vagrant/.ssh/authorized_keys


# set up ntpd
yum -y install ntp
systemctl enable ntpd
systemctl enable ntpdate
systemctl list-unit-files -t service | grep ntpd


# set up httpd
yum -y install httpd httpd-devel mod_ssl
systemctl enable httpd
systemctl list-unit-files -t service | grep httpd

# install java8 (Swagger)
# cd ~
# wget --no-cookies --no-check-certificate --header "Cookie: gpw_e24=http%3A%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie" "http://download.oracle.com/otn-pub/java/jdk/8u144-b01/090f390dda5b47b9b721c7dfaa008135/jre-8u144-linux-x64.rpm"
# yum -y localinstall jre-8u144-linux-x64.rpm

exit 0
