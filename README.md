# Dockerイメージを作成
# ローカル
$ docker-compose -f docker-compose.yml down -v
$ docker-compose -f docker-compose.yml up -d --build

# 本番
$ docker-compose -f docker-compose.prod.yml down -v
$ docker-compose -f docker-compose.prod.yml up -d --build

# 起動しているコンテナが表示される
$ docker ps

# dockerのコンテナの中に入る
$ docker-compose exec app bash


composer create-project --prefer-dist laravel/laravel .
(※create-project --prefer-dist laravel/laravel ~を.ではなくフォルダ名にしたら上手くいかなかった、ゆくゆくこの設定の方法を調べる)

参考URL
https://www.engilaboo.com/laravel-docker/
