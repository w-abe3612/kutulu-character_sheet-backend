# Dockerイメージを作成
$ docker-compose build --no-cache

# Dockerを起動
# -d でバックグランド起動
$ docker-compose up -d

# 起動しているコンテナが表示される
$ docker ps

# dockerのコンテナの中に入る
$ docker-compose exec app bash


composer create-project --prefer-dist laravel/laravel .
(※create-project --prefer-dist laravel/laravel ~を.ではなくフォルダ名にしたら上手くいかなかった、ゆくゆくこの設定の方法を調べる)

参考URL
https://www.engilaboo.com/laravel-docker/
