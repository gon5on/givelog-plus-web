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


# Library / Plugin

* Bootstrap4  
https://getbootstrap.com

* BootstrapUI  
https://github.com/FriendsOfCake/bootstrap-ui

* SB Admin2  
https://github.com/BlackrockDigital/startbootstrap-sb-admin-2

* Bootstrap Multiselect  
http://davidstutz.de/bootstrap-multiselect

* Bootstrap Color Picker Sliders  
https://www.virtuosoft.eu/code/bootstrap-colorpickersliders

* Tempus Dominus (Bootsrep Datepicker)  
https://tempusdominus.github.io/bootstrap-4

* Font Awesome Free  
https://fontawesome.com

* Firebase Admin SDK for PHP  
https://github.com/kreait/firebase-php


# TODO

* ロゴ
* メニューが上すぎる
* 人物詳細の見せ方（あげたもらった）
* プレゼントリストの見せ方（あげたもらった）


gRPC for PHP のインストール
https://cloud.google.com/php/grpc?hl=ja

からの

composer require google/cloud-firestore




web
    Controller
        UseCase(IF)
        Interactor
            BusinessLogic
        UseCase
    Repository(IF)
    Repository
DB