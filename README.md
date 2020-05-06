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


# Firebase Setting

1. Create project
2. Authentication sign-in method on Mail/Password, Google
3. Database firestore on
4. Database firesore write rule
5. Database firesore make complex index
6. Storage on
7. Storage rule write


# Library / Plugin

* CakePHP3  
https://book.cakephp.org/3/ja/index.html

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

* CakePimpleDi  
https://github.com/rochamarcelo/cake-pimple-di


# My Clean Architecture Rule

* フレームワークとの相性が悪いので、Presenterは使わない（コントローラが直接UIに値を返す）
* Cakeの機能は全面的に使用してOKとする
* InteractorとRepositoryは直接newせず、DIする
* どこに何を置いたらよいか迷ったら、テストを書きやすいかどうかで判断する


# TODO

* ダブルクリック対策
* authのセッション更新
* セキュリティコンポーネント
* ページング
* h()
