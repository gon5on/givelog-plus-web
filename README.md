# Setup

1. download
    ```
    git clone git@github.com:gon5on/givelog-plus-web.git
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
export CAKE_ENV="development"; /srv/httpd/htdocs/givelog-plus/bin/cake migrations seed
```


# TODO

* プレゼント追加の人物複数選択
* プレゼントリストの検索、ソート

* ロゴ
* メニューが上すぎる
* 人物詳細のあげたもらったの見せ方
* プレゼントリストの見せ方