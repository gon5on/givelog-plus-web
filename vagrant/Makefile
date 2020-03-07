.PHONY: all up donw destroy test check fix

all: test

# テスト実行コマンド
TEST_CMD := cd /srv/httpd && export CAKE_ENV=development; php ./vendor/bin/phpunit

# php-cs-fixer の対象になるディレクトリ
PHP_SRC := /srv/httpd/src

# php-cs-fixer 実行コマンド
CHECK_CMD := php-cs-fixer fix --config=/home/vagrant/.composer/config/.php_cs.dist --using-cache=no --dry-run --diff --diff-format udiff
FIX_CMD := php-cs-fixer fix --config=/home/vagrant/.composer/config/.php_cs.dist --using-cache=no

group =


# php-cs-fixer を使用した整形確認
check:
	vagrant ssh -c "$(CHECK_CMD) ${PHP_SRC} || :"

# php-cs-fixer を使用した整形
fix:
	vagrant ssh -c "$(FIX_CMD) ${PHP_SRC}"

# ユニットテストの実行
# $ make
# グループ指定
# $ make group=topic
test:
ifdef group
	vagrant ssh -c "$(TEST_CMD) --group ${group}"
else
	vagrant ssh -c "$(TEST_CMD)"
endif

up:
	vagrant up

down:
	vagrant halt

destroy:
	vagrant destroy -f
