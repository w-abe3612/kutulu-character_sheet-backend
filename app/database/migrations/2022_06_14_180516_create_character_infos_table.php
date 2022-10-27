<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_infos', function (Blueprint $table) {
            $table->id();
            //ユーザーID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            //プレイヤー名(PL)
            $table->string('player_name',255 )->default('');
            //氏名(PC)
            $table->string('player_character',255 )->default('');
            //画像パス
            $table->string('image_path',255 )->default('');
            //画像名
            $table->string('image_name',255 )->default('');
            //公開フラグ
            $table->boolean('public_flg')->default(true);
            //公開ページ用トークン
            $table->string('public_page_token',255 )->default('');
            //削除フラグ
            $table->boolean('delete_flg')->default(false);
            //削除日
            $table->timestamp('deleted_at')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('character_infos');
    }
}
