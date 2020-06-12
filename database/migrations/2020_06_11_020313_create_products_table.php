<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->bigIncrements('id'); // ID товара

            $table->unsignedBigInteger('category_id')->nullable(); // ID категории

            $table->string('alias')->nullable(); // Адерс
            $table->string('name')->nullable(); // Название
            $table->longText('description')->nullable(); // Название

            $table->float('cost', 10, 2)->nullable(); // Стоимость

            $table->string('image')->nullable(); // Картинка

            $table->integer('enable')->default(1);  // Продукт Включен

            $table->timestamp('created_at')->nullable(); // Дата создания
            $table->timestamp('updated_at')->nullable(); // Дата изменения
            $table->timestamp('deleted_at')->nullable(); // Дата удаления

            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
