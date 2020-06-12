<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTariffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tariffs', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id'); // ID тарифа

            $table->string('name')->nullable();
            $table->longText('description')->nullable();

            $table->float('cost', 10, 2)->nullable(); // Стоимость
            $table->integer('days')->nullable(); // На сколько дней доступ

            $table->string('image')->nullable();  // Картинка Тарифа

            $table->integer('enable')->default(1);  // Тариф Включен

            $table->timestamp('created_at')->nullable(); // Дата создания
            $table->timestamp('updated_at')->nullable(); // Дата изменения
            $table->timestamp('deleted_at')->nullable(); // Дата удаления

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tariffs');
    }
}
