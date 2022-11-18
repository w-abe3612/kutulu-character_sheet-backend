<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_images', function (Blueprint $table) {
            $table->id();
            
            //キャラクターID
            $table->unsignedBigInteger('character_info_id');
            $table->foreign('character_info_id')->references('id')->on('character_infos');
                        
            //ユーザーID
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // 画像名
            $table->string('image_name')->default('');
            // 画像パス
            $table->string('image_path')->default('');
            // カレント状態
            $table->boolean('current_flg')->default(true);
            // デリート状態
            $table->boolean('deleted_flg')->default(false);
            // デリート日
            $table->timestamp('deleted_at')->nullable()->default(null);

            // デフォルトの日付
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
        Schema::dropIfExists('character_images');
    }
}
