<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
ability_values	
	
//id	
//character_info_id	
//user_id	
//skill_name	スキル名
//skill_param	パラメーター名
//skill_value	スキル値
//skill_type	ポジティブかパッシブか
//skill_order	並び順
created_at	
updatedd_at	
*/

class CreateAbilityValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ability_values', function (Blueprint $table) {
            $table->id();

            //キャラクターID
            $table->unsignedBigInteger('character_info_id');
            $table->foreign('character_info_id')->references('id')->on('character_infos');

            //ユーザーID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //スキル名
            $table->string('skill_name',255 )->default('');
            //パラメーター名
            $table->string('skill_param',255 )->default('');
            //スキル値
            $table->integer('skill_value')->default(0);
            //ポジティブかパッシブか
            $table->integer('skill_type')->default(0);
            //並び順
            $table->integer('skill_order')->default(0);
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
        Schema::dropIfExists('ability_values');
    }
}
