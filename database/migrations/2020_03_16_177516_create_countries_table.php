<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('name_ru', 255);
            $table->string('name_en', 255);

            $table->string('iso_a2', 5);
            $table->string('iso_a3', 5);
            $table->string('iso_code', 5);

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
        Schema::dropIfExists('countries');
    }
}
