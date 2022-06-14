<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlavorInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flavor_infos', function (Blueprint $table) {
            $table->id();

            //キャラクターID
            $table->unsignedBigInteger('character_info_id');
            $table->foreign('character_info_id')->references('id')->on('character_infos');
            
            //ユーザーID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            //フレイバー情報名	
            $table->string('flavor_info_name',255 )->default('');
            //フレイバー情報内容
            $table->string('flavor_info_value',255 )->default('');
            //フレイバー情報 並び順
            $table->integer('flavor_info_order')->default(0);
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
        Schema::dropIfExists('flavor_infos');
    }
}
