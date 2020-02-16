# Setup

1. download
    ```
    git clone https://github.com/gon5on/givelog-plus-web.git
    ```
2. vagrant up
    ```
    cd path/to/givelog-plus-web/vagrant/
    vagrant up
    ```
3. local host
    ```
    192.168.99.99 givelog-plus.local
    ```
4. access  
http://givelog-plus.local


# Migration

```
export CAKE_ENV="development"; /srv/httpd/givelog-plus/bin/cake migrations migrate
export CAKE_ENV="development"; /srv/httpd/givelog-plus/bin/cake migrations rollback

export CAKE_ENV="development"; /srv/httpd/givelog-plus/bin/cake bake migration_diff XXXXXXX
```

# Seed 

```
export CAKE_ENV="development"; /srv/httpd/htdocs/salon_dealer/bin/cake migrations seed
```