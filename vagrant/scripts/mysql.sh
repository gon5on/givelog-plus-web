#!/bin/bash
set -eu

echo "# Remove Mariadb-libs & Install Mysql"
yum -y remove mariadb-libs
yum -y localinstall http://dev.mysql.com/get/mysql57-community-release-el7-7.noarch.rpm
yum -y install postfix
yum -y install mysql-community-devel mysql-community-server

systemctl start mysqld

#echo "# Get Root's password"
tmp_mysql_pass=$(grep 'password is generated' /var/log/mysqld.log | awk -F'root@localhost: ' '{print $2}')
tmp_my_conf=/root/.tmp.my.cnf
umask 0077
cat > $tmp_my_conf <<EOF
[client]
user=root
password=$tmp_mysql_pass
connect-expired-password
EOF

#echo "# Set new root password"
new_mysql_pass='MyNewPass4@'
mysql --defaults-file=$tmp_my_conf -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '$new_mysql_pass';"
root_my_conf=/root/.my.cnf
umask 0077
cat > $root_my_conf <<EOF
[client]
user=root
password=$new_mysql_pass
EOF

cat >> /etc/my.cnf <<EOF

character-set-server=utf8mb4
default_password_lifetime=0
validate_password_policy=LOW
validate_password_length=4

[client]
default-character-set=utf8mb4
EOF

systemctl restart mysqld

#echo "# Alter root user"
mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'root';"
sed -i -e "s|^password=.*|password=root|" $root_my_conf

#echo "# Alter vagrant user"
mysql -e "GRANT ALL ON *.* TO 'vagrant'@'%' IDENTIFIED BY 'vagrant';"
mysql -e "GRANT ALL ON *.* TO 'vagrant'@'localhost' IDENTIFIED BY 'vagrant';"
mysql -e "GRANT ALL ON *.* TO 'vagrant'@'127.0.0.1' IDENTIFIED BY 'vagrant';"

#bclub用のDB設定
HAS_USER=$(mysql -u root --skip-column-names -e "SELECT COUNT(*) FROM mysql.user WHERE user = '${DB_USER}';";)
if [[ $HAS_USER < 1 ]]; then
  echo "CREATE USER ${DB_USER}"
  mysql -u root -e "CREATE USER '${DB_USER}'@'localhost' IDENTIFIED BY '${DB_PASS}';"
  mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO '${DB_USER}'@'localhost';"
  mysql -u root -e "CREATE USER '${DB_USER}'@'127.0.0.1' IDENTIFIED BY '${DB_PASS}';"
  mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO '${DB_USER}'@'127.0.0.1';"
  mysql -u root -e "CREATE USER '${DB_USER}'@'%' IDENTIFIED BY '${DB_PASS}';"
  mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO '${DB_USER}'@'%';"
fi

HAS_DB=$(cat <(mysql -u root -s --skip-column-names -e "SHOW DATABASES;" | grep ${DB_NAME}))
if [[ $HAS_DB = '' ]]; then
  echo "CREATE DATABASE ${DB_NAME}"
  mysql -u root -e "CREATE DATABASE ${DB_NAME}"
fi

HAS_TEST_DB=$(cat <(mysql -u root -s --skip-column-names -e "SHOW DATABASES;" | grep ${TEST_DB_NAME}))
if [[ $HAS_TEST_DB = '' && $TEST_DB_NAME != '' ]]; then
    echo "CREATE DATABASE ${TEST_DB_NAME}"
    mysql -u root -e "CREATE DATABASE ${TEST_DB_NAME}"
fi

exit 0
