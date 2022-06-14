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
            //称号
            $table->string('character_title',255 )->default('');
            //負傷
            $table->integer('injury_value')->default(0);
            //画像パス
            $table->string('image_path',255 )->default('');
            //画像名
            $table->string('image_name',255 )->default('');
            //能力値合計ポイント
            $table->integer('ability_value_max')->default(13);
            //能力値取得ポイント
            $table->integer('ability_value_total')->default(0);
            //専門分野合計ポイント
            $table->integer('specialized_skill_max')->default(10);
            //専門分野取得ポイント
            $table->integer('specialized_skill_total')->default(0);
            //所持品
            $table->text('possession_item');
            //キャラクター設定
            $table->text('character_preference');
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
