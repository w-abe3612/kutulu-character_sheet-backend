<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKutuluInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KutuluInfo', function (Blueprint $table) {
            $table->id();

            //キャラクターID
            $table->unsignedBigInteger('character_info_id');
            $table->foreign('character_info_id')->references('id')->on('character_infos');
                        
            //ユーザーID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //称号
            $table->string('character_title',255 )->default('');
            //負傷
            $table->integer('injury_value')->default(0);
            //能力値合計ポイント
            $table->integer('ability_value_max')->default(13);
            //能力値取得ポイント
            $table->integer('ability_value_total')->default(0);
            //専門分野合計ポイント
            $table->integer('specialized_skill_max')->default(10);
            //専門分野取得ポイント
            $table->integer('specialized_skill_total')->default(0);
            //所持品
            $table->string('possession_item',3000 )->default('');
            //キャラクター設定
            $table->string('character_preference',3000 )->default('');
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
        Schema::dropIfExists('KutuluInfo');
    }
}
