<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id'); // ID Видео

            $table->unsignedBigInteger('user_id')->nullable(); // ID Юзера кто добавил видео

            $table->string('alias', 255);  // Виртуальный каталог / адрес видео

            $table->string('name', 255);  // Заголовок видео
            $table->longText('description');  // Описание видео
            $table->longText('keywords');  // Теги видео
            $table->longText('html_code');  // Html код для вставки видео

            $table->integer('likes')->default(0);  // Кол-во лайков
            $table->integer('dislikes')->default(0);  // Кол-во дизлайков

            $table->integer('views')->default(0);  // Кол-во просмотров

            $table->integer('enable')->default(1);  // Видео Включено

            $table->timestamp('created_at')->nullable(); // Дата создания
            $table->timestamp('updated_at')->nullable(); // Дата изменения
            $table->timestamp('deleted_at')->nullable(); // Дата удаления

            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
